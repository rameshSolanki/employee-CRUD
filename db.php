<?php
$databaseHost = 'localhost';
$databaseName = 'employee_db';
$databaseUsername = 'root';
$databasePassword = '';
try {

$conn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", $databaseUsername, $databasePassword);
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//return $conn;
//echo "Connected.";
}
catch(PDOException $e) {
	//echo $e->getMessage();
	echo "Connection Failed.";
	//return false;
}
?>