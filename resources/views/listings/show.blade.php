@extends('layouts.default')

@section('content')

	{{-- {{print_r($listing)}} --}}

	<h1 id="title">{{ $listing->title }}</h1>
	<h2>{{$listing['vehicle']->make}} {{$listing['vehicle']->model}}</h2>

	{{-- Als er errors zijn, worden deze hier weergeven. Dit zijn validatie errors. --}}
	@if ($errors->any())
		<div class="alert alert-danger text-center">
			<ul>
				@foreach ($errors->all() as $error)
					<h5>{{ $error }}</h5>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="row" style="max-height: 430px;">

		<div class="carousel-container col-md-8">

			<div id="listingImg" class="carousel slide" data-ride="false" >
			  <ol class="carousel-indicators">
			  	<li data-target="#listingImg" data-slide-to="0" class="active"></li>
			  	@foreach($listing['images'] as $key => $image)
					@if(!$image['mainImage'])
					    <li data-target="#listingImg" data-slide-to="{{$key}}"></li>
					@endif
				@endforeach


			  </ol>
			  <div class="carousel-inner">
				@foreach($listing['images'] as $image)
					@if($image['mainImage'])
					    <div class="carousel-item active">
					      <img class="d-block w-100" src="{{ asset('storage/'.$image->img_path) }}" alt="First slide">
					    </div>
					@else
					    <div class="carousel-item">
					      <img class="d-block w-100" src="{{ asset('storage/'.$image->img_path) }}" alt="Slide item">
					    </div>
					@endif
				@endforeach

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

		<div class="vehicle-information col-md-4">
			{{-- <h4 style="font-weight: bold;">Beknopte informatie:</h4>
			<hr>

			<h5>Kenteken: {{$listing['vehicle']->license_plate}}</h5>
			<h5>Bouwjaar: {{$listing['vehicle']->year}}</h5>
			<h5>Kleur: {{$listing['vehicle']->color}}</h5>
			<h5>Staat: {{$listing['vehicle']->state}}</h5>

			<h5>Versnellingsbak: {{$listing['vehicle']->transmission}}</h5>

			<h5>Brandstof: {{$listing['vehicle']->fuel_type}}</h5>

			<h5>Vermogen: {{$listing['vehicle']->power}} PK</h5> --}}
			<h4>Biedingen</h4>
			@if (Auth::check())
				<form action="{{url('/bieden')}}" method="POST">

					{{ csrf_field() }}
					<div class="form-group">
						<label for="bidInput">Breng een bod uit (vanaf €{{$listing['starting_price']}}): </label>
						<input  class="form-control" type="text" id="bidInput" name="bidAmount" placeholder="Bedrag">
					</div>
					<input type="hidden" name="listingId" value="{{$listing['id']}}">
					<input type="hidden" name="minAmount" value="{{$listing['starting_price']}}">
					<button type="submit">Bied</button>

				</form>
			@endif
			@if(count($listing['bids']))
				@foreach($listing['bids'] as $bid)
					<div class="bid" style="background-color: #fff; margin: 5px;">
						<div class="row">
							<div class="col-md-4">
								<p class="bid-name">
									{{$bid['username']}}
								</p>
							</div>
							<div class="col-md-4">
								<p class="bid-amount">
									{{$bid['amount']}}
								</p>
							</div>
							<div class="col-md-4">
								<p class="bid-amount">
									{{$bid['created_at']->format('d M. Y')}}
								</p>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<h5>Er is nog niet geboden op deze advertentie. Breng het eerste bod uit!</h5>
			@endif	
		</div>

	</div>
	<br>

	<div class="favorite-active" style="display: none;">
		<button class="btn btn-primary" onclick="removeFavorite({{Auth::id()}}, {{$listing['id']}})">
			Verwijderen uit favorieten <i class="fas fa-star"></i>
		</button>
	</div>

	<div class="favorite-inactive" style="display: none;">
		<button class="btn btn-primary" onclick="addFavorite({{Auth::id()}}, {{$listing['id']}})">
			Toevoegen aan favorieten <i class="far fa-star"></i>
		</button>
	</div>

	@if(Auth::check())
		{{$favorite}}
		@if($favorite)
			<script>
				$('.favorite-active').css('display', 'block');
			</script>
		@else
			<script>
				$('.favorite-inactive').css('display', 'block');
			</script>
		@endif
	@endif

	<hr>
	<h4>Specificaties</h4>
	<div class="row">

		<div class="col-md-4">
			<h5>Merk: {{$listing['vehicle']->make}}</h5>
			<h5>Model: {{$listing['vehicle']->model}}</h5>
			<h5>Km stand: {{$listing['vehicle']->mileage}} km</h5>
			<h5>Kenteken: {{$listing['vehicle']->license_plate}}</h5>
			<h5>Bouwjaar: {{$listing['vehicle']->year}}</h5>
			<h5>Kleur: {{$listing['vehicle']->color}}</h5>
			<h5>Staat: {{$listing['vehicle']->state}}</h5>
		</div>

		<div class="col-md-4">
			<h5>Caroserie: {{$listing['vehicle']->body_type}}</h5>
			<h5>APK vervaldatum: {{$listing['vehicle']->apk_expiration}}</h5>
			<h5>Versnellingsbak: {{$listing['vehicle']->transmission}}</h5>
			<h5>Versnellingen: {{$listing['vehicle']->gears}}</h5>
			<h5>Motor inhoud: {{$listing['vehicle']->engine_capicity}} cc</h5>
			<h5>Aantal cilinders: {{$listing['vehicle']->cylinders}}</h5>
			<h5>Leeg gewicht: {{$listing['vehicle']->empty_weight}}</h5>
		</div>

		<div class="col-md-4">
			<h5>Aandrijving: {{$listing['vehicle']->drive}}</h5>
			<h5>Brandstof: {{$listing['vehicle']->fuel_type}}</h5>
			<h5>Aantal deuren: {{$listing['vehicle']->doors}}</h5>
			<h5>Aantal zitplaatsen: {{$listing['vehicle']->seats}}</h5>
			<h5>Vermogen: {{$listing['vehicle']->power}} PK</h5>
		</div>

	</div>
	<hr>
	<div class="listing-description">
		<h4>Beschrijving</h4>

		<h5>{{$listing->description}}</h5>
		<hr>
	</div>

	<div class="seller-information">
		<h4>Verkoper informatie</h4>
		{{-- {{$listing['user']}} --}}
		<h5>Naam: {{$listing['user']->first_name ?? ""}} {{$listing['user']->suffix_name ?? ""}} {{$listing['user']->last_name ?? ""}}</h5>
		<h5>Email: <a href="mailto:{{$listing['user']->email}}">{{$listing['user']->email}}</a></h5>
		<h5>Telefoon: <a href="tel:{{$listing['user']->phone}}">{{$listing['user']->phone}}</a></h5>
		<h5>Adres: {{$listing['user']->street}} {{$listing['user']->street_number}} {{$listing['user']->street_suffix ?? ""}}, {{$listing['user']->zipcode}} {{$listing['user']->city}}</h5>
		{{-- <div class="gmap" style="max-width: 500px; max-height: 500px;">
			<iframe width="100%" height="100%" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://maps.google.nl/maps?q={{$listing['user']->city}}&output=embed"></iframe>
		</div> --}}

	</div>
	<form action="{{url('/listing/'.$listing['id'])}}" method="POST">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger">Verwijderen</button>
	</form>

	<script>
		function addFavorite(userId, listingId) {
			$.ajax({
			    url: "http://localhost/automarktplaats/public/addFavorite",
			    type: "GET",
			    data: {
			    	"userId" : userId,
			    	"listingId" : listingId
			    }
			}).done(function() {
			    $('.favorite-active').css('display', 'block');
			    $('.favorite-inactive').css('display', 'none');
			});
		}

		function removeFavorite(userId, listingId) {
			$.ajax({
			    url: "http://localhost/automarktplaats/public/removeFavorite",
			    type: "GET",
			    data: {
			    	"userId" : userId,
			    	"listingId" : listingId
			    }
			}).done(function() {
			    $('.favorite-active').css('display', 'none');
			    $('.favorite-inactive').css('display', 'block');
			});
		}
	</script>

@stop
