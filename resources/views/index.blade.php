@extends('layouts.default')

@section('content')
	<h1 class="text-center">Welkom op AutoMarktplaats!</h1>
	<h3 class="text-center">Dé website voor het vinden van jouw droom auto.</h3>

	<h4>Op dit moment hebben wij {{count($listings)}} voertuigen te koop staan.</h4>
	<div class="row">
		<form action="{{url('listing/zoeken')}}" method="POST">
			@csrf
			Merk:
			<select name="make" id="">
				<option value="make|">Alle</option>
				@foreach($makes as $make)
				<option value="make|{{$make['make']}}">{{$make['make']}}</option>
				@endforeach
			</select>
			Model:
			<select name="model" id="">
				<option value="model|">Alle</option>
				@foreach($models as $model)
				<option value="model|{{$model['model']}}">{{$model['model']}}</option>
				@endforeach
			</select>
			<button type="submit">Zoeken</button>
		</form>
	</div>
	<div id="app">
        <search-form></search-form>
    </div>
@stop

