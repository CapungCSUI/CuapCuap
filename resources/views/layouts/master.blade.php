<!DOCTYPE html>
<html>
<head>
	@section('head')
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
	@show

	<title>CuapCuap &middot; @yield('title')</title>

	@section('external-resource')
		<link rel="stylesheet" href="{!! asset('/css/kickstart.min.css') !!}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	@show

	<style>
		@section('internal-css')
			@font-face {
			    font-family: 'DroidSerif-Regular';
			    src: url('/fonts/DroidSerif-Regular.ttf');
			}

			#header {
				overflow: hidden;
			    position: relative;
			    width: 100%;
				border-bottom: 2px solid #3B8EE3;
				padding: 1em;
				padding-bottom: 0;
				margin-bottom: 1em;
			}

			#header img {
				margin:0 2em;
			}

			#header-background {
				position: absolute;
	    		z-index: -1;
	    		top:0;
	    		height:0;
	    		margin-left: -1em;
				width:100%;
				height:100%;
				background: #666 url('/img/bg.jpg') center no-repeat;
				filter: brightness(50%);
				-webkit-filter: brightness(50%);
				background-size: cover
			}

			img.logo {
 				max-width: 85%;
 				max-height: 100px;
 				height: auto;
  			}

			#footer {
				width: 100%;
				margin: 0 auto;
				margin-top: 1em;	
				padding: 0;
				text-align: center;
				background: #3e3e3e;
				border-top: none;
			}

			#footer-logo {
				background: #FFF;
				width: 100%;
				height: 5em;
				padding: 0;
				margin: 0 auto 5em auto;
			}

			#footer-logo img {
				height: 10em;
			}

			#footer-links {
				min-height: 2em;
				margin: 0;
				padding: 1em;
				background: #3c90e6;
			}

			#footer-links ul {
				margin: 0 auto;
				padding: 0;
				text-align: center;
				width: 50%;
			}

			#footer-links li {
				display: inline;
				white-space: nowrap;
			}

			#footer-links li:after {
				content: " \00b7";
			}

			#footer-links li.nobullet:after {
				content: none;
			}

			#footer-links a:visited, #footer-links a:link {
				color: white;
			}

			#footer-links a:hover {
				text-decoration: underline;
			}

			#footer-links a:active {
				color: #00F;
			}

			.navbar {
				background: none;
				margin-top: 2em;
				margin-bottom: 0;
			}

			nav.menu li a {
				color: white !important;
				border: 2px solid transparent !important;
				padding-left: 2em !important;
				padding-right: 2em !important;
			}

			nav.menu li a:hover {
				background: none !important;
				border: 2px solid #8ADD14 !important;
			}

			nav.menu ul:first-child li:active {
				background: #8ADD14; !important;
			}


			.search_bar {
				background: none;
				border-top: none !important;
				border-left: none !important;
				border-right: none !important;
				border-radius: 0 !important;
				width: 250px;
				text-align: right;
				text-transform: uppercase;
				color: white !important;
			}

			// Slideout
			body {
			  width: 100%;
			  height: 100%;
			}

			.slideout-menu {
			  position: fixed;
			  left: auto; // Right Slideout
			  top: 0;
			  right: 0;
			  height: 100%;
			  background: #333;
			  margin:0;
			  padding:0;
			  z-index: ;
			  width: 300px;
			  overflow-y: auto;
			  -webkit-overflow-scrolling: touch;
			  display: none;
			  color:white;
			}

			.slideout-panel {
			  position: relative;
			  z-index: 0;
			}

			.slideout-open,
			.slideout-open body,
			.slideout-open .slideout-panel {
			  overflow: hidden;
			}

			.slideout-open .slideout-menu {
			  display: block;
			}

			.profpic-cover {
				height: 250px;
				width: 100%;
				color: white;
				padding: 1em;
				font-size: 200%;
				background-size: cover !important;
				-webkit-box-shadow: inset 0px -22px 37px -20px rgba(0,0,0,0.75);
				-moz-box-shadow: inset 0px -22px 37px -20px rgba(0,0,0,0.75);
				box-shadow: inset 0px -22px 37px -20px rgba(0,0,0,0.75);
			}	

			.profpic-cover a {
				color: white !important;
				text-decoration: none !important;
			}

			.menu-toggle {
				color: white;
				font-size: 300%;
				float:right;
				text-decoration: none !important;
				margin-right: .5em;
			}

			.slideout-menu h3 {
				text-align: center;
			}

			.sidebar-button div {
				padding: 1em;
				text-align: center;
				color:white; 
				padding: 0.25em 0; 
				margin: 0 0 0.25em 0;
			}

			.sidebar-button div:active {
				color: #A2F;
			}

			a.sidebar-button {
				color: white;
			}

			a.sidebar-button:hover {
				text-decoration: none;
			}

			.card-title {
				padding: 0.25em;
				color: white;
			    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			    text-align: center;
			    background-color: #8cdf15;
			}

			.card-content {
				color: white;
				font-size: 0.8em;
				background-color: #3d3f3c;
				margin: 0 0.3em;
				padding: 1em;
				text-align: left;
			}

			.card-content ul{
				margin: 0;
				padding: 0;
				list-style-type: none;
			}

			.card-content li {
				padding: 0 0.3em;
				border: 2px solid #528ac3;
				margin: 0.4em 0;
			}

			.card-content li:nth-child(even) {
				border: 2px solid #96d046;
			}

			.card-content li a {
				color: white;
			}

			.card-content li a:active {
				color: #A2F;
			}

			.text-center {
				text-align: center;
			}

			.outer-wrapper {
				background: #fff;
			}

			span.label a {
				color: inherit;
				text-decoration: none !important;
			}

		    .content article {
		        margin-bottom: 1em;
		        font-family: "DroidSerif-Regular" !important;
		    }

		    .content article a {
		        color: inherit;
		        text-decoration: none;
		    }

			.thread {
				text-align: justify;
			}

		    .positive {
		        color: #3B8EE3;
		    }

		    .negative {
		        color: #E33B3B;
		    }

		    .heading {
		        padding-top: 0.4em;
		        padding-bottom: 0.4em;
		        text-align: center;
		        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    
		        color: white;
		        background: #C00;
		        font-size: 2em;
		        margin-bottom: 1em;
		    }

		    .form-text-area {
		        width: 30em;
		        height: 16em;
		    }

		    .help-block {
		        color: red;
		    }

		    .pagination .active {
				background: #999;
			}

			.pagination .disabled {
				color: #aaa;
				cursor: not-allowed;
			}

			.pagination .disabled:hover {
				box-shadow: none !important;
			}

			.pagination ul {
				margin:0 auto !important;
			}
		@show
	</style>

</head>
<body>
	@section('slidemenu')
		<div class="navbar sidemenu">
			<div class="profpic-cover" style="background: url('{{ App\Helpers\Helper::getUserResource(Auth::user()->profile_picture, Auth::user()->id) }}') no-repeat center;">
				<a href="#" class="menu-close">&times;</a>
			</div>

			<h3>{{ Auth::user()->username }}</h3>
			<div style="background-color:#8cdf15; padding-bottom: 0.3em; margin:0.6em;" class="text-center">
				<span style="font-size: 2em;line-height:1em;">LEVEL</span>
				<div class="text-center" style="background-color:#3e3e3e; margin: 0 auto; width:96%;">
					<span style="font-size: 3em; line-height: 1em;">{{ Auth::user()->exp / 100 }}</span>
				</div>
			</div>
			<div style="background-color:#3b91e8; padding: 0.3em; margin:0.5em 0.6em;">
				<div style="background-color:#3e3e3e; margin: 0; padding: 0.3em 0.3em 0.1em 0.3em; width:73%; float:left;">
					<span style="font-size: 1.4em;">{{ Auth::user()->comment_count + Auth::user()->thread_count }}</span>
				</div>
				<div style="margin: 0; padding: 0.3em 0.2em 0.1em 0.3em; float:right;">
					<span style="font-size: 1.4em;">CUAP</span>
				</div>
				<div style="clear:both; width:0; height:0; margin:0; padding:0; "></div>
			</div>
			<div style="background-color:#8cdf15; padding: 0.3em; margin:0.5em 0.6em;">
				<div style="background-color:#3e3e3e; margin: 0; padding: 0.3em 0.3em 0.1em 0.3em; width:60%; float:left;">
					<span style="font-size: 1.4em;">{{ Auth::user()->exp }}</span>
				</div>
				<div style="margin: 0; padding: 0.3em 0.2em 0.1em 0.3em; float:right;">
					<span style="font-size: 1.4em;">THANKS</span>
				</div>
				<div style="clear:both; width:0; height:0; margin:0; padding:0; "></div>
			</div>
			<a href="/notifications" style="color:white;">
			<div style="background-color:#3b91e8; margin-top: 2em;">
				<div style="background-color:white; width:20%; margin:0; padding: 0.3em 0.2em 0.1em 0.3em; float:left; color: #3b91e8; text-align: center">
					<span style="font-size: 1.4em;">
					{{ DB::table('notifications')
			            ->where('user_id', Auth::user()->id)
			            ->where('is_read', false)
			            ->count() 
			        }}
			        </span>
				</div>
				<div style="margin: 0; padding: 0.3em 0.2em 0.1em 0.3em; float:right;">
					<span style="font-size: 1.4em;">INBOX</span>
				</div>
				<div style="clear:both; width:0; height:0; margin:0; padding:0; "></div>
			</div>
			</a>
			<a href="/profile/edit" style="color:white;">
			<div style="background-color:#8cdf15">
				<div style="width:20%; margin:0; padding: 0.3em 0.2em 0.1em 0.6em; float:left;">
					<i class="fa fa-user fa-lg"></i>
				</div>
				<div style="margin: 0; padding: 0.3em 0.2em 0.1em 0.3em; float:right;">
					<span style="font-size: 1.4em;">MY PROFILE</span>
				</div>
				<div style="clear:both; width:0; height:0; margin:0; padding:0; "></div>
			</div>
			</a>
		</div>
	@show

	<main class="outer-wrapper">
		<header id="header">
			@section('header')
				<img src="/img/cuapcuap-logo-h.png" alt="CuapCuap Capung" class="logo">

				<a href="#" class="menu-toggle">&equiv;</a>

				<div class="navbar">
					<nav class="menu">
						<ul>
							<li><a href="/threads/new">New</a></li>
							<li><a href="/threads/hot">Hot</a></li>
							@foreach (
								DB::table('categories')
	            					->orderBy('id', 'asc')
	        						->get() 
	    						as $category
    						)
								<li><a href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
							@endforeach
						</ul>
						<ul>
							<li>
								<form action="/search" method="get" accept-charset="utf-8">
									<input type="search" class="search_bar" name="keyword" placeholder="Cari sesuatu?">
								</form>
							</li>
						</ul>
					</nav>
				</div>

				<div id="header-background">

				</div>
			@show
		</header>

		<main class="wrapper">
			<div class="row">
				<main class="content col-9">

					@yield('content')

				</main>

				<aside class="sidebar col-3">
					@section('sidebar')
						<a href="/thread/new" class="sidebar-button"><div style="background: #3c90e6">MULAI DISKUSI</div></a>
						<div class="card-title">PENGUMUMAN</div>
						<div class="card-content">
							<ul>
								@foreach (
									DB::table('announcements')
							            ->where('is_deleted', false)
							            ->orderBy('created_at', 'desc')
            							->get()
            						as $announcement
            					)
									<li><a href="/announcement/{{ $announcement->id }}">{{ $announcement->title }}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="card-title">RULES &amp; GUIDES</div>
						<div class="card-content">
							<ul>
								<li><a href="/rules">PERATURAN FORUM</a></li>
								<li><a href="/guide/how-to-make-a-post">HOW-TO MAKE A POST</a></li>
							</ul>
						</div>
					@show
				</aside>
			</div>
		</main>

		<footer id="footer">
			@section('footer')
				<div id="footer-logo">
					<img src="/img/footer-logo.png"> 
				</div>
				<div style="color: white; margin:0; padding:0.5em;">&copy; Tim SBF PTI 2015, All Rights Reserved.</div>
				<div id="footer-links">
					<ul>
						<li><a href="/aboutus">Tentang Kami</a></li>
						<li class="nobullet"><a href="/contact">Kontak</a></li>
					</ul>
				</div>
			@show
		</footer>
	</main>

	@section('bottom-script')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/0.1.11/slideout.min.js"></script>
		<script src="http://cdn.everything.io/kickstart/3.x/js/kickstart.min.js"></script>

		<script>
			var slideout = new Slideout({
				'panel' : document.querySelector('.outer-wrapper'),
				'menu'	: document.querySelector('.sidemenu'),
				'padding' : 300,
				'tolerance' : 70,
				'side' : 'right'
			});

			document.querySelector('.menu-toggle').addEventListener('click', function(){
				slideout.toggle();
			});

			document.querySelector('.menu-close').addEventListener('click', function(){
				slideout.close();
			});
		</script>
	@show
</body>
</html>