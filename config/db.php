<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "simple_login_register";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $conn->close();
