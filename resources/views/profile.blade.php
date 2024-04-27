@extends('layouts.app')
 
@section('title', 'Profile Settings')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contents')
<style>
 

 .book {
  position: relative;
  border-radius: 10px;
  width: 600px;
  height: 600px;
  background-color: whitesmoke;
  -webkit-box-shadow: 1px 1px 12px #000;
  box-shadow: 1px 1px 12px #000;
  -webkit-transform: preserve-3d;
  -ms-transform: preserve-3d;
  transform: preserve-3d;
  -webkit-perspective: 2000px;
  perspective: 2000px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  color: #000;
  font-size: x-large;
  left: 20%;
}

.cover {
  top: 0;
  position: absolute;
  background-color: lightgray;
  width: 100%;
  height: 100%;
  border-radius: 10px;
  cursor: pointer;
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  -webkit-transform-origin: 0;
  -ms-transform-origin: 0;
  transform-origin: 0;
  -webkit-box-shadow: 1px 1px 12px #000;
  box-shadow: 1px 1px 12px #000;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
}

.book:hover .cover {
  -webkit-transition: all 0.5s;
  transition: all 0.5s;
  -webkit-transform: rotatey(-80deg);
  -ms-transform: rotatey(-80deg);
  transform: rotatey(-80deg);
}

p {
  font-size: 20px;
  font-weight: bolder;
}
 .label{
    color:darkslategray;
    font-weight: bolder;
    font-family:Georgia, 'Times New Roman', Times, serif;
 }
</style>



<div class="book">
<form method="POST" action="{{ route('user.update', auth()->user()->id) }}">
    @csrf
    @method('PUT')
    <div>
        <label class="label">
            <span class="text-base label-text">Name :</span>
        </label>
        <input name="name" type="text" value="{{ auth()->user()->name }}" class="w-full input input-bordered" />
    </div>
    <br />
    <div>
        <label class="label">
            <span class="text-base label-text">Email :</span>
        </label>
        <input name="email" type="text" value="{{ auth()->user()->email }}" class="w-full input input-bordered" />
    </div>
    <br />
    <div class="mt-6">
        <button type="submit" class="btn btn-block bg-red-500 text-white py-2 px-4 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">Save Profile</button>
    </div>
    </form>
    <div class="cover">
        <p>ADMIN PROFILE</p>
    </div>
   </div>

@endsection
