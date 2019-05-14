@extends('layouts.default')

@section('content')
	@foreach($listings as $listing)
		{{print_r($listing)}}
	@endforeach
@endsection
