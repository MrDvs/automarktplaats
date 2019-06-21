@extends('layouts.admin')

@section('adminPanel')
@foreach($users as $user)
	{{-- checked of de huidige foreach user de ingelogde user is, zo ja slaat hij deze over --}}
	@if($user->id == Auth::id())
		@continue
	@endif
	<div class="card" style="">
	  <div class="card-body">
	    <h5 class="card-title">Naam: {{$user->name}}</h5>
	    <ul class="list-group list-group-flush" id="ul-{{$user->id}}">
          <li class="list-group-item">Telefoon: {{@$user->phone}}</li>
          <li class="list-group-item">Email: {{$user->email}}</li>
          <li class="list-group-item">Postcode en plaats: {{@$user->zipcode}} {{@$user->city}}</li>
          <li class="list-group-item">Straat, huisnummer en toevoeging: {{@$user->street}} {{@$user->street_number}} {{@$street_suffix}}</li>
          <li class="list-group-item">Geregistreerd op: {{$user->created_at}}</li>
	    </ul>

	    <form action="{{url('profiel/'.$user->id)}}" method="POST" id="form-{{$user->id}}" style="display: none;">
			@csrf
			@method('PUT')

			<div class="form-group row">
				<label class="col-sm-2 col-form-label" for="nameInput">Naam</label>
				<div class="col-sm-10">
					<input type="text" id="nameInput" class="form-control" name="name" placeholder="Naam" value="{{$user->name}}">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label" for="phoneInput">Telefoon</label>
				<div class="col-sm-10">
					<input type="text" id="phoneInput" class="form-control" name="phone" placeholder="Telefoon" value="{{$user->phone}}">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label" for="zipcodeInput">Postcode en plaats</label>
				<div class="col-sm-3">
					<input type="text" id="zipcodeInput" class="form-control" name="zipcode" placeholder="Postcode" value="{{$user->zipcode}}">
				</div>
				<div class="col-sm-7">
					<input type="text" id="cityInput" class="form-control" name="city" placeholder="Plaats" value="{{$user->city}}">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label" for="streetInput">Straat en huisnummer</label>
				<div class="col-sm-6">
					<input type="text" id="streetInput" class="form-control" name="street" placeholder="Straatnaam" value="{{$user->street}}">
				</div>
				<div class="col-sm-2">
					<input type="text" id="housenumberInput" class="form-control" name="housenumber" placeholder="Huisnummer" value="{{$user->street_number}}">
				</div>
				<div class="col-sm-2">
					<input type="text" id="housenumberSuffixInput" class="form-control" name="housenumberSuffix" placeholder="Toevoeging" value="{{$user->street_suffix}}">
				</div>
			</div>

			<button type="submit" class="btn btn-primary">Opslaan</button>
		</form>

	    <button onclick="editUser({{$user->id}})" class="btn btn-primary">Bewerken</button>
	    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeModal">
			Verwijderen
		</button>

		<!-- Modal -->
		<div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Waarschuwing</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Weet je zeker dat je {{$user->name}} wilt verwijderen? Deze user zal permanent verwijderd worden.
		      </div>
		      <div class="modal-footer">

		        <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();" data-dismiss="modal">Ja</button>

		        <form id="delete-form" action="{{ url('profiel/delete/'.$user->id) }}" method="POST" style="display: none;">
	                @csrf
	                @method('delete')
	            </form>

		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Nee</button>
		      </div>
		    </div>
		  </div>
		</div>
	  </div>
	</div>
@endforeach

<script>
	function editUser(id) {
		var ul = '#ul-'+id;
		var form = '#form-'+id;
		$(ul).css('display', 'none');
		$(form).css('display', 'block');
	}

</script>

@endsection
