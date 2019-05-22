@extends('layouts.default')

@section('content')
	<h1 class="text-center">List your vehicle</h1>
	<form action="{{ url('listing') }}" method="POST">

		{{-- De csrf token beschermd tegen cross-site request forgery --}}
		{{ csrf_field() }}

		<h4>Listing information:</h4>
		<hr>

		Title: 
		<input type="text" name="title" placeholder="Listing title" required>
		<br><br>

		Description: 
		<input type="text" name="description" placeholder="Listing description" required>
		<br><br>

		Starting price: 
		<input type="text" name="price" placeholder="Vehicle price" required>
		<br><br>

		<h4>Your vehicle:</h4>
		<hr>

		Make: 
		<input type="text" name="make" placeholder="Vehicle make" required>
		<br><br>

		Model: 
		<input type="text" name="model" placeholder="Vehicle model" required>
		<br><br>

		<button type="submit">Create Listing</button>
	</form>
	<div class="container">
		<input type="text" name="licenseplate" class="licenseplate" id="licenseplate" maxlength="7" placeholder="06JFZ7"/>
	</div>
	<script>
		$('#licenseplate').on('keyup', (function() {

			// ajax request
			var licenseplate = $('#licenseplate').val();

			$.ajax({
			    url: "https://opendata.rdw.nl/resource/m9d7-ebf2.json",
			    type: "GET",
			    data: {
			      "kenteken" : licenseplate.toUpperCase(),
			      "$limit" : 5000,
			      "$$app_token" : {{$RDW_APP_TOKEN}}
			    }
			}).done(function(data) {
			  alert(data[0]["merk"]+" "+data[0]["handelsbenaming"]);
			  console.log(data);
			});

		}))
	</script>
@endsection
