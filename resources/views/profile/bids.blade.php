@extends('layouts.profile')

@section('profileSection')

	<h2 class="text-center">Mijn biedingen</h2>
	<div class="profile-bids">
		@foreach($bids as $bid)

			<div class="card" style="width: 18rem;">
			  <div class="card-body">
			    <h5 class="card-title">Geboden op: {{$bid['listing']['title']}}</h5>
			    <p class="card-text">Bedrag: {{$bid['amount']}}</p>
			    <p class="card-text">Datum: {{$bid['created_at']->format('d F Y')}}</p>
			    <a href="{{url('listing/'.$bid['listing']['id'])}}">Advertentie bekijken</a>
			  </div>
			</div>

		@endforeach
	</div>

@endsection
