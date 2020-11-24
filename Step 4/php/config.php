<?php

$servername = "classmysql.engr.oregonstate.edu";
$username = "cs340_webbjohn";
$password = "3043";
$dbname = "cs340_webbjohn";

try {
	$conn = new PDO("mysql:host=$servername;dbname=cs340_webbjohn", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
  }

?>