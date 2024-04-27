@extends('layouts.app')

@section('title', 'Category')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contents')
<form action="{{ route('admin/order') }}" method="GET">
    <select name="name" class="form-control">
        <option value="">Select User</option>
        @foreach($users as $user)
        <option value="{{ $user }}">{{ $user }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mt-2">Apply Filter</button>
</form>
@if($selectedUser)
<div class="mt-4">
    <h2>User Details</h2>
    <p><strong>Name:</strong> {{ $selectedUser->name }}</p>
    <p><strong>Email:</strong> {{ $selectedUser->email }}</p>
    <p><strong>Phone:</strong> {{ $selectedUser->phone }}</p>
    <p><strong>Address:</strong> {{ $selectedUser->address }}</p>
</div>
<div class="overflow-x-auto mt-4">
    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th class="px-4 py-2 bg-gray-200">Product Title</th>
                <th class="px-4 py-2 bg-gray-200">Quantity</th>
                <th class="px-4 py-2 bg-gray-200">Total</th>
                <th class="px-4 py-2 bg-gray-200">Payment Status</th>
                <th class="px-4 py-2 bg-gray-200">Delivery Status</th>
                <th class="px-4 py-2 bg-gray-200">Image</th>
                <th class="px-4 py-2 bg-gray-200">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $order)

            <td class="border px-4 py-2">{{ $order->product_title }}</td>
            <td class="border px-4 py-2">{{ $order->quantity }}</td>
            <td class="border px-4 py-2">{{ $order->total }} MAD</td>
            <td class="border px-4 py-2">{{ $order->payment_status }}
                <div class="loader border-t-2 rounded-full border-yellow-500 bg-yellow-300 animate-spin aspect-square w-8 flex justify-center items-center text-yellow-700">$</div>
            </td>
            <td class="border px-4 py-2 {{ $order->delivery_status == 'Processing' ? 'bg-yellow-200' : ($order->delivery_status == 'Delivered !!' ? 'bg-green-200' : '') }}">{{ $order->delivery_status }}</td>
            <td class="border px-4 py-2 "> <img src="/product/{{ $order->image }}" alt="Product Image" style="width: 13rem; height: 250px;"></td>
            <td class="border px-4 py-2"><a href="{{url('delivered',$order->id)}}" class="btn bg-yellow-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md mt-2">Confirm delivery</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@else
<p>Please select a user to view orders.</p>
@endif

@endsection