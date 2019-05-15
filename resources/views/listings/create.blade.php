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
@endsection
