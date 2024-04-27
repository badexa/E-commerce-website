@extends('layouts.user')

@section('title', 'Boutique d\'accessoires pour voitures')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('contents')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
           
        }

        header {
            background-image: url('/cod/header.jpg');
            background-size: cover;
            background-position:center;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
            right:28%;
          
           
        }

        header h1 {
            font-size: 4rem;
        }

        header p {
            font-size: 1.5rem;
        }

        .feature {
            padding: 50px 0;
            background-color:white;
        }

        .feature h2 {
            margin-bottom: 30px;
        }

        .feature .row {
            margin-top: 30px;
        }

        .feature .icon {
            font-size: 3rem;
            margin-bottom: 10px;
        }

      

    

    </style>
    
    <header class="overflow-hidden  p-0 m-0 p-md-20 text-center bg-light w-screen ">
    <div class="container">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">Boutique d'accessoires pour voitures</h1>
            <p class="lead fw-normal">Trouvez les accessoires parfaits pour votre voiture.</p>
    </br>
            <a class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded mr-2" href="/store">Acheter maintenant</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
</header>


    <div class="feature">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container-fluid">
                  
                    <div class="row">
                        <div class="col-lg-3">
                            <i class="fas fa-truck-moving icon"></i>
                            <h3>Livraison rapide</h3>
                            <p>Recevez vos accessoires dans les plus brefs délais.</p>
                        </div>
                        <div class="col-lg-3">
                            <i class="fas fa-headset icon"></i>
                            <h3>Service client</h3>
                            <p>Une équipe dédiée prête à répondre à toutes vos questions.</p>
                        </div>
                        <div class="col-lg-3">
                            <i class="fas fa-shield-alt icon"></i>
                            <h3>Qualité garantie</h3>
                            <p>Nos produits sont soumis à des contrôles stricts pour garantir leur qualité.</p>
                        </div>
                        <div class="col-lg-3">
                            <i class="fas fa-lock icon"></i>
                            <h3>Paiement sécurisé</h3>
                            <p>Payez en toute sécurité avec nos systèmes de paiement fiables.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>  
</div>


<section class="daily-offers bg-gray-100 py-16 w-screen" style="position: relative; right:28%">
    <div class="container">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-4">Ne manquez pas nos offres spéciales chaque jour !</h2>
            <p class="text-lg text-gray-600 mb-8">Découvrez nos offres exceptionnelles sur une sélection d'accessoires pour voitures. Profitez-en avant qu'elles ne disparaissent !</p>
            <a href="{{ route('store', ['discount' => true]) }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded">Voir les offres du jour</a>

        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@endsection 

