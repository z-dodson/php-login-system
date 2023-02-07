<?php
session_start();
if (isset($_POST['username'], $_POST['password']) ) {
	
    $username = ucfirst(strtolower($_POST['username']));
	$filename = "../private/users/".$username."/password";
	if(file_exists($filename)){
		$password = trim(file_get_contents($filename));
		if(password_verify($_POST['password'],$password)){
			header("Location: /index.php");
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $username;
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="./index.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" autofocus required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>
