@extends('layouts.user')

@section('title', 'Profile Settings')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@section('contents')

<style>
    
    .icon {
        font-size: 1.5rem; /* Adjust the size as needed */
        margin-right: 0.5em; /* Add some space between icon and text */
    }

    label {
        font-size: 9rem; /* Adjust the size as needed */
    }

</style>

<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
            <i class="fas fa-user-circle"></i> Profile
        </h1>
    </div>
</header>
<hr />

<form method="POST" enctype="multipart/form-data" action="{{ route('user.update', auth()->user()->id) }}">
    @csrf
    @method('PUT')
    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2 " >
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700"><i class="fas fa-user"></i> Name</label>
            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"><i class="fas fa-phone"></i> Phone</label>
            <input type="phone" name="phone" id="phone" value="{{ auth()->user()->phone }}" autocomplete="phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700"><i class="fas fa-map-marker-alt"></i> Address</label>
            <input type="address" name="address" id="address" value="{{ auth()->user()->address }}" autocomplete="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
    </div>
    <div class="mt-8 pb-10 " >
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"><i class="fas fa-save"></i>Save Profile</button>
    </div>
</form>

<div class="mt-8">
    <h2 class="text-2xl font-bold mb-4">Order History :</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payement Method</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($orders as $order)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                <img src="/product/{{ $order->image }}" class="h-12 w-20 object-cover rounded" alt="{{ $order->product_title }}">
                {{ $order->product_title }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $order->quantity }} article</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $order->price }} MAD</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $order->payment_status }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if ($order->delivery_status == 'Processing')
                        <span class="inline-block bg-yellow-400 text-white rounded-full px-2 py-1 mr-2">{{ $order->delivery_status }}</span>
                    @elseif ($order->delivery_status == 'Delivered !!')
                        <span class="inline-block bg-green-500 text-white rounded-full px-2 py-1 mr-2">{{ $order->delivery_status }}</span>
                    @else
                        {{ $order->delivery_status }}
                    @endif
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
