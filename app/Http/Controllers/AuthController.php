<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
 
 
class AuthController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('guest')->except('logout','add_cart','cart','update','destroy_cart');
    }
 
    public function register()
    {           
        return view('auth/register');
    }
 
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();
 
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);
 
        return redirect()->route('login');
    }
 
    public function login()
    {
        return view('auth/login');
    }
 
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
 
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
 
        $request->session()->regenerate();
 
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin/home');
        } else {
            return redirect()->route('home');
        }
         
        return redirect()->route('dashboard');
    }
 
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/');
    }
 
    public function profile()
    {
        $orders=Order::all();
        return view('userprofile',compact('orders'));
    }

   
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            
        ]);
    
        // Update the user's information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
       
        $user->save();
    
        return redirect()->back()->with('success', 'User updated successfully');
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin/home')->with('success', 'User deleted successfully');
    }
    
    public function destroy_cart(Cart $cart)
{
    $cart->delete();

    return redirect()->back();
}
}