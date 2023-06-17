<!DOCTYPE html>
<html>
<head>
	<title>Registration - Car Rental Management System</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css?v=1.2">
</head>
<body id="loginBody">
	<div class="container">
		<div class="loginHeader">
			<h1>REGISTER</h1>
			<p>Car Rental Management System</p>
		</div>
		<div class="loginBody">
			<form name="form" action="create_account1.php" method="POST">
				<div class="loginInputsContainer">
					<label for="">First Name</label>
					<input placeholder="Enter firstname" name="fname" type="text" required />
				</div>
				<div class="loginInputsContainer">
					<label for="">Last Name</label>
					<input placeholder="Enter lastname" name="lname" type="text" required />
				</div>
				<div class="loginInputsContainer">
					<label for="">Email</label>
					<input placeholder="Enter email" name="email" type="email" required />
				</div>
				<div class="loginInputsContainer">
					<label for="">Phone Number</label>
					<input placeholder="Enter username" name="username" type="text" required />
				</div>
				<div class="loginInputsContainer">
					<label for="">Birthdate</label>
					<input placeholder="Enter username" name="birthdate" type="date" required />
				</div>
				<div class="loginInputsContainer">
					<label for="">Username</label>
					<input placeholder="Enter username" name="username" type="text" required />
				</div>
					<div class="loginInputsContainer">
					<label for="">Password</label>
					<input placeholder="Enter password" name="password" type="Password" required />
				</div>
				<div class="loginButtonContainer">
					<button type="submit">Register</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>