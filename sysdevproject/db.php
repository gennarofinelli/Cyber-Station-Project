<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cyberstationdb";

try {
    // Create connection using MySQLi
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Log the error to a file (optional)
    error_log($e->getMessage(), 3, dirname(__FILE__) . '/error.log');

    // Display user-friendly message
    die("Database connection failed. Please try again later.");
}

// Set character set to UTF-8 (for international characters)
$conn->set_charset("utf8");

?>
