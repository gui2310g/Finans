<?php 
    require_once("../php/config.php");
  
    try {
        $pdo = new PDO("mysql:dbname=$database;host=$host;charset=utf8", "$user", "$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection Error: " . $e->getMessage();
        exit();
    }
?>