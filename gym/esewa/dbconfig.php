<?php
$host = 'localhost';
$db = 'gymdb';
$user = 'root'; // Your database user
$password =''; // Your Database password

$conn = new mysqli($host, $user, $password, $db);
if( $conn ->connect_error)
{
	echo "Failed to connect to MySQL". $conn->connect_error;
	exit;
}