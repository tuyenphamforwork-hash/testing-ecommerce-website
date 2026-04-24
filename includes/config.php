<?php
// Load Composer autoload (để dùng dotenv)
require_once __DIR__ . '/../vendor/autoload.php';

// Load file .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// ================= DATABASE CONFIG =================
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "db_ecommerce";

// Create connection
$conn = new mysqli($serverName, $dBUsername, $dBPassword, $dBName);

// Check connection (viết đúng chuẩn hơn)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}