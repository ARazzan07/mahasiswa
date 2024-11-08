@extends('layout.menu')
	@section('konten')
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Document</title>
			@vite(['resources/js/app.js', 'resources/css/app.css'])
		</head>
		<body>
		@if (Auth::check() && Auth::user()->level == 'admin')
    
    	<p>Welcome, Admin!</p>
		@elseif (Auth::guest())
    
    	<p>Silakan login untuk melanjutkan.</p>
		<a href="{{ route('login') }}" class="btn btn-primary" title="Login"><i class="far fa-plus-square"></i> &nbsp;Login</a>
		@endif
		
		</body>
		</html>
	@endsection
