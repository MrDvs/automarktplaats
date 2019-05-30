@extends('layouts.default')

@section('content')
<form action="{{ url('listing') }}" method="POST" enctype="multipart/form-data">
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
</form>

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