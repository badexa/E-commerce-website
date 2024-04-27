@extends('layouts.user')

@section('title', 'À Propos')

@section('contents')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f7f7f7;
    }
 
    .header {
        background-color: #333;
        color: white;
        padding: 2rem 0;
        text-align: center;
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

    .quote {
        font-style: italic;
        color: #888;
        margin-top: 2rem;
    }

    .team-member {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .team-member img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-right: 1rem;
    }

    .team-member-details {
        flex: 1;
    }

    .team-member-name {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .team-member-role {
        color: #888;
    }

    .cta {
        background-color: #333;
        color: white;
        padding: 1rem 2rem;
        border-radius: 0.5rem;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .cta:hover {
        background-color: #555;
    }
</style>
<div class="header">
    <div class="container mx-auto">
        <h1>Notre Histoire</h1>
        <p>Nous sommes une équipe passionnée par les voitures et tout ce qui les concerne. Notre objectif est de fournir à nos clients les meilleurs accessoires pour améliorer leur expérience de conduite.</p>
    </div>
</div>

<div class="container mx-auto">
    <h1>Notre Histoire :</h1>
    <p>Nous sommes une équipe passionnée par les voitures et tout ce qui les concerne. Notre objectif est de fournir à nos clients les meilleurs accessoires pour améliorer leur expérience de conduite.</p>
    <p>Nos produits sont soigneusement sélectionnés pour leur qualité, leur fonctionnalité et leur style. Nous croyons que chaque voiture mérite d'être équipée des meilleurs accessoires pour répondre aux besoins et aux goûts de son propriétaire.</p>

    <h2 class="mt-8 mb-4">Notre Équipe :</h2>
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Team Member">
        <div class="team-member-details">
            <div class="team-member-name">John Doe</div>
            <div class="team-member-role">Fondateur et PDG</div>
        </div>
    </div>
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/women/1.jpg" alt="Team Member">
        <div class="team-member-details">
            <div class="team-member-name">Jane Smith</div>
            <div class="team-member-role">Responsable Marketing</div>
        </div>
    </div>
    <div class="team-member">
        <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="Team Member">
        <div class="team-member-details">
            <div class="team-member-name">Mark Johnson</div>
            <div class="team-member-role">Responsable des Ventes</div>
        </div>
    </div>

    <p class="quote">"Nous sommes dédiés à fournir à nos clients les meilleurs produits et services pour rendre leur expérience de conduite exceptionnelle." - L'équipe de Boutique d'Accessoires pour Voitures</p>

 
</div>

@endsection
