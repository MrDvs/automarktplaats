@extends('layouts.default')

@section('content')
	@foreach($vehicles as $vehicle)
		<li>{{ $vehicle->make }} {{ $vehicle->model }} </li>
	@endforeach
@stop