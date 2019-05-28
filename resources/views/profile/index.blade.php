@extends('layouts.default')

@section('content')
	<h1 class="text-center">Mijn profiel</h1>

	<div class="row">
		<div class="col-md-6">
			<h2 class="text-center">Mijn gegevens</h2>
			<form action="{{url('/profiel/'.$user->id)}}" method="POST">
				@csrf
				@method('PUT')

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="nameInput">Naam</label>
					<div class="col-sm-10">
						<input type="text" id="nameInput" class="form-control" name="name" placeholder="Naam" value="{{$user->first_name}}">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="lastnameInput">Achternaam</label>
					<div class="col-sm-10">
						<input type="text" id="lastnameInput" class="form-control" name="lastname" placeholder="Achternaam" value="{{$user->last_name}}">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="phoneInput">Telefoon</label>
					<div class="col-sm-10">
						<input type="text" id="phoneInput" class="form-control" name="phone" placeholder="Telefoon" value="{{$user->phone}}">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="zipcodeInput">Postcode en plaats</label>
					<div class="col-sm-3">
						<input type="text" id="zipcodeInput" class="form-control" name="zipcode" placeholder="Postcode" value="{{$user->zipcode}}">
					</div>
					<div class="col-sm-7">
						<input type="text" id="cityInput" class="form-control" name="city" placeholder="Plaats" value="{{$user->city}}">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="streetInput">Straat en huisnummer</label>
					<div class="col-sm-6">
						<input type="text" id="streetInput" class="form-control" name="street" placeholder="Straatnaam" value="{{$user->street}}">
					</div>
					<div class="col-sm-2">
						<input type="text" id="housenumberInput" class="form-control" name="housenumber" placeholder="Huisnummer" value="{{$user->street_number}}">
					</div>
					<div class="col-sm-2">
						<input type="text" id="housenumberSuffixInput" class="form-control" name="housenumberSuffix" placeholder="Toevoeging" value="{{$user->street_suffix}}">
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Opslaan</button>
			</form>
		</div>
		<div class="col-md-6">
			<h2 class="text-center">Mijn advertenties</h2>

			<ul id="listing-index-ul">
		{{-- List each listing and basic information --}}
		@foreach($listings as $listing)
			<li class="listing-index-li" id="listing-{{ $listing->id }}">
				<div class="row title-row">

					<div class="title">
						<h4>
							<span class="bold">{{$listing['vehicle']['make'].' '.$listing['vehicle']['model'] }}</span> <br>
							{{ $listing['title'] }}
						</h4>
					</div>

				</div>

				

					

						<div class="listing-preview-img">
							<img src="{{ $listing['img_path'] }}" alt="{{$listing['vehicle']['make'].' '.$listing['vehicle']['model'] }}">
						</div>

					

					

						<div class="description">
							<h5>Beschrijving: {{$listing['description']}}</h5>
						</div>

						<div class="starting-price">
							<h5>Begin prijs: €{{$listing['starting_price']}}</h5>
						</div>

					

					<a href="{{ url('listing/'.$listing->id) }}">Meer informatie ></a>

				
			</li>
		@endforeach
	</ul>
		</div>
	</div>

@endsection