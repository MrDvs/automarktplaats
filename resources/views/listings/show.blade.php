@extends('layouts.default')

@section('content')

	<h1 id="title">{{ $listing->title }}</h1>

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
		</div>

	</div>

	{{ print_r($listing) }}
@stop
