@extends('layouts.default')

@section('content')

	@if(session()->has('succes-message'))
		<div class="alert alert-success text-center">
		    {{ session()->get('succes-message') }}
		</div>
	@endif
	@if(session()->has('error-message'))
		<div class="alert alert-danger text-center">
		    {{ session()->get('error-message') }}
		</div>
	@endif
	@if(isset($filteredOn))
	<h4 class="text-center">{!! $filteredOn !!}</h4>
	@endif

	<ul id="listing-index-ul">
		{{-- List each listing and basic information --}}
		@foreach($listings as $listing)
			<li class="listing-index-li" id="listing-{{ $listing->id }}">
				<div class="row title-row">

					<div class="title">
						<h4>
							<span class="bold">{{$listing['vehicle']['make'].' '.$listing['vehicle']['model'] }}</span> <br>
							{{ $listing['title'] }}
						</h4>
					</div>

				</div>

				<div class="row listing-row">

					<div class="col-md-5 listing-col">

						<div class="listing-preview-img">
							<img src="{{ asset('storage/'.$listing['images'][0]->img_path) }}" alt="{{$listing['vehicle']['make'].' '.$listing['vehicle']['model'] }}">
						</div>

					</div>

					<div class="col-md-7 listing-col">

						<div class="starting-price">
							<h5>Richt prijs: €{{$listing['starting_price']}}</h5>
						</div>
						<hr>
						<div class="highest-bid">
							@if(count($listing['bids']))
							<h5>Hoogste bod: €{{$listing['bids'][0]['amount']}}</h5>
							@else
							<h5>Er is nog niet geboden op deze advertentie. Breng het eerste bod uit!</h5>
							@endif
						</div>
						<hr>
						<div class="description">
							<h5>Beschrijving: {{$listing['short_description']}}</h5>
						</div>
						<hr>
						<div class="favorited">
							<i class="fas fa-star"></i>
							X {{$listing['favorited']}}
						</div>

					</div>

					<a href="{{ url('listing/'.$listing->id) }}" class="btn btn-primary" style="margin-top: 5px">Meer informatie ></a>

				</div>
			</li>
		@endforeach
	</ul>

	{{$listings->links()}}

@endsection
