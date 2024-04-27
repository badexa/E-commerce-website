@extends('layouts.user')

@section('title', 'Contactez-nous')

@section('contents')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">



<style>
    body {
        background-color: #f7f7f7;
    }

    .header {
        background-image: url('/cod/ContactUsHeader.jpg');
        background-size: cover;
        background-position: center;
        height: 400px; /* Adjust the height as needed */
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
    }

    .header h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .header p {
        font-size: 1.2rem;
        line-height: 1.6;
        color: #ccc;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    p {
        font-size: 1.2rem;
        line-height: 1.6;
        color: #666;
        margin-bottom: 1.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        border: 1px solid #ccc;
    }

    .form-control:focus {
        outline: none;
        border-color: #333;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .btn {
        background-color: #333;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #555;
    }
</style>

<div class="header">
    
</div>

<div class="container mx-auto">
    <form action="#" method="POST">
    <div class="container mx-auto">
        <h1>Contactez-nous :</h1>
       
    </div>
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn">Envoyer</button>
    </form>
   
</div>

<p>N'hésitez pas à nous contacter pour toute question ou demande d'information.</p>


@endsection
