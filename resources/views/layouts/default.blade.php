<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	{{-- gets the title from the .env file --}}
	<title>{{ config('app.name', 'Laravel') }}</title>
	
	{{-- Load in the stylesheets --}}
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	{{-- Load in Bootstrap JS --}}
	<script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">AutoMarktplaats</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		  <li class="nav-item active">
			<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Kopen</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Verkopen</a>
		  </li>
		</ul>
	  </div>
	</nav>

	<div class="container">
		@yield('content')
	</div>
</body>
</html>