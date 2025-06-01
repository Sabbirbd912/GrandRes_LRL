<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Admin Dashboard</title>
		<!-- Favicon icon Eatio -->
		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logo.png')}}">
		<link href="{{asset('assets/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('assets/vendor/chartist/css/chartist.min.css')}}">
		<link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
		<link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
		<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
		
		@stack('styles')
	</head>

	<body>

		<!--*******************
			Preloader start
		********************-->
		<div id="preloader">
			<div class="sk-three-bounce">
				<div class="sk-child sk-bounce1"></div>
				<div class="sk-child sk-bounce2"></div>
				<div class="sk-child sk-bounce3"></div>
			</div>
		</div>
		<!--*******************
			Preloader end
		********************-->