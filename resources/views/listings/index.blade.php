@extends('layouts.default')

@section('content')
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
							<img src="{{ $listing['img_path'] }}" alt="{{$listing['vehicle']['make'].' '.$listing['vehicle']['model'] }}">
						</div>

					</div>

					<div class="col-md-7 listing-col">
					
						<div class="description">
							<h5>Beschrijving: {{$listing['description']}}</h5>
						</div>

						<div class="starting-price">
							<h5>Begin prijs: {{$listing['starting_price']}}</h5>
						</div>

					</div>

					<a href="{{ url('listing/'.$listing->id) }}">Meer informatie ></a>

				</div>
			</li>
		@endforeach
	</ul>
@endsection
