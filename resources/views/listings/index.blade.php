@extends('layouts.default')

@section('content')
	<ul id="listing-index-ul">
		{{-- List each listing and basic information --}}
		@foreach($listings as $listing)
			<li class="listing-index-li" id="listing-{{ $listing->id }}">

				<div class="title">
					<h4>Title: {{ $listing['title'] }}</h4>
				</div>

				<div class="description">
					<h5>Description: {{$listing['description']}}</h5>
				</div>

				<div class="starting-price">
					<h5>Starting price: {{$listing['starting_price']}}</h5>
				</div>

				<a href="{{ url('listing/'.$listing->id) }}">More information ></a>

			</li>
		@endforeach
	</ul>
@endsection
