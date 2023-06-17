<!DOCTYPE html>
<html>
<head>
	<title>Login - Car Rental Management System</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css?v=1.2">
</head>
<body id="loginBody">
	<div class="container">
		<div class="loginHeader">
			<h1>LOGIN</h1>
			<p>Car Rental Management System</p>
		</div>
		<div class="loginBody">
			<form name="form" action="login.php" method="POST">
				<?php if(isset($_GET['error'])) {
					echo '<p class="errormsg">Username or Password is incorrect</p>';
				} ?>
				<div class="loginInputsContainer">
					<label for="">Username</label>
					<input placeholder="Username" name="username" type="text" />
				</div>
				<div class="loginInputsContainer">
					<label for="">Password</label>
					<input placeholder="Password" name="password" type="Password" />
				</div>
				<div class="loginButtonContainer">
					<button type="submit">Login</button>
				</div>
				<ul>
					<a href="#">Forgot Password?</a>
					<a href="create_account.php">Create Account</a>
				</ul>
			</form>
		</div>
	</div>
</body>
</html>