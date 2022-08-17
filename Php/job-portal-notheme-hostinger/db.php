<?php  

$servername = "localhost";
$username = "u575330830_alfik";
$password = "114306666Hafidz";
$dbname = "u575330830_jp";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}
