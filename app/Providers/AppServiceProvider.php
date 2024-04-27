<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      
        view()->composer('layouts.user', function ($view) {
            if (Auth::check()) {
                $id = Auth::user()->id;
                $cart = Cart::where('user_id', '=', $id)->get();
                
            } else {
                $cartId = session()->get('cart_id');
                $cart = Cart::where('id', '=', $cartId)->get();
            }
        
            $view->with('cart', $cart);
        });
    
    }
}
