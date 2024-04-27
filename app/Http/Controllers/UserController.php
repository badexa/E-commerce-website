<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Stripe;
 
class UserController extends Controller
{
    public function userprofile()
    {
        $orders= Order::where('user_id', Auth::user()->id)->get();
        return view('userprofile',compact('orders'));
    }
 
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $category = Category::all();
        $productsQuery = Product::query();
    
        if ($request->has('category')) {
            $categoryName = $request->input('category');
            $productsQuery->where('category', $categoryName);
        }
    
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $productsQuery->where('title', 'like', '%' . $searchTerm . '%')
                          ->orWhere('description', 'like', '%' . $searchTerm . '%');
        }
    
        if ($request->has('discount')) {
            $productsQuery->whereNotNull('discount_price');
        }
    
        $product = $productsQuery->paginate(9); 
    
        return view('store', compact('product', 'category'));
    }
    
    

    public function cash_order(Request $request)
    {
        $user=Auth::user();
        $userid=$user->id;
        $data=Cart::where('user_id','=' ,$userid)->get();
        
        foreach($data as $data)
        {
            $order=new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_id=$data->Product_id;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->total=$data->price*$data->quantity;
            $order->payment_status='Cash on delivery';
            $order->delivery_status='Processing';
           
            $order->save();

            $product = Product::find($data->Product_id);
            if ($product) {
                $product->quantity -= $data->quantity;
                $product->save();
            }

            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();
           
        }
       
        
        return redirect()->back();
        session()->flash('order_success', true);
    }
    
    public function add_cart(Request $request,$id)
    {
        // Check if the user is authenticated
        if (Auth::id()) {
            // User is authenticated, you can proceed to add the item to the user's cart in the database
            $user = Auth::user();
            $product=Product::find($id);
            $existingCartItem = Cart::where('User_id', $user->id)->where('Product_id', $product->id)->first();
               // Check if the item is already in the cart
        if ($existingCartItem) {
            // Item is already in the cart, display a flash message
            return redirect()->back()->with('error', 'Item is already in your cart.');
            
        }

        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available');
        }

        
            $cart=new Cart;
            $cart->name=$user->name;  
            $cart->email=$user->email;  
            $cart->address=$user->address; 
            $cart->phone=$user->phone; 
            $cart->User_id=$user->id; 

            $cart->Product_id=$product->id;
            $cart->product_title=$product->title;
            $cart->quantity=$request->quantity;
            if($product->discount_price!=null)
            {
                $cart->price=$product->discount_price * $request->quantity;
            }
            else
            {
                $cart->price=$product->price * $request->quantity;
            }

            
            $cart->image=$product->image;
           
            $cart->save();
            return redirect()->back();
           
        } else {
           
            return redirect()->route('login');
        }
    }

    public function stripe($totaleprice)
    {
       return view('stripe',compact('totaleprice'));
    }

 
    
    public function session()
{
    \Stripe\Stripe::setApiKey(config('stripe.sk'));

    if (Auth::check()) {
        $id = Auth::user()->id;
        $cartItems = Cart::where('user_id', $id)->get();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->price * $item->quantity;
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'MAD',
                        'product_data' => [
                            'name' => 'Transaction',
                        ],
                        'unit_amount'  => $totalPrice*100, 
                    ],
                    'quantity'   => 1,
                ],  
            ],
            'mode'        => 'payment',
            'success_url' => route('payment.success'), // Redirect to a success handler route
            'cancel_url'  => route('payment.cancel'), // Redirect to a cancel handler route
        ]);

        return redirect()->away($session->url);
    } else {
        return redirect()->route('login');
    }
}

public function paymentSuccess(Request $request)
{
    // Verify the payment success using the Stripe API
    $paymentIntentId = $request->input('payment_intent');
    $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

    if ($paymentIntent->status === 'succeeded') {
        // Payment succeeded, create and save the order
        // Move the order creation logic here
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id', '=', $userid)->get();
        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_id = $data->Product_id;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->product_title = $data->product_title;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->total=$data->price*$data->quantity;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Processing';

            $order->save();

            $product = Product::find($data->Product_id);
            if ($product) {
                $product->quantity -= $data->quantity;
                $product->save();
            }

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        // You can access the cart items from the session or the database

        return redirect()->route('store')->with('success', 'Payment successful!');
    } else {
        return redirect()->route('store')->with('error', 'Payment failed. Please try again.');
    }
}

public function paymentCancel()
{
    // Handle payment cancellation if needed
    return redirect()->route('store')->with('info', 'Payment canceled.');
}

    
   
}
   
    

