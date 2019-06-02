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
						<input type="file" id="mainimgInput" class="form-control-file" name="mainImage" >
					</div>

					<div class="form-group">
						<label for="imgInput">Kies maximaal 5 afbeeldingen</label>
						<input type="file" id="imgInput" class="form-control-file" name="extraImages[]" multiple>
					</div>

					<div class="form-group">
						<label for="titleInput">Advertentie titel</label>
						<input type="text" id="titleInput" class="form-control" name="title" {{-- onkeypress="charCount('#titleInput')" --}} placeholder="Titel" maxlength="191" >
						{{-- <span class="counter">0</span>/191 --}}
					</div>

					<div class="form-group">
						<label for="descriptionInput">Advertentie beschrijving</label>
						{{-- <input type="text" id="descriptionInput" class="form-control" name="description" placeholder="Beschrijving" maxlength="191" required> --}}
						<textarea name="description" id="descriptionInput" class="form-control" placeholder="Beschrijving" style="width: 100%" ></textarea>
					</div>

					<div class="form-group">
						<label for="priceInput">Begin prijs</label>
						<input type="number" id="priceInput" class="form-control" name="price" >
					</div>

				</div>
				<div class="col-md-5">

					<h3 class="text-center">Voertuig informatie:</h3>
					<hr>

					<h2 class="text-center">Voer hier je kenteken in:</h2>
					<div class="kenteken-container" style="width: 150px; margin: auto; padding-bottom: 2vh">
						<input type="text" class="kentekenplaat">
					</div>
					<span class="warning"></span>

					<div class="form-group">
						<label for="makeInput">Merk</label>
						<input type="text" id="makeInput" class="form-control" name="make" placeholder="merk" >
					</div>

					<div class="form-group">
						<label for="modelInput">Model</label>
						<input type="text" id="modelInput" class="form-control" name="model" placeholder="model" >
					</div>
					<hr>

					<div class="form-group">
						<label for="mileageInput">Kilometer stand</label>
						<input type="number" id="mileageInput" class="form-control" name="mileage" placeholder="Kilometer stand" >
					</div>

					<div class="form-group">
						<label for="licenseplateInput">Kenteken</label>
						<input type="text" id="licenseplateInput" class="form-control" name="licenseplate" placeholder="Kenteken" >
					</div>

					<div class="form-group">
						<label for="yearInput">Bouwjaar</label>
						<input type="text" id="yearInput" class="form-control" name="year" placeholder="Bouwjaar">
					</div>

					<div class="form-group">
						<label for="colorInput">Kleur</label>
						<input type="text" id="colorInput" class="form-control" name="color" placeholder="Kleur">
					</div>

					<div class="form-group">
						<label for="stateInput">Staat</label>
						<select class="form-control" name="state" class="custom-select" id="stateInput">
						  <option value="U" selected>Gebruikt</option>
						  <option value="N">Nieuw</option>
						</select>
					</div>

					<div class="form-group">
						<label for="bodyInput">Carroserie</label>
						<input type="text" id="bodyInput" class="form-control" name="body" placeholder="Carroserie">
					</div>

					<div class="form-group">
						<label for="apkInput">APK vervaldatum</label>
						<input type="text" id="apkInput" class="form-control" name="apk" placeholder="APK vervaldatum">
					</div>

					<div class="form-group">
						<label for="transmissionInput">Type versnellingsbak</label>
						<input type="text" id="transmissionInput" class="form-control" name="transmission" placeholder="Type versnellingsbak">
					</div>

					<div class="form-group">
						<label for="gearInput">Aantal versnellingen</label>
						<input type="number" id="gearInput" class="form-control" name="gear" placeholder="Aantal versnellingen">
					</div>

					<div class="form-group">
						<label for="capacityInput">Motor inhoud</label>
						<input type="number" id="capacityInput" class="form-control" name="capacity" placeholder="Motor inhoud">
					</div>

					<div class="form-group">
						<label for="cylinderInput">Aantal cilinders</label>
						<input type="number" id="cylinderInput" class="form-control" name="cylinder" placeholder="Aantal cilinders">
					</div>

					<div class="form-group">
						<label for="weightInput">Leeggewicht</label>
						<input type="number" id="weightInput" class="form-control" name="weight" placeholder="Leeggewicht">
					</div>

					<div class="form-group">
						<label for="driveInput">Aandrijving</label>
						<input type="text" id="driveInput" class="form-control" name="drive" placeholder="Aandrijving">
					</div>

					<div class="form-group">
						<label for="fuelInput">Brandstof</label>
						<select name="fuel" id="fuelInput" class="custom-select">
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
						<input type="number" id="doorInput" class="form-control" name="door" placeholder="Aantal deuren">
					</div>

					<div class="form-group">
						<label for="seatInput">Aantal zitplaatsen</label>
						<input type="number" id="seatInput" class="form-control" name="seat" placeholder="Aantal zitplaatsen">
					</div>

					<div class="form-group">
						<label for="powerInput">Vermogen (pk)</label>
						<input type="number" id="powerInput" class="form-control" name="power" placeholder="Vermogen">
					</div>

				</div>
			</div>

			<button type="submit">Plaats advertentie</button>
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
				      "$$app_token" : '{{$RDW_APP_TOKEN}}'
				    }
				}).done(function(data) {
				  if (data[0] && licenseplate.length > 0) {
					  $('.warning').text('Let op: controleer en verbeter alle invoervelden')
				  }
				  $('#makeInput').val(data[0]["merk"])
				  $('#modelInput').val(data[0]["handelsbenaming"])
				  $('#cylinderInput').val(data[0]["aantal_cilinders"])
				  $('#doorInput').val(data[0]["aantal_deuren"])
				  $('#seatInput').val(data[0]["aantal_zitplaatsen"])
				  $('#capacityInput').val(data[0]["cilinderinhoud"])
				  $('#yearInput').val(data[0]["datum_eerste_toelating"].substring(0,4))
				  $('#colorInput').val(data[0]["eerste_kleur"])
				  $('#bodyInput').val(data[0]["inrichting"])
				  $('#licenseplateInput').val(data[0]["kenteken"])
				  $('#weightInput').val(data[0]["massa_ledig_voertuig"])

				  var year = data[0]["vervaldatum_apk"].substring(0,4)
				  var month = data[0]["vervaldatum_apk"].substring(4,6)
				  var day = data[0]["vervaldatum_apk"].substring(6,8)

				  $('#apkInput').val(day+"-"+month+"-"+year)

				  if($('#titleInput').val() == ""){
				  	$('#titleInput').val("Nette "+data[0]["merk"]+" "+data[0]["handelsbenaming"]+" uit "+data[0]["datum_eerste_toelating"].substring(0,4)+" te koop")
				  }

				  $.ajax({
				    url: "https://opendata.rdw.nl/resource/8ys7-d773.json",
				    type: "GET",
				    data: {
				      "kenteken" : licenseplate.toUpperCase(),
				      "$limit" : 5000,
				      "$$app_token" : '{{$RDW_APP_TOKEN}}'
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
	</script>
@endsection
