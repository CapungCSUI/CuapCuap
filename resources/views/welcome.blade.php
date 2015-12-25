<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CuapCuap &middot; Login</title>

	<style>
		/* apply a natural box layout model to all elements, but allowing components to change */
		html {
		  box-sizing: border-box;
		}
		*, *:before, *:after {
		  box-sizing: inherit;
		}

		html, body {
			height: 100%;
			margin:0;
			padding:0;

			font-family: sans-serif;
			font-size: 16px;
			color: white;
		}

		a, a:visited {
			color: white;
			text-decoration: none;
		}

		.outer {
			min-height: 100%;
			display: flex;
			flex-direction: column;
			flex: 1;
			align-items: center;
  			justify-content: space-between;
		}

		.pad {
			width: 100px;
		}

		.background {
			z-index: -1;
			height: 100%;
			width: 100%;
			position: fixed;
			top:0;
			left:0;
			background: #666 url('img/bg.jpg') center no-repeat;
			filter: brightness(50%);
			-webkit-filter: brightness(50%);
			background-size: cover;
		}

		.inner {
			text-align: center;
		}

		.responsive {
			max-width: 100%;
			max-height: 300px;
		}

		.block {
			display: block;
		}

		.button {
			display:inline-block;
			margin-top: 1em;
			text-transform: uppercase;
			font-size: 1.8em;
			padding: .5em;
			background: none;
			border-radius: 3px;
			border: 3px solid rgb(59,142,227);
			color: white;
			text-decoration: none;
			width: auto;
		}

		.bottom {
			padding-bottom: 3em;
			padding-left: 3em;
			padding-right: 3em	;
			width: 100%;
		}

		.left {
			float:left;
		}

		.right {
			margin-left: auto;
			float: right;
		}
	</style>


</head>
<body>
	<div class="outer">
		<div class="pad">
			
		</div>
		<div class="inner">
			<div>
				<img src="img/cuapcuap-logo.png" alt="Logo CuapCuap" class="responsive block" />
			</div>
			<div>
				<a href="#" class="button">Masuk</a>
			</div>
		</div>

		<div class="bottom">
			<div class="left">
				&copy; Tim SBF PTI 2015, All Rights Reserved.
			</div>

			<div class="right">
				<a href="#">Tentang Kami</a> &middot; <a href="#">Bantuan</a> &middot; <a href="#">Kontak</a>
			</div>
		</div>
	</div>

	<div class="background">
	</div>
</body>
</html>