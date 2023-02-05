<?php
require __DIR__ . '/../myconfig/dbconnect.php';

session_start();
$user = $pdo->query("SELECT * FROM Users WHERE Id = ".$_SESSION["Id"]." ")->fetch();
if (isset($_GET["Id"])) {
	$_SESSION["Id"] = $_GET["Id"];
}
if (isset($_GET["ToId"])) {
	$_SESSION["ToId"] = $_GET["ToId"];
}
if (isset($_POST["message"])) {
	$cmd = "INSERT INTO Msgs(FromId, ToId, Message) VALUES('".$_SESSION["Id"]."', '".$_SESSION["ToId"]."' , '" . $_POST["message"] . "')";

	if ($pdo->query($cmd))
		header('Location: chat.php/ToId=' . $_SESSION["ToId"] );
	else
		echo "Error with chat.";
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
		<p>Hi, <?php echo $user["Name"]; ?></p>
		<input type = "text" id="FromId" value = <?php echo $user["Id"]; ?> hidden />
		<p>Send Message To(Id):</p>
		<ul>
			<?php
				$stmt = $pdo->query("SELECT * FROM Users")->fetchAll();
				foreach ($stmt as $row) {
					echo '<li>
						<a href="/chat.php?ToId=' . $row["Id"] . '">' . $row["Name"] . '</a>
					</li>';
				}
			?>
		</ul>
		<?php if (isset($_SESSION["ToId"])) : ?>
			<p>Message History:</p>
			<?php
				$stmt = $pdo->query("SELECT * FROM Msgs WHERE (FromId = ".$_SESSION["Id"]." AND ToId = ".$_SESSION["ToId"].") OR 
				(FromId = ".$_SESSION["ToId"]." AND ToId = ".$_SESSION["Id"].") ")->fetchAll();
				foreach ($stmt as $row) {
					$fromstmt = $pdo->query("SELECT * FROM Users WHERE Id = ".$row["FromId"]." ")->fetch();
					$fromname = $fromstmt["Name"];
					$tostmt = $pdo->query("SELECT * FROM Users WHERE Id = ".$row["ToId"]." ")->fetch();
					$toname = $tostmt["Name"];
					$msg = $row["Message"];
					echo "FROM: ", $fromname, " TO: ", $toname, "<br>";
					echo "Message: ", $msg, "<br>";
				}
			?>
			<form action = "chat.php" method = "POST">
				<p>Type your message here:</p>
				<textarea name = "message"></textarea>
				<br>
				<input type = "submit" name = "submit" class = "btn btn-primary" value = "Submit"/>
			</form>
		<?php endif; ?>
		<a href="/">Home</a>
	</div>
</body>
</html>