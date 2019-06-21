@extends('layouts.default')


@section('content')
	<link rel="stylesheet" href="{{asset('css/kentekenplaat.min.css')}}" />

	<h1 class="text-center">Verkoop je auto!</h1>

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

		<form action="{{ url('listing') }}" method="POST" enctype="multipart/form-data">

			{{-- De csrf token beschermd tegen cross-site request forgery --}}
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-7">
					<h3 class="text-center">Advertentie informatie:</h3>
					<hr>

					<div class="form-group">
						<label for="mainimgInput">Hoofd afbeelding</label>
						<input type="file" id="mainimgInput" class="form-control-file" name="mainImage" aria-describedby="mainimgHelp">
						<small id="mainimgHelp" class="form-text text-muted">Tip: upload horizontaal genomen foto's voor het beste resultaat</small>
					</div>

					<div class="form-group">
						<label for="imgInput">Kies je extra afbeeldingen</label>
						<input type="file" id="imgInput" class="form-control-file" name="extraImages[]" aria-describedby="imgHelp" multiple>
						<small id="imgHelp" class="form-text text-muted">Tip: upload horizontaal genomen foto's voor het beste resultaat</small>
					</div>

					<div class="form-group">
						<label for="titleInput">Advertentie titel</label>
						<input type="text" id="titleInput" class="form-control" name="title" {{-- onkeypress="charCount('#titleInput')" --}} placeholder="Titel" maxlength="191" value="{{old('title')}}" >
						{{-- <span class="counter">0</span>/191 --}}
					</div>

					<div class="form-group">
						<label for="descriptionInput">Advertentie beschrijving</label>
						{{-- <input type="text" id="descriptionInput" class="form-control" name="description" placeholder="Beschrijving" maxlength="191" required> --}}
						<textarea name="description" id="descriptionInput" class="form-control" placeholder="Beschrijving" style="width: 100%">{{old('description')}}</textarea>
					</div>

					<div class="form-group">
						<label for="priceInput">Begin prijs</label>
						<input type="number" id="priceInput" class="form-control" name="price" value="{{old('price')}}" >
					</div>

					<div class="form-group">
						<label for="date">Eind datum</label>
						<input type="text" id="date" class="form-control" value="{{$endDate}}" aria-describedby="dateHelp" readonly>
						<small id="dateHelp" class="form-text text-muted">Alle advertenties staan standaard 1 week op Automarktplaats.</small>
					</div>

				</div>
				<div class="col-md-5">

					<h3 class="text-center">Voertuig informatie:</h3>
					<hr>

					<h2 class="text-center">Voer hier je kenteken in:</h2>
					<div class="kenteken-container" style="width: 150px; margin: auto; padding-bottom: 2vh">
						<input type="text" class="kentekenplaat" value="{{old('licenseplate')}}">
					</div>
					<span class="warning"></span>

					<div class="form-group">
						<label for="makeInput">Merk</label>
						<input type="text" id="makeInput" class="form-control" name="make" placeholder="merk" value="{{old('make')}}" >
					</div>

					<div class="form-group">
						<label for="modelInput">Model</label>
						<input type="text" id="modelInput" class="form-control" name="model" placeholder="model" value="{{old('model')}}" >
					</div>
					<hr>

					<div class="form-group">
						<label for="mileageInput">Kilometer stand</label>
						<input type="number" id="mileageInput" class="form-control" name="mileage" placeholder="Kilometer stand" value="{{old('mileage')}}" >
					</div>

					<div class="form-group">
						<label for="licenseplateInput">Kenteken</label>
						<input type="text" id="licenseplateInput" class="form-control" name="licenseplate" placeholder="Kenteken" value="{{old('licenseplate')}}" >
					</div>

					<div class="form-group">
						<label for="yearInput">Bouwjaar</label>
						<input type="text" id="yearInput" class="form-control" name="year" placeholder="Bouwjaar" value="{{old('year')}}">
					</div>

					<div class="form-group">
						<label for="colorInput">Kleur</label>
						<input type="text" id="colorInput" class="form-control" name="color" placeholder="Kleur" value="{{old('color')}}">
					</div>

					<div class="form-group">
						<label for="stateInput">Staat</label>
						<select class="form-control" name="state" class="custom-select" id="stateInput" value="{{old('state')}}">
						  <option value="Gebruikt" selected>Gebruikt</option>
						  <option value="Nieuw">Nieuw</option>
						</select>
					</div>

					<div class="form-group">
						<label for="bodyInput">Carroserie</label>
						<input type="text" id="bodyInput" class="form-control" name="body" placeholder="Carroserie" value="{{old('body')}}">
					</div>

					<div class="form-group">
						<label for="apkInput">APK vervaldatum</label>
						<input type="text" id="apkInput" class="form-control" name="apk" placeholder="APK vervaldatum" value="{{old('apk')}}">
					</div>

					<div class="form-group">
						<label for="transmissionInput">Type versnellingsbak</label>
						{{-- <input type="text" id="transmissionInput" class="form-control" name="transmission" placeholder="Type versnellingsbak" value="{{old('transmission')}}"> --}}
						<select name="transmission" class="custom-select" id="transmissionInput" value="{{old('transmission')}}">
							<option value="Automaat">Automaat</option>
							<option value="Handgeschakeld">Handgeschakeld</option>
						</select>
					</div>

					<div class="form-group">
						<label for="gearInput">Aantal versnellingen</label>
						<input type="number" id="gearInput" class="form-control" name="gear" placeholder="Aantal versnellingen" value="{{old('gear')}}">
					</div>

					<div class="form-group">
						<label for="capacityInput">Motor inhoud (cc)</label>
						<input type="number" id="capacityInput" class="form-control" name="capacity" placeholder="Motor inhoud" value="{{old('capacity')}}">
					</div>

					<div class="form-group">
						<label for="cylinderInput">Aantal cilinders</label>
						<input type="number" id="cylinderInput" class="form-control" name="cylinder" placeholder="Aantal cilinders" value="{{old('cylinder')}}">
					</div>

					<div class="form-group">
						<label for="weightInput">Leeggewicht</label>
						<input type="number" id="weightInput" class="form-control" name="weight" placeholder="Leeggewicht" value="{{old('weight')}}">
					</div>

					<div class="form-group">
						<label for="driveInput">Aandrijving</label>
						{{-- <input type="text" id="driveInput" class="form-control" name="drive" placeholder="Aandrijving" value="{{old('drive')}}"> --}}
						<select name="drive" id="driveInput" value="{{old('drive')}}" class="custom-select">
							<option selected disabled>Aandrijving</option>
							<option value="Voorwiel">Voorwiel</option>
							<option value="Vierwiel">Vierwiel</option>
							<option value="Achterwiel">Achterwiel</option>
						</select>
					</div>

					<div class="form-group">
						<label for="fuelInput">Brandstof</label>
						<select name="fuel" id="fuelInput" class="custom-select" value="{{old('fuel')}}">
						  <option selected disabled>Brandstof</option>
						  <option value="Elektriciteit">Elektrisch</option>
						  <option value="Hybride">Hybride</option>
						  <option value="Benzine">Benzine</option>
						  <option value="Diesel">Diesel</option>
						  <option value="LPG">LPG</option>
						</select>
					</div>

					<div class="form-group">
						<label for="doorInput">Aantal deuren</label>
						<input type="number" id="doorInput" class="form-control" name="door" placeholder="Aantal deuren" value="{{old('door')}}">
					</div>

					<div class="form-group">
						<label for="seatInput">Aantal zitplaatsen</label>
						<input type="number" id="seatInput" class="form-control" name="seat" placeholder="Aantal zitplaatsen" value="{{old('seat')}}">
					</div>

					<div class="form-group">
						<label for="powerInput">Vermogen (pk)</label>
						<input type="number" id="powerInput" class="form-control" name="power" placeholder="Vermogen" value="{{old('power')}}">
					</div>

				</div>
			</div>

			<button type="submit" style="margin-bottom: 25px;" class="btn btn-primary">Plaats advertentie</button>
		</form>

	<script>
		// function charCount(id) {
		// 	console.log(this)
		// 	var charCount = $(id).val();
		// 	$('.counter').text(charCount.length );
		// }

		$('.kentekenplaat').on('keyup', (function() {

			// ajax request
			var licenseplate = $('.kentekenplaat').val();

			if (licenseplate.length >= 6 ) {

				$.ajax({
				    url: "https://opendata.rdw.nl/resource/m9d7-ebf2.json",
				    type: "GET",
				    data: {
				      "kenteken" : licenseplate.toUpperCase(),
				      "$limit" : 5000,
				      "$$app_token" : '{{$RDW_APP_TOKEN}}',
				    }
				}).done(function(data) {
				  if (data[0] && licenseplate.length > 0) {
					  $('.warning').text('Let op: controleer en verbeter alle invoervelden')
				  }
				  $('#makeInput').val(sanitizeString(data[0]["merk"]))
				  $('#modelInput').val(sanitizeString(data[0]["handelsbenaming"]))
				  $('#cylinderInput').val(data[0]["aantal_cilinders"])
				  $('#doorInput').val(data[0]["aantal_deuren"])
				  $('#seatInput').val(data[0]["aantal_zitplaatsen"])
				  $('#capacityInput').val(data[0]["cilinderinhoud"])
				  $('#yearInput').val(data[0]["datum_eerste_toelating"].substring(0,4))
				  $('#colorInput').val(sanitizeString(data[0]["eerste_kleur"]))
				  $('#bodyInput').val(sanitizeString(data[0]["inrichting"]))
				  $('#licenseplateInput').val(data[0]["kenteken"])
				  $('#weightInput').val(data[0]["massa_ledig_voertuig"])

				  var year = data[0]["vervaldatum_apk"].substring(0,4)
				  var month = data[0]["vervaldatum_apk"].substring(4,6)
				  var day = data[0]["vervaldatum_apk"].substring(6,8)

				  $('#apkInput').val(day+"-"+month+"-"+year)

				  if($('#titleInput').val() == ""){
				  	$('#titleInput').val("Nette "+sanitizeString(data[0]["merk"])+" "+sanitizeString(data[0]["handelsbenaming"])+" uit "+data[0]["datum_eerste_toelating"].substring(0,4)+" te koop")
				  }

				  $.ajax({
				    url: "https://opendata.rdw.nl/resource/8ys7-d773.json",
				    type: "GET",
				    data: {
				      "kenteken" : licenseplate.toUpperCase(),
				      "$limit" : 5000,
				      "$$app_token" : '{{$RDW_APP_TOKEN}}',
				    }
				  }).done(function(data) {
				    console.log(data)
				    console.log(data.length)
				    if (data.length > 1) {
				    	if (data[0]["brandstof_omschrijving"] == "Elektriciteit" || data[1]["brandstof_omschrijving"] == "Elektriciteit") {
				    		$('#fuelInput').val("Hybride")
				    	}
				    } else {
				    	$('#fuelInput').val(data[0]["brandstof_omschrijving"])
				    }
				  });

				  console.log(data[0]["merk"]+" "+data[0]["handelsbenaming"]);
				  console.log(data);
				});

			}

		}))

		function sanitizeString(string) {
			var lowercase = string.toLowerCase();
			return lowercase.charAt(0).toUpperCase() + lowercase.slice(1);
		}
	</script>
@endsection
