@extends('layouts.default')

@section('content')

	<h1 id="title">{{ $listing->title }}</h1>
	<h2>{{$listing['vehicle']->make}} {{$listing['vehicle']->model}}</h2>

	<div style="display: inline-block;">

		<div class="carousel-container">

			<div id="listingImg" class="carousel slide" data-ride="carousel"> 
			  <ol class="carousel-indicators">
			    <li data-target="#listingImg" data-slide-to="0" class="active"></li>
			    {{-- <li data-target="#listingImg" data-slide-to="1"></li>
			    <li data-target="#listingImg" data-slide-to="2"></li> --}}
			  </ol>
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <img class="d-block w-100" src="{{ asset($listing->img_path) }}" alt="First slide">
			    </div>
			    {{-- <div class="carousel-item">
			      <img class="d-block w-100" src="{{ asset('img/audir8.jpg') }}" alt="Second slide">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-100" src="{{ asset('img/audir8.jpg') }}" alt="Third slide">
			    </div> --}}
			  </div>
			  <a class="carousel-control-prev" href="#listingImg" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#listingImg" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>

		</div>

		<div class="vehicle-information">
			<h4 style="font-weight: bold;">Voertuig informatie:</h4>
			<hr>
			<h5>Merk: {{$listing['vehicle']->make}}</h5>
			<h5>Model: {{$listing['vehicle']->model}}</h5>
			<h5>Km stand: {{$listing['vehicle']->mileage}} km</h5>
			<h5>Kenteken: {{$listing['vehicle']->license_plate}}</h5>
			<h5>Bouwjaar: {{$listing['vehicle']->year}}</h5>
			<h5>Kleur: {{$listing['vehicle']->color}}</h5>
			<h5>Staat: {{$listing['vehicle']->state}}</h5>
			<h5>Caroserie: {{$listing['vehicle']->body_type}}</h5>
			<h5>APK vervaldatum: {{$listing['vehicle']->apk_expiration}}</h5>
			<h5>Versnellingsbak: {{$listing['vehicle']->transmission}}</h5>
			<h5>Versnellingen: {{$listing['vehicle']->gears}}</h5>
			<h5>Motor inhoud: {{$listing['vehicle']->engine_capicity}} cc</h5>
			<h5>Aantal cilinders: {{$listing['vehicle']->cylinders}}</h5>
			<h5>Leeg gewicht: {{$listing['vehicle']->empty_weight}}</h5>
			<h5>Aandrijving: {{$listing['vehicle']->drive}}</h5>
			<h5>Brandstof: {{$listing['vehicle']->fuel_type}}</h5>
			<h5>Aantal deuren: {{$listing['vehicle']->doors}}</h5>
			<h5>Aantal zitplaatsen: {{$listing['vehicle']->seats}}</h5>
			<h5>Vermogen: {{$listing['vehicle']->power}} PK</h5>
		</div>

	</div>

	<div class="seller-information">
		<h4>Verkoper informatie</h4>
		<hr>
		{{-- {{$listing['user']}} --}}
		<h5>Naam: {{$listing['user']->first_name ?? ""}} {{$listing['user']->suffix_name ?? ""}} {{$listing['user']->last_name ?? ""}}</h5>
		<h5>Email: <a href="mailto:{{$listing['user']->email}}">{{$listing['user']->email}}</a></h5>	
		<h5>Telefoon: <a href="tel:{{$listing['user']->phone}}">{{$listing['user']->phone}}</a></h5>
		<h5>Adres: {{$listing['user']->street}} {{$listing['user']->street_number}} {{$listing['user']->street_suffix ?? ""}}, {{$listing['user']->zipcode}} {{$listing['user']->city}}</h5>
		{{-- <div class="gmap" style="max-width: 500px; max-height: 500px;">
			<iframe width="100%" height="100%" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://maps.google.nl/maps?q={{$listing['user']->city}}&output=embed"></iframe>
		</div> --}}
	
	</div>

	{{ print_r($listing) }}
@stop
