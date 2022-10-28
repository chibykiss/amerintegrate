<!DOCTYPE html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    {{-- @vite('resources/js/app.js') --}}

	<!-- Modernizr JS -->
	<script src="{{asset('assets/js/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body class="style-2">

		<div class="container">
			
			<div class="row">
				<div class="col-md-4 offset-md-4">
					

					<!-- Start Sign In Form -->
					<form action="{{route('admin.login')}}" method="POST" class="fh5co-form animate-box" data-animate-effect="fadeIn">
						@csrf
						<h2>Welcome Back</h2>
						<div class="form-group">
							<label for="username" class="visually-hidden">Username</label>
							<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="username" value="" placeholder="Email" autocomplete="off">
							@error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                             @enderror
						</div>
						<div class="form-group">
							<label for="password" class="visually-hidden">Password</label>
							<input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" id="password" value="" placeholder="Password" autocomplete="off">
							@error('password')
								<span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
							@enderror
						</div>
						<div class="form-group">
							<label for="remember"><input type="checkbox" name="remember" id="remember"/> Remember Me</label>
						</div>
						<div class="form-group">
							<a href="forgot.html">Forgot Password?</a></p>
						</div>
						<div class="form-group">
							<input type="submit" value="Sign In" class="btn btn-primary">
						</div>
					</form>
					<!-- END Sign In Form -->

				</div>
			</div>
			<div class="row" style="padding-top: 60px; clear: both;">
				<div class="col-md-12 text-center"><p><small>&copy; All Rights Reserved. Designed by <a href="">vibetek</a></small></p></div>
			</div>
		</div>
	
	<!-- jQuery -->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!-- Placeholder -->
	<script src="{{asset('assets/js/jquery.placeholder.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
	<!-- Main JS -->
	<script src="{{asset('assets/js/main.js')}}"></script>


	</body>
</html>

