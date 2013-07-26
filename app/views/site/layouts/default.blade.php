<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Project Charity
			@show
		</title>
		<meta name="keywords" content="your, awesome, keywords, here" />
		<meta name="author" content="Jon Doe" />
		<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />

		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- CSS
		================================================== -->
        {{ Basset::show('public.css') }}

		<style>
		@section('styles')
		@show
		</style>
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Favicons
		================================================== -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>

	<body>
		<!-- To make sticky footer need to wrap in a div -->
		<div id="wrap">
		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
		  	<div class="navbar-inner">
		  		<div class="container">
			    	<a href="{{{ URL::to('') }}}" class="brand" href="#">Project Charity</a>
			    	<ul class="nav pull-right">
			    		<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>	 
						   @if (Auth::check())
			               @if (Auth::user()->hasRole('admin'))
						   <li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
			               @endif
						   <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
						   <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
						   @else
						   <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
						   @endif         
					<!--    <li {{ (Request::is('blog') ? ' class="active"' : '') }}><a href="{{{ URL::to('blog') }}}">Blog</a></li> -->
						<li {{ (Request::is('contact-us') ? ' class="active"' : '') }}><a href="{{{ URL::to('contact-us') }}}">Contact Us</a></li>
					</ul>
				</div>
			</div> <!-- ./ navbar-inner -->
		</div> <!-- ./ navbar -->

		<!-- Grabber -->
			@yield('grabber')
			<!-- ./ Grabber -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>
		<!-- ./ container -->

		<!-- the following div is needed to make a sticky footer -->
		<div id="push"></div>
		</div>
		<!-- ./wrap -->

		
	    <div id="footer">
	      <div class="container">
	      		<hr class="featurette-divider">
	      		<p class="pull-right"><a href="#">Back to top</a></p>
	      		<p>
	      			<a href="#" ><i class="icon-twitter-sign icon-2x"></i></a>
	      			<a href="#" ><i class="icon-facebook-sign icon-2x"></i></a>
	      			<a href="#" ><i class="icon-envelope icon-2x"></i></a>
	      			<a href="#" ><i class="icon-linkedin-sign icon-2x"></i></a>
	      			&middot; &copy; 2013 Project Charity 
	      		</p>
	      </div>
	    </div>

		<!-- Javascripts
		================================================== -->
        {{ Basset::show('public.js') }}
        <script>
  			$(document).ready(function(){
			    $('.carousel').carousel({
			      interval: 4000
			    });
			});
		</script>
	</body>
</html>
