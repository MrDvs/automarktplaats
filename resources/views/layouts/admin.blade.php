@extends('layouts.default')

@section('content')
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="{{url('admin/users')}}" class="list-group-item list-group-item-action {{ request()->is('admin/users') ? 'active' : '' }}">Alle users</a>
              <a href="{{url('admin/listings')}}" class="list-group-item list-group-item-action {{ request()->is('admin/listings') ? 'active' : '' }}">Alle advertenties</a>
            </div>
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		        	@if ($errors->any())
						<div class="alert alert-danger text-center">
							<ul>
								@foreach ($errors->all() as $error)
									<h5>{{ $error }}</h5>
								@endforeach
							</ul>
						</div>
					@endif
		            @yield('adminPanel')
		        </div>
		    </div>
		</div>
	</div>
@endsection
