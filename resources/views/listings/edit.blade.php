@extends('layouts.default')

@section('content')
	<form method="POST" action="{{url('/listing/'.$listing['id'])}}">
		@csrf
		@method('PUT')

		<div class="form-group">
			<label for="titleInput">Titel</label>
			<input type="text" id="titleInput" class="form-control" name="title" placeholder="Titel" value="{{$listing['title']}}">
		</div>

		<div class="form-group">
			<label for="descriptionInput">Advertentie beschrijving</label>
			<textarea name="description" id="descriptionInput" class="form-control" placeholder="Beschrijving" style="width: 100%">{{$listing['description']}}</textarea>
		</div>

		<button type="submit" class="btn btn-primary">Submit</button>

	</form>
@endsection