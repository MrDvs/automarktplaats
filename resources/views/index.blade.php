@extends('layouts.default')

@section('content')
	<h1 class="text-center">Welkom op AutoMarktplaats!</h1>
	<h3 class="text-center">Dé website voor het vinden van jouw droom auto.</h3>

	<h4 class="text-center">Op dit moment hebben wij {{count($listings)}} voertuigen te koop staan.</h4>
	{{-- <div class="row">
		<form action="{{url('listing/zoeken')}}" method="POST">
			@csrf
			Merk:
			<select name="make">
				<option value="make|">Alle</option>
				@foreach($makes as $make)
				<option value="make|{{$make['make']}}">{{$make['make']}}</option>
				@endforeach
			</select>
			Model:
			<select name="model">
				<option value="model|">Alle</option>
				@foreach($models as $model)
				<option value="model|{{$model['model']}}">{{$model['model']}}</option>
				@endforeach
			</select>
			<button type="submit">Zoeken</button>
		</form>
	</div> --}}
	<div id="app">
        <search-form></search-form>
        <hr>
    </div>
    <h3 class="text-center">Uitgelichte advertenties</h3>
    <div class="row" style="margin-left: 85px; text-align: center;">
		@foreach($highlighted as $highlight)
			<a href="{{'listing/'.$highlight['id']}}" style="color: #000">
				<div class="card" id="{{$highlight['id']}}" style="height: 400px;width: 18rem; margin: 15px; float: left;">
				  <img class="card-img-top" src="{{ asset('storage/'.$highlight['image']) }}" alt="Card image cap">
				  <div class="card-body">
				    <h5 class="card-title">{{ $highlight['vehicle']['make'] }} {{$highlight['vehicle']['model']}}</h5>
					<ul class="list-group list-group-flush">
					    <li class="list-group-item">{{$highlight['title']}}</li>
					    <li class="list-group-item">€{{$highlight['starting_price']}}</li>
					    <li class="list-group-item">{{$highlight['expiration_date']}}</li>
					</ul>

				  </div>
				</div>
			</a>
		@endforeach
    </div>
@stop

