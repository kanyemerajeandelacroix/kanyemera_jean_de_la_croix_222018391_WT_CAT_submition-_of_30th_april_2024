<?php
// Database credentials
$hostname = "localhost";
$username = "kanyemera1";
$password = "222018391";
$database = "coffee_cultivation_farming";

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>