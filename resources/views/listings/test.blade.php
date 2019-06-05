@extends('layouts.default')

@section('content')



<div class="row">

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







{{-- <form action="{{ url('listing') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="mainimgInput">Hoofd afbeelding</label>
		<input type="file" id="mainimgInput" class="form-control-file" name="mainImage">
	</div>

	<div class="form-group">
		<label for="imgInput">Kies maximaal 5 afbeeldingen</label>
		<input type="file" id="imgInput" class="form-control-file" name="images[]" multiple>
	</div>

	<button type="submit">Plaats advertentie</button>
</form> --}}

{{-- <div class="bg-info clearfix" style="border: 1px solid red">
  <button type="button" class="btn btn-secondary float-left">Example Button floated left</button>
  <button type="button" class="btn btn-secondary float-right">Example Button floated right</button>
</div> --}}

<script>
	// function myFunction(){
	//   var x = document.getElementById("imgInput");
	//   var txt = "";
	//   console.log(x)
	//   if ('files' in x) {
	//   	console.log('ja')
	//     if (x.files.length == 0) {
	//       txt = "Select one or more files.";
	//     } else {
	//       for (var i = 0; i < x.files.length; i++) {
	//         txt += "<br><strong>" + (i+1) + ". file</strong><br>";
	//         var file = x.files[i];
	//         if ('name' in file) {
	//           txt += "name: " + file.name + "<br>";
	//         }
	//         if ('size' in file) {
	//           txt += "size: " + file.size + " bytes <br>";
	//         }
	//       }
	//     }
	//   } 
	//   else {
	//   	console.log('nee')
	//     if (x.value == "") {
	//       txt += "Select one or more files.";
	//     } else {
	//       txt += "The files property is not supported by your browser!";
	//       txt  += "<br>The path of the selected file: " + x.value;
	//     }
	//   }
	//   console.log(txt);
	// }

	$("#imgInput").on('change', function() {
		var x = document.getElementById("imgInput");
		console.log(x);
		if('files' in x) {
			console.log(x.files.length);
		} else {
			console.log('nein');
		}
	});
</script>
@endsection