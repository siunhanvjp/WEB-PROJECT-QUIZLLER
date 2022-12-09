<?php
session_start();
if(isset($_SESSION["user_id"]))
  header("Location:./files/dashboard.php");
?>

<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Quizller</title>
		<meta property="og:site_name" content="Quizller"/>
		<meta property="og:title" content="Login page"/>
		<meta property="og:description" content="Teacher login to website, the main page is here"/>
		<meta property="og:type" content="website"/>
		<meta property="og:locale" content="en"/>
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="vendor/tilt/tilt.jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
	    <link rel="icon" type="image/png" href="admin/assets/img/favicon.png">
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/util.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	</head>

	<body>
		<!-- Header -->
		<header class="header1">
			<!-- Header desktop -->
			<div class="container-menu-header">
				<div class="wrap_header">
					<!-- Logo -->
					<a href="index.html" class="logo">
						<img src="images/icons/logo.png" alt="IMG-LOGO">
					</a>

					<!-- Header Icon -->

				</div>
			</div>

			<!-- Header Mobile -->
			<div class="wrap_header_mobile">
				<!-- Logo moblie -->
				<a href="index.php" class="logo-mobile">
					<img src="images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Button show menu -->
				<div class="btn-show-menu">
					<!-- Header Icon mobile -->
					<div class="header-icons-mobile">
						<a href="#" class="header-wrapicon1 dis-block">
							<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
						</a>
					</div>
				</div>
			</div>
			</div>
		</header>

		<section>
			<div class="limiter">
				<div class="container-login100">
					<div class="wrap-login100">
						<div class="login100-pic js-tilt" data-tilt>
							<img src="images/img-01.png" alt="IMG">
						</div>
						<div class="login100-form validate-form">
							<span class="login100-form-title">
								Teacher Login
							</span>
							
							<div class="wrap-input100 validate-input">
								<input class="input100" id="username" type="text" name="username"
									placeholder="Username" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-user-circle-o" aria-hidden="true"></i>
								</span>
								<span class="error text-danger" id="empty_username"></span>
							</div>

							<div class="wrap-input100 validate-input">
								<input class="input100" id="password" type="password" name="password"
									placeholder="Password" required>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</span>
								<span class="error text-danger" id="empty_password"></span>
							</div>

							<div class="container-login100-form-btn">
								<button class="login100-form-btn" onclick="login()">
									Login
								</button>
								
								<a href="admin_portal.php">Login as Admin</a>
							</div>
							<div class="text-center p-t-136" id="result">

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script>

			$('.js-tilt').tilt({
				scale: 1.1
			})

			function login() {
				var someFieldIsEmpty = false;

				if (!$('#username').val()) {
					someFieldIsEmpty = true;
					$('#empty_username').val("Please enter your username");
				}
				if (!$('#password').val()) {
					someFieldIsEmpty = true;
					$('#empty_password').val("Please enter your password");
				}

				if (!someFieldIsEmpty) {
					$.ajax({
						type: 'POST',
						url: 'files/checklogin.php',
						data: {
							'username': $('#username').val(),
							'password': $('#password').val(),
						},
						success: function (response) {
							if(response != "success"){
								$("#result").html("Login Failed");
							}
							else{
								$("#result").html("Login Successful");
								setTimeout(function(){
									window.location="files/dashboard.php";
								},1200);
							}	
						}
					});
				}
			}
		</script>
	</body>
</html>