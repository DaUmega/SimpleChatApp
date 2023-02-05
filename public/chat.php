<?php
require __DIR__ . '/../myconfig/dbconnect.php';
session_start();
$user = $pdo->query("SELECT * FROM Users WHERE Id = '".$_SESSION["Id"]."'");
if (isset($_POST["uName"])) {
	$cmd = "INSERT INTO Users(Name) VALUES('" . $_POST["uName"] . "')";

	if ($pdo->query($cmd))
		header('Location: index.php');
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
		<h4>Chat</h4>
	</div>
	<div class = "container-fluid">
		<p>Hi <?php echo $user["Name"]; ?></p>
		<input type = "text" id="FromId" value = <?php echo $user["Id"]; ?> hidden />
		<p>Send To:</p>
		<ul>
			<?php
				$msgs = $pdo->query("SELECT * FROM Users");
				foreach ($msg as $msgs) {
					echo '<li>
						<a href="?ToId=' . $msg["Id"] . '">' . $msg["Name"] . '</a>
					</li>';
				}
			?>
		</ul>
		<a href="index.php">Home</a>
	</div>
</body>
</html>