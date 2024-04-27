<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;


 
class AdminController extends Controller
{
    public function profilepage()
    {
        return view('profile');
    }

    public function categorypage()
    {
        $data = Category::all();
        return view('category',compact('data'));
    }

    public function orderpage(Request $request)
    {
        $users = Order::select('name')->distinct()->pluck('name');
        
        $dataquery = Order::query();
    
        if ($request->has('name')) {
            $userName = $request->input('name');
            $dataquery->where('name', $userName);
            $selectedUser = Order::where('name', $userName)->first();
        } else {
            $selectedUser = null;
        }
    
        $data = $dataquery->get();
        return view('order', compact('data', 'users', 'selectedUser'));
    }


    public function delivered($id)
    {
        $order=Order::find($id);
        $order->delivery_status="Delivered !!" ;
        $order->save();
       
        return redirect()->back();
    }
     

    public function add_category(Request $request)
    {
        $data = new Category;
        $data -> category_name = $request -> category;
        $data -> save();
        return redirect()->back()->with('message','Category Added Successfully');
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        $data -> delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }

    public function delete_product($id)
    {
        $data = Product::find($id);
        $data -> delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }


    public function view_product()
    {   
        $catagory = Category::all();
        return view('product',compact('catagory'));
    }

    public function add_product(Request $request)
    {   
       $product=new Product;
       $product->title=$request->title;
       $product->price=$request->price;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
              
       $product->image=$imagename;
     
       $product->description=$request->description;
       $product->quantity=$request->quantity;
       $product->discount_price=$request->dis_price;
       $product->category=$request->category;
       $product->save();
       return redirect()->back()->with('message','Product Added Successfully');
    }

    public function show_product()
    {
        $product=Product::paginate(10);
        return view('showproduct',compact( 'product')); 
    }

    public function edit_product($id)
    {
        $product=Product::find($id);
        $catagory = Category::all();
        return view('editproduct',compact( 'product','catagory')); 
    }

    public function update_product(Request $request,$id)
    {   
       $product=Product::find($id);
       $product->title=$request->title;
       $product->price=$request->price;


       if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('product', $imageName);
        $product->image = $imageName;
    }


       $product->description=$request->description;
       $product->quantity=$request->quantity;
       $product->discount_price=$request->dis_price;
       $product->category=$request->category;

       $product->save();
       return redirect()->back()->with('message','Product Updated Successfully');;
    }

 
}
