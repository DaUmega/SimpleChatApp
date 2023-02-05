<?php

session_start();
try {
	$pdo = new PDO('sqlite:' . __DIR__ . '/../db/glory.sqlite3');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
return $pdo;

?>