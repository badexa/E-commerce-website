@extends('layouts.app')
 
@section('title', 'Registered Users')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
@section('contents')

<style>
    .loader {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        animation: rotate 2.0s infinite linear;
        color: white; /* Change the color here */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 0 50px;
       
    }

    .count {
        font-size: 4rem;
        color: white;
        position: absolute;
        top: 56%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1; /* Ensure count numbers appear above the loader */
    }

    @keyframes rotate {
        100% {
            transform: rotate(1turn);
        }
    }
</style>

<div class="container mx-auto mt-8">
 

    <div class="flex justify-center">
        <div class="flex items-center space-x-8">
            <div class="flex flex-col items-center relative">
                <div class="text-lg font-semibold mb-2">Total Users:</div>
                <div class="loader bg-blue-500 w-24 h-24 flex items-center justify-center mb-2"></div>
                <span class="count">{{ $users->total() }}</span>
            </div>
            <div class="flex flex-col items-center relative">
                <div class="text-lg font-semibold mb-2">Total Orders:</div>
                <div class="loader bg-green-500 w-24 h-24 flex items-center justify-center mb-2"></div>
                <span class="count">{{ $totalOrders }}</span>
            </div>
            <div class="flex flex-col items-center relative">
                <div class="text-lg font-semibold mb-2">Total Products:</div>
                <div class="loader bg-yellow-500 w-24 h-24 flex items-center justify-center"></div>
                <span class="count">{{ $totalProducts }}</span>
            </div>
        </div>
    </div>
</div>

<h1 class="font-bold text-2xl mb-8">Registered Users:</h1>

<div class="container mx-auto mt-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($users as $user)
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center mb-4">
                <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?w=826&t=st=1710692576~exp=1710693176~hmac=c742d9af475b201f24477b77c37d08b8abc73e95f841e0de18c3fd9d58e0d5b3" alt="Avatar" class="w-12 h-12 rounded-full mr-4">
                <div>
                    <div class="text-lg font-semibold">{{ $user->name }}</div>
                    <div class="text-gray-500"><span class="font-bold">Email:</span> {{ $user->email }}</div>
                    <div class="text-gray-500"><span class="font-bold">Address:</span> {{ $user->address }}</div>
                    <div class="text-gray-500"><span class="font-bold">Phone:</span> {{ $user->phone }}</div>
                </div>
            </div>
            <div class="flex justify-end">
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 focus:outline-none">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="container mx-auto mt-8">
    {{ $users->links() }}
</div>

@endsection
