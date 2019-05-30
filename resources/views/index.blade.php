@extends('layouts.default')

@section('content')
	<h1 class="text-center">Welkom op AutoMarktplaats!</h1>
	<h3 class="text-center">Dé website voor het vinden van jouw droom auto.</h3>

	<h4>Op dit moment hebben wij {{count($listings)}} voertuigen te koop staan.</h4>
	<div class="row">
		<form action="">
			Merk: 
			<select name="" id="">
				@foreach($makes as $make)
				<option value="{{$make['make']}}">{{$make['make']}}</option>
				@endforeach
			</select>
			Model:
			<select name="" id="">
				@foreach($models as $model)
				<option value="{{$model['model']}}">{{$model['model']}}</option>
				@endforeach
			</select> 
		</form>
	</div>
@stop

