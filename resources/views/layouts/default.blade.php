<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	{{-- gets the title from the .env file --}}
	<title>{{ config('app.name', 'Laravel') }}</title>
	
	{{-- Load in the stylesheets --}}
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
</body>
</html>