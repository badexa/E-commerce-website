@extends('layouts.user')

@section('title', 'Boutique d\'accessoires pour voitures')

@section('contents')



@foreach($cart as $cart)
<div>{{$cart->product_title}}</div>
<div>{{$cart->price}}</div>
@endforeach




@endsection