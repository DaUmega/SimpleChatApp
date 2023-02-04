<?php

session_start();
$pdo = new PDO('sqlite:' . __DIR__ . '/../db/glory.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;

?>