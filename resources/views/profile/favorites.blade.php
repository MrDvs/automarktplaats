@extends('layouts.profile')

@section('profileSection')

	<h2 class="text-center">Mijn favoriete advertenties</h2>
	<div class="profile-favorite-listings">
		@foreach($favorites as $favorite)
			<div class="card" id="{{$favorite['id']}}" style="width: 18rem; margin: 15px; float: left;">
			  <img class="card-img-top" src="{{ asset('storage/'.$favorite['image']) }}" alt="Card image cap">
			  <div class="card-body">
			    <h5 class="card-title">{{ $favorite['listing']['title'] }}</h5>
			    <a href="{{'listing/'.$favorite['listing_id']}}" class="btn btn-primary">Bekijken</a>
			    <button onclick="removeFavorite({{$favorite['user_id']}}, {{$favorite['listing_id']}}, {{$favorite['id']}})" class="btn btn-danger">Verwijderen</button>
			  </div>
			</div>
		@endforeach
	</div>

	<script>
		function removeFavorite(userId, listingId, hideId) {
			$.ajax({
			    url: "http://localhost/automarktplaats/public/removeFavorite",
			    type: "GET",
			    data: {
			    	"userId" : userId,
			    	"listingId" : listingId
			    }
			}).done(function() {
			    $('#'+hideId).css('display', 'none');
			});
		}
	</script>
		            
@endsection