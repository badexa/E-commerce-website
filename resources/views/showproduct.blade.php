@extends('layouts.app')
 
@section('title', 'products')
@section('contents')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
@section('contents')
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="center">
                <table class="min-w-full">
                    <thead>
                    <tr class="bg-green-500 text-white">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $prod)
                        <tr>
                            <td>{{ $prod->title }}</td>
                            <td>{{ $prod->description }}</td>
                            <td class="h-20 w-20">
                                <img src="/product/{{ $prod->image }}" alt="Product Image" class="h-full w-full object-cover">
                            </td>
                            <td>{{ $prod->category }}</td>
                            <td>{{ $prod->quantity }}</td>
                            <td>{{ $prod->price }}$</td>
                            <td>{{ $prod->discount_price }}$</td>
                            <td>
                                <a href="{{ url('delete_product', $prod->id) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ url('edit_product', $prod->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-8">
        {{ $product->links() }}
    </div>

@endsection