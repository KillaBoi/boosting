<?php
// db.php

$servername = "";
$serverport = "";
$username = "";
$password = "";
$database = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $serverport);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}