<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            overflow: auto;
        }

        .card {
            overflow: hidden;
            position: relative;
            text-align: left;
            border-radius: 0.5rem;
            max-width: 290px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background-color: #fff;
            margin: 0 auto;
            margin-top: 100px;
        }

        .dismiss {
            position: absolute;
            right: 10px;
            top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            background-color: #fff;
            color: black;
            border: 2px solid #D1D5DB;
            font-size: 1rem;
            font-weight: 300;
            width: 30px;
            height: 30px;
            border-radius: 7px;
            transition: .3s ease;
        }

        .dismiss:hover {
            background-color: #ee0d0d;
            border: 2px solid #ee0d0d;
            color: #fff;
        }

        .header {
            padding: 1.25rem 1rem 1rem 1rem;
        }

        .image {
            display: flex;
            margin-left: auto;
            margin-right: auto;
            background-color: #0afa2a;
            flex-shrink: 0;
            justify-content: center;
            align-items: center;
            width: 3rem;
            height: 3rem;
            border-radius: 9999px;
            animation: animate .6s linear alternate-reverse infinite;
            transition: .6s ease;
        }

        .image svg {
            color: #0afa2a;
            width: 2rem;
            height: 2rem;
        }

        .content {
            margin-top: 0.75rem;
            text-align: center;
        }

        .title {
            color: #066e29;
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.5rem;
        }

        .message {
            margin-top: 0.5rem;
            color: #595b5f;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .actions {
            margin: 0.75rem 1rem;
        }



        @keyframes animate {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.09);
            }
        }
    </style>


</head>

<body>
    <div>
        <nav class="bg-gray-800 bg-opacity-90 ">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-32">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 ">
                            <img src="{{ asset('cod/logo.png') }}" class="h-20 rounded-full pl-10">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="{{ url('/') }}" class="text-gray-300 hover:bg-gray-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                                <a href="{{ url('/store') }}" class="text-gray-300 hover:bg-gray-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Store</a>
                                <a href="{{ route('about') }}" class="text-gray-300 hover:bg-gray-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About Us</a>
                                <a href="{{ route('contact') }}" class="text-gray-300 hover:bg-gray-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            @if (Route::has('login'))
                            @auth
                            <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                            <!-- Profile dropdown -->
                            <div x-data="{show: false}" x-on:click.away="show = false" class="ml-3 relative z-20">
                                <div>
                                    <button x-on:click="show = !show" type="button" class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="https://farsgraphic.com/wp-content/uploads/2016/12/10-500x500.png" alt="">
                                    </button>
                                </div>
                                <div x-show="show" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                    <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>

                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>

                                    <a href="{{ url('/logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                                </div>
                            </div>

                            <div x-data="{show: false}" x-on:click.away="show = false" class="ml-3 relative z-20">
                               
                            </div>


                            <div x-data="{ show: false }" x-on:click.away="show = false" class="ml-3 relative">
                                <div>
                                    <button x-on:click="show = !show" type="button" class="max-w-xs bg-gray-800 rounded-full  flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">cart</span>
                                        <img class="h-10 w-10 rounded-full" src="https://th.bing.com/th/id/OIP.6MfvU24vFvb8CMN1pZ2-MwAAAA?rs=1&pid=ImgDetMain" alt="">
                                        <span class="ml-2 text-sm font-medium text-gray-100">{{ $cart->count() }}</span>
                                    </button>
                                </div>

                                <div x-show="show" class="origin-top-right absolute left-1 mt-2 w-80 rounded-md shadow-lg py-3 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-20 " role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="max-height: 600px; overflow-y: auto;">
                                    <?php $totalPrice = 0; ?>
                                    @if ($cart->isEmpty())
                                    <div class="px-4 py-2 text-sm text-gray-500">Your cart is empty.</div>
                                    @else
                                    <h1>Total articles: {{ $cart->count() }}</h1>
                                    <div id="cart-items">
                                        @foreach($cart as $item)
                                        <div class="flex items-center justify-between px-4 py-2 cart-item" data-item-id="{{ $item->id }}">
                                            <div class="flex items-center space-x-2">
                                                <img src="/product/{{ $item->image }}" class="w-20 h-20 object-cover" alt="{{ $item->product_title }}">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-800">{{ $item->product_title }}</div>
                                                    <div class="text-sm text-gray-500">Price :{{ $item->price }} MAD</div>
                                                    <div class="text-sm text-gray-500">Quantity: <input type="number" name="quantity" value="{{ $item->quantity }}"></div>
                                                </div>
                                            </div>
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                                    <!-- You can add an icon here for removing the item from the cart -->
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                        <?php $totalPrice += $item->price; ?>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="font-bold text-lg py-2 px-4 text-sm font-medium text-gray-800" style="color:indigo;">Total Price: {{ $totalPrice }} MAD</div>
                                    @endif
                                    <div class="flex justify-center mt-4">
                                        <h1 class="text-lg font-medium">Proceed to Order:</h1>
                                    </div>
                                    <div class="flex justify-center mt-2">
                                        <a id="openPopup" href="{{ url('cash_order') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 h-full">Cash on Delivery</a>
                                        <form action="/session" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 h-full" type="submit" id="checkout-live-button"> Checkout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @else
                            <a href="{{ route('login') }}" class="font-semibold text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                            @endauth
                            @endif

                            <div class="-mr-2 flex md:hidden">
                                <!-- Mobile menu button -->
                                <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                                    <span class="sr-only">Open main menu</span>
                                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu, show/hide based on menu state. -->
                    <div class="md:hidden" id="mobile-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                            <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
                            <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium">Store</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About Us</a>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact Us</a>
                        </div>
                        <div class="pt-4 pb-3 border-t border-gray-700">
                            <div class="flex items-center px-5">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                                    <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                                </div>
                                <button class="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                    <span class="sr-only">View notifications</span>
                                    <!-- Heroicon name: outline/bell -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </button>
                            </div>
                            <div class="mt-3 px-2 space-y-1">
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Your Profile</a>

                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Settings</a>

                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign out</a>
                            </div>
                        </div>
                    </div>
        </nav>
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div>@yield('contents')</div>
            </div>
        </main>
    </div>
    <footer class="bg-gray-700 text-white py-16  bottom-0 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Contactez-nous</h3>
                    <p>123 Rue des Accessoires pour Voitures</p>
                    <p>Ville, CA 12345</p>
                    <p>Téléphone : (123) 456-7890</p>
                    <p>Email : info@example.com</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-400 hover:text-blue-300"><i class="fab fa-facebook-f fa-4x text-blue-500"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-300"><i class="fab fa-twitter fa-4x text-green-500"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-300"><i class="fab fa-instagram fa-4x text-purple-500"></i></a>
                        <a href="#" class="text-blue-400 hover:text-blue-300"><i class="fab fa-linkedin-in fa-4x text-indigo-500"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Bulletin d'information</h3>
                    <p>Restez informé de nos dernières offres et produits en vous abonnant à notre newsletter.</p>
                    <form action="#" method="post">
                        <div class="flex items-center mt-4">
                            <input type="email" name="email" id="email" placeholder="Votre adresse e-mail" class="w-full bg-gray-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">S'abonner</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-8 border-gray-900">
            <div class="text-center">
                <a href="#" class="text-gray-400 hover:text-white mx-2">Accueil</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">À propos</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Produits</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Contact</a>
            </div>
        </div>
    </footer>

    <div x-data="{ isOpen: @if(session('order_success')) true @else false @endif }" x-show="isOpen" class="popup" id="popup">
        <div class="card">
            <button type="button" class="dismiss" id="dismiss">×</button>
            <div class="header">
                <div class="image">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#000000" d="M20 7L9.00004 18L3.99994 13"></path>
                        </g>
                    </svg>
                </div>
                <div class="content">
                    <span class="title">Order validated</span>
                    <p class="message">Thank you for your purchase. Your package will be delivered within 2 days of your purchase</p>
                </div>

            </div>
        </div>

    </div>


    <script>
        const openPopupButton = document.getElementById('openPopup');
        const dismissButton = document.getElementById('dismiss');
        const popup = document.getElementById('popup');

        openPopupButton.addEventListener('click', () => {
            popup.style.display = 'block';
        });

        dismissButton.addEventListener('click', () => {
            popup.style.display = 'none';
        });
    </script>

    @yield("scripts")

</body>


</html>