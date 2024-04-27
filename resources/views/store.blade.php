@extends('layouts.user')

@section('title', 'Boutique d\'accessoires pour voitures')

@section('contents')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<style>
    .hero {
        background-image: url('/cod/accessoires-automobile.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }



    body {
        margin: 0;
        font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        font-size: .8125rem;
        color: #333;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }

    .close {
        position: absolute;
        right: 5px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>



@if(session('info'))
<div id="payment-messages" class="alert alert-info">
    <span>{{ session('info') }}</span>
    <button type="button" class="close" onclick="closeMessage()">×</button>
</div>
@endif

@if(session('success'))
<div id="payment-messages" class="alert alert-success">
    <span>{{ session('success') }}</span>
    <button type="button" class="close" onclick="closeMessage()">×</button>
</div>
@endif

@if(session('error'))
<div id="payment-messages" class="alert alert-danger">
    <span>{{ session('error') }}</span>
    <button type="button" class="close" onclick="closeMessage()">×</button>
</div>
@endif

<header class="hero">
    <h1 class="text-3xl font-bold mb-2">Bienvenue dans votre destination d'accessoires pour</h1>

    <h1> voitures !</h1>
    <p class="text-lg">Découvrez les accessoires parfaits pour améliorer votre conduite</p>
</header>


<div class="container mx-auto mt-8">
    <form action="{{ route('store') }}" method="GET" class="flex justify-center items-center space-x-4">
        <select name="category" class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            <option value="">All Categories</option>
            @foreach($category as $cat)
            <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gray-500 text-white hover:bg-green-500 px-4 py-2 rounded-md">Apply Filter</button>
    </form>
    <form action="{{ route('store') }}" method="GET" class="flex justify-center items-center space-x-4 mt-4">
        <input type="text" name="search" placeholder="Search products..." class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50 px-4 py-2">
        <button type="submit" class=" bg-gray-500 text-white hover:bg-green-500 px-4 py-2 rounded-md ">Search</button>
    </form>
</div>


<div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-8">
    @foreach( $product as $prod )
    <div class="max-w-sm rounded overflow-hidden shadow-lg">
        <img class="w-full h-60" src="product/{{$prod->image}}" alt="Product Image">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{$prod->title}}</div>
            <p class="text-gray-700 text-base">{{$prod->description}}</p>
            </br>
            @if($prod->discount_price!=null)
            <p class="text-gray-700 text-2xl text-green-500">Discount price: {{$prod->discount_price}} MAD</p>
            <p class="text-gray-700 text-lg line-through text-red-500">Price: {{$prod->price}} MAD</p>
            @else
            <p class="text-gray-700 text-xl">Price: {{$prod->price}} MAD</p>
            @endif
            <div class="flex items-center mb-2">
                <span class="text-gray-700 text-base mr-2">Rating:</span>
                <div class="text-yellow-400">
                    @for($i = 0; $i < 5; $i++) <i class="fas fa-star {{ $i < $prod->rating ? 'filled' : 'empty' }}"></i>
                        @endfor
                </div>
            </div>
            <p class="text-gray-700 bg-blue-300 text-base">Category: {{$prod->category}}</p>
            <p class="text-gray-700 text-base">Available Quantity: {{$prod->quantity}}</p>
        </div>
        <form action="{{url('/add_cart',$prod->id)}}" method="POST">
            @csrf
            <div class="px-6 py-4 flex justify-between items-center">
                <div>
                    <input  type="number" name="quantity" value="1" min="1" class="w-16 px-3 py-1 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div>
                    <button  type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                        Add to Cart
                    </button>
              </div>
            </div>
        </form>
    </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $product->links() }}
</div>


@endsection

@section('scripts')
<script>
    function closeMessage() {
        let messageContainer = document.getElementById('payment-messages');
        messageContainer.style.display = 'none';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartForms = document.querySelectorAll('.addToCartForm');

        addToCartForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                fetch(form.getAttribute('action'), {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response, e.g., update the cart count or display a message
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script> -->



@endsection