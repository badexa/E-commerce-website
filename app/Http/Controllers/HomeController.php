<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
 
class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
       
        return view('home');
    }
 
    
    public function adminHome()
    {
        $users = User::where('type', '0')->paginate(9);
        $totalUsers = User::where('type', '0')->count();
        $totalOrders = Order::count(); 
        $totalProducts = Product::count();
    
        return view('dashboard', compact('users', 'totalUsers', 'totalOrders', 'totalProducts'));
    }
    
}