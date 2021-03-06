<!DOCTYPE html>

<html lang="en">

<head id="Starter-Site">

	<meta charset="UTF-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
		@section('title')
			Administration
		@show
	</title>

	<meta name="keywords" content="@yield('keywords')" />
	<meta name="author" content="@yield('author')" />
	<!-- Google will often use this as its description of your page/site. Make it good. -->
	<meta name="description" content="@yield('description')" />

	<!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->
	<meta name="google-site-verification" content="">

	<!-- Dublin Core Metadata : http://dublincore.org/ -->
	<meta name="DC.title" content="Project Name">
	<meta name="DC.subject" content="@yield('description')">
	<meta name="DC.creator" content="@yield('author')">

	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<!-- This is the traditional favicon.
	 - size: 16x16 or 32x32
	 - transparency is OK
	 - see wikipedia for info on browser support: http://mky.be/favicon/ -->
	<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">

	<!-- iOS favicons. -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
	<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

	<!-- CSS -->
    {{ Basset::show('admin.css') }}

	<style>
	body {
		padding: 60px 0;
	}
	</style>

	@yield('styles')
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	<script type="text/javascript">
		var _gaq = _gaq || [];
	  	_gaq.push(['_setAccount', 'UA-31122385-3']);
	  	_gaq.push(['_trackPageview']);

	  	(function() {
	   		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  	})();

	</script> -->

</head>

<body>
	<!-- Container -->
	<div class="container">
		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><i class="icon-home icon-white"></i> Home</a></li>
							<li{{ (Request::is('admin/blogs*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/blogs') }}}"><i class="icon-list-alt icon-white"></i> Blog</a></li>
							<li{{ (Request::is('admin/comments*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/comments') }}}"><i class="icon-bullhorn icon-white"></i> Comments</a></li>
							<li class="dropdown{{ (Request::is('admin/users*|admin/roles*') ? ' active' : '') }}">
								<a class="dropdown-toggle" data-toggle="dropdown" href="{{{ URL::to('admin/users') }}}">
									<i class="icon-user icon-white"></i> Users <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li{{ (Request::is('admin/users*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/users') }}}"><i class="icon-user"></i> Users</a></li>
									<li{{ (Request::is('admin/roles*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/roles') }}}"><i class="icon-user"></i> Roles</a></li>
								</ul>
							</li>
							<li{{ (Request::is('admin/advertisers*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/advertisers') }}}"><i class="icon-arrow-down icon-white"></i> Advertisers</a></li>
							<li{{ (Request::is('admin/types*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/types') }}}"><i class="icon-arrow-down icon-white"></i> Types</a></li>
							<li{{ (Request::is('admin/ads*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/ads') }}}"><i class="icon-arrow-down icon-white"></i> Ads</a></li>		
							<li{{ (Request::is('admin/organizations*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/organizations') }}}"><i class="icon-arrow-down icon-white"></i> Organizations</a></li>	
							<li{{ (Request::is('admin/interactions*') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin/interactions') }}}"><i class="icon-arrow-down icon-white"></i> Interactions</a></li>	
						</ul>
						<ul class="nav pull-right">
							<li><a href="{{{ URL::to('/') }}}">View Homepage</a></li>
							<li class="divider-vertical"></li>
							<li>
								<div class="btn-group">
									<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="icon-user"></i> {{{ Auth::user()->username }}}	<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="{{{ URL::to('user/settings') }}}"><i class="icon-wrench"></i> Settings</a></li>
										<li class="divider"></li>
										<li><a href="{{{ URL::to('user/logout') }}}"><i class="icon-share"></i> Logout</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
					<!-- ./ nav-collapse -->
				</div>
				<!-- ./ container-fluid -->
			</div>
			<!-- ./ navbar-inner -->
		</div>
		<!-- ./ navbar -->

		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
		<!-- ./ Footer -->

	</div>
	<!-- ./ container -->

	<!-- Javascripts -->
    {{ Basset::show('admin.js') }}

    <script type="text/javascript">
    	$('.wysihtml5').wysihtml5();
        $(prettyPrint);
    </script>

    @yield('scripts')

</body>

</html>