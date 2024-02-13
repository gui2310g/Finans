<?php 
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$host = "localhost";
$user = "root";
$password = $_ENV['DB_KEY'];
$database = "Finans";
?>