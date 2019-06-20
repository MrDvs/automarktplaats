@extends('layouts.default')

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger text-center">
			<ul>
				@foreach ($errors->all() as $error)
					<h5>{{ $error }}</h5>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="POST" action="{{url('/listing/'.$listing['id'])}}">
		@csrf
		@method('PUT')

		<h3 class="text-center">Advertentie aanpassen</h3>
		<hr>

		<div class="form-group">
			<label for="titleInput">Advertentie titel</label>
			<input type="text" id="titleInput" class="form-control" name="title" {{-- onkeypress="charCount('#titleInput')" --}} placeholder="Titel" maxlength="191" value="{{$listing['title']}}" >
			{{-- <span class="counter">0</span>/191 --}}
		</div>

		<div class="form-group">
			<label for="descriptionInput">Advertentie beschrijving</label>
			{{-- <input type="text" id="descriptionInput" class="form-control" name="description" placeholder="Beschrijving" maxlength="191" required> --}}
			<textarea name="description" id="descriptionInput" class="form-control" placeholder="Beschrijving" style="width: 100%">{{$listing['description']}}</textarea>
		</div>

		<div class="form-group">
			<label for="priceInput">Begin prijs</label>
			<input type="number" id="priceInput" class="form-control" name="price" value="{{$listing['starting_price']}}" >
		</div>

		<h3 class="text-center">Voertuig informatie:</h3>
		<hr>

		<div class="form-group">
			<label for="makeInput">Merk</label>
			<input type="text" id="makeInput" class="form-control" name="make" placeholder="merk" value="{{$listing['vehicle']['make']}}" >
		</div>

		<div class="form-group">
			<label for="modelInput">Model</label>
			<input type="text" id="modelInput" class="form-control" name="model" placeholder="model" value="{{$listing['vehicle']['model']}}" >
		</div>
		<hr>

		<div class="form-group">
			<label for="mileageInput">Kilometer stand</label>
			<input type="number" id="mileageInput" class="form-control" name="mileage" placeholder="Kilometer stand" value="{{$listing['vehicle']['mileage']}}" >
		</div>

		<div class="form-group">
			<label for="colorInput">Kleur</label>
			<input type="text" id="colorInput" class="form-control" name="color" placeholder="Kleur" value="{{$listing['vehicle']['color']}}">
		</div>

		<div class="form-group">
			<label for="stateInput">Staat</label>
			<select class="form-control" name="state" class="custom-select" id="stateInput" value="{{$listing['vehicle']['state']}}">
			  <option value="Gebruikt" selected>Gebruikt</option>
			  <option value="Nieuw">Nieuw</option>
			</select>
		</div>

		<div class="form-group">
			<label for="bodyInput">Carroserie</label>
			<input type="text" id="bodyInput" class="form-control" name="body" placeholder="Carroserie" value="{{$listing['vehicle']['body_type']}}">
		</div>

		<div class="form-group">
			<label for="apkInput">APK vervaldatum (JJJJ-MM-DD</label>
			<input type="text" id="apkInput" class="form-control" name="apk" placeholder="APK vervaldatum" value="{{$listing['vehicle']['apk_expiration']}}">
		</div>

		<div class="form-group">
			<label for="capacityInput">Motor inhoud (cc)</label>
			<input type="number" id="capacityInput" class="form-control" name="capacity" placeholder="Motor inhoud" value="{{$listing['vehicle']['engine_capacity']}}">
		</div>

		<div class="form-group">
			<label for="cylinderInput">Aantal cilinders</label>
			<input type="number" id="cylinderInput" class="form-control" name="cylinder" placeholder="Aantal cilinders" value="{{$listing['vehicle']['cylinders']}}">
		</div>

		<div class="form-group">
			<label for="weightInput">Leeggewicht</label>
			<input type="number" id="weightInput" class="form-control" name="weight" placeholder="Leeggewicht" value="{{$listing['vehicle']['empty_weight']}}">
		</div>

		<div class="form-group">
			<label for="doorInput">Aantal deuren</label>
			<input type="number" id="doorInput" class="form-control" name="door" placeholder="Aantal deuren" value="{{$listing['vehicle']['doors']}}">
		</div>

		<div class="form-group">
			<label for="seatInput">Aantal zitplaatsen</label>
			<input type="number" id="seatInput" class="form-control" name="seat" placeholder="Aantal zitplaatsen" value="{{$listing['vehicle']['seats']}}">
		</div>

		<div class="form-group">
			<label for="powerInput">Vermogen (pk)</label>
			<input type="number" id="powerInput" class="form-control" name="power" placeholder="Vermogen" value="{{$listing['vehicle']['power']}}">
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>

	</form>
@endsection
