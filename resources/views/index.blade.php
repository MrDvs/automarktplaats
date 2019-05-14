@extends('layouts.default')

@section('content')
	@foreach($vehicles as $vehicle)
		<li> {{print_r($vehicle)}} </li>
	@endforeach
@stop
