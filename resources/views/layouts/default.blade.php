<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- gets the title from the .env file --}}
	<title>{{ config('app.name', 'Laravel') }}</title>

	{{-- Load in the stylesheets --}}
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	{{-- Load in Bootstrap JS --}}
	<script src="{{ asset('js/app.js') }}" defer></script>

	{{-- Font awesome --}}
	<script src="https://kit.fontawesome.com/455bbfd2fc.js"></script>

	{{-- Geef een csrf token mee met elke pagina --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>
<body>

	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
			  <a class="navbar-brand" href="{{ route('index') }}">AutoMarktplaats</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
				  <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
				  </li>
				  <li class="nav-item {{ request()->is('listing') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('listing.index') }}">Kopen</a>
				  </li>
				  <li class="nav-item {{ request()->is('listing/create') ? 'active' : '' }}">
					<a class="nav-link" href="{{ route('listing.create') }}">Verkopen</a>
				  </li>
				</ul>
			  </div>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle {{ request()->is('profiel*') ? 'active' : '' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('profiel') }}">
	                                    Profiel
                                    </a>
									<a class="dropdown-item" href="{{ route('chat') }}">
	                                    Chat
                                    </a>
									@if(Auth::user()->is_admin)
                                    <a class="dropdown-item" href="{{ route('admin') }}">
	                                    Admin panel
                                    </a>
									@endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
			</div>
		</nav>
	</header>

	<div class="container">
		@yield('content')
	</div>

	{{-- <script>
		$('.carousel').carousel()
	</script> --}}

</body>
</html>
