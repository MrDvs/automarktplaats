@extends('layouts.profile')

@section('profileSection')

	<h2 class="text-center">Mijn advertenties</h2>

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

				<div class="listing-preview-img">
					<img src="{{ asset('storage/'.$listing['image']) }}" alt="{{$listing['vehicle']['make'].' '.$listing['vehicle']['model'] }}">
				</div>

				<div class="description">
					<h5>Beschrijving: {{$listing['description']}}</h5>
				</div>

				<div class="starting-price">
					<h5>Begin prijs: €{{$listing['starting_price']}}</h5>
				</div>

				<div class="bids">
					<h5>Aantal biedingen: {{count($listing['bids'])}}</h5>
					@if(count($listing['bids']))
						<h5>Hoogste bod: €{{$listing['highest_bid']}}</h5>
					@endif
				</div>

				<div class="listing-buttons">
					<a href="{{ url('listing/'.$listing->id) }}" class="btn btn-primary">Bekijken</a>
					<a href="{{ url('listing/'.$listing->id.'/edit') }}" class="btn btn-success">Bewerken</a>
					<a class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('remove-form-{{$listing['id']}}').submit();">Verwijderen</a>
					<form id="remove-form-{{$listing['id']}}" action="{{url('listing/'.$listing->id)}}" method="POST" style="display: none;">
						@csrf
						@method('DELETE')
					</form>
				</div>

			</li>
		@endforeach
	</ul>
		            
@endsection