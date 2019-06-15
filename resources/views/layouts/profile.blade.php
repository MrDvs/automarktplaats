@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="{{url('profiel')}}" class="list-group-item list-group-item-action {{ request()->is('profiel') ? 'active' : '' }}">Mijn gegevens</a>
              <a href="{{url('profiel/advertenties')}}" class="list-group-item list-group-item-action {{ request()->is('profiel/advertenties') ? 'active' : '' }}">Mijn advertenties</a>
              <a href="{{url('profiel/biedingen')}}" class="list-group-item list-group-item-action {{ request()->is('profiel/biedingen') ? 'active' : '' }}">Mijn Biedingen</a>
              <a href="{{url('profiel/favorieten')}}" class="list-group-item list-group-item-action {{ request()->is('profiel/favorieten') ? 'active' : '' }}">Mijn Favorieten</a>
            </div> 
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            @yield('profileSection')
		        </div>
		    </div>
		</div>
	</div>
@endsection