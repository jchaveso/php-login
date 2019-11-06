<?php
	require 'database.php';

	$message = '';

	if (!empty($_POST['email']) && !empty($_POST['password'])){
	   $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	   $stmt = $conn->prepare($sql);
	   $stmt->bindParam(':email', $_POST['email']);
	   $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	   $stmt->bindParam(':password', $password);

	   if ($stmt->execute()) {
	   	$message = 'Successfully created new user';
	   } else {
	   	$message = 'Sorry, Error while create an account';
	   }

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<?php require 'partials/header.php' ?>
	<?php if(!empty($message)):?>
	  <p><?= $message ?></p>
	<?php endif; ?>	

	<h1>Signup</h1>
	<span> or <a href="login.php">Login</a></span>

	<form action="signup.php" method= "post">
		<input type="text" name="email" placeholder="Enter your email">
		<input type="password" name="password" placeholder="Enter Your Password">
		<input type="password" name="confirm_password" placeholder="Confirm Your Password">
		<input type="submit"value="Send">
	</form>

</body>
</html>