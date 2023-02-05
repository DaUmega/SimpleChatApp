<?php
require __DIR__ . '/../myconfig/dbconnect.php';

session_start();
if (isset($_GET["Id"]))
$_SESSION["Id"] = $_GET["Id"];
$user = $pdo->query("SELECT * FROM Users WHERE Id = ".$_SESSION["Id"]." ")->fetch();
if (isset($_POST["msg"])) {
	$cmd = "INSERT INTO Msgs(Message) VALUES('" . $_POST["msg"] . "')";

	if ($pdo->query($cmd))
		header('Location: chat.php/ToId=' . $_["Id"] );
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
		<?php if (isset($_GET["ToId"])) : ?>
			<p>Message History:</p>
			<?php
				$stmt = $pdo->query("SELECT * FROM Msgs WHERE (FromId = ".$_SESSION["Id"]." AND ToId = ".$_GET["ToId"].") OR 
				(FromId = ".$_GET["ToId"]." AND ToId = ".$_SESSION["Id"].") ")->fetchAll();
				foreach ($stmt as $row) {
					$fromstmt = $pdo->query("SELECT * FROM Users WHERE Id = ".$row["FromId"]." ")->fetch();
					$fromname = $fromstmt["Name"];
					$tostmt = $pdo->query("SELECT * FROM Users WHERE Id = ".$row["ToId"]." ")->fetch();
					$toname = $tostmt["Name"];
					$msg = $row["Message"];
					echo "FROM: ", $fromname;
					echo "Message: ", $msg;
					echo "TO: ", $toname;
				}
			?>
			<form action = "chat.php?ToId=<?php $_GET["ToID"] ?>" method = "POST">
				<p>Type your message here:</p>
				<input type = "text" message = "msg" FromId = <?php $_SESSION["Id"]?> ToId = <?php $_GET["ToID"] ?> multiple/>
				<br>
				<input type = "submit" name = "submit" class = "btn btn-primary" value = "Submit"/>
			</form>
		<?php endif; ?>
		<a href="/">Home</a>
	</div>
</body>
</html>