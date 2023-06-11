<!DOCTYPE HTML>
@php

include_once("/var/www/web/config.php");
// include_once(WEB_SV_PATH . "components/_fnctn.php");

@endphp
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
		<link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">
		<link rel="stylesheet" href="{{asset('css/custom.css')}}" type="text/css">
		<script src="{{ asset('js/app.js') }}" defer></script>
		<script type="text/javascript" src="{{ asset('js/utility.js') }}"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		
		
		<title>{{config('app.name', 'Rextrus.com')}}</title>


	</head>

	<body class="d-flex flex-column min-vh-100">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


		@include('inc.navbar')
		<div class="container" style="margin-top: 25px;">

			@yield('content')
		</div>

		@include('inc.footer')
	</body>
</html>