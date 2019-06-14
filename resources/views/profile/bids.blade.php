@extends('layouts.profile')

@section('profileSection')

	<h2 class="text-center">Mijn biedingen</h2>
	<div class="profile-bids">
		@foreach($bids as $bid)
			{{-- {{$bid}} --}}
			Datum: {{$bid['created_at']->format('d F Y')}} <br>
			Bedrag: {{$bid['amount']}} <br>
			Geboden op: {{$bid['listing']['title']}} <br>
			<a href="{{url('listing/'.$bid['listing']['id'])}}">Advertentie bekijken</a>
		@endforeach
	</div>
		            
@endsection