<?php
require __DIR__ . '/../myconfig/dbconnect.php';

session_start();
if (isset($_POST["uName"])) {
	$cmd = "INSERT INTO Users(Name) VALUES('" . $_POST["uName"] . "')";

	if ($pdo->query($cmd))
		header('Location: /');
	else
		echo "Error with registration.";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<h4>Register</h4>
	</div>
	<div>
		<form action = "register.php" method = "POST">
			<p>Name</p>
			<input type = "text" name = "uName" />
			<br>
			<input type = "submit" name = "submit" class = "btn btn-primary" value = "Submit"/>
		</form>
	</div>
</body>
</html>