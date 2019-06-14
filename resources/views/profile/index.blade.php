@extends('layouts.profile')

@section('profileSection')

	<h2 class="text-center">Mijn gegevens</h2>
	<hr>
	<form action="{{url('/profiel/'.$user->id)}}" method="POST">
		@csrf
		@method('PUT')

		<div class="form-group row">
			<label class="col-sm-2 col-form-label" for="nameInput">Naam</label>
			<div class="col-sm-10">
				<input type="text" id="nameInput" class="form-control" name="name" placeholder="Naam" value="{{$user->name}}">
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
		            
@endsection