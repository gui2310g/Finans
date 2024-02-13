<?php 
    @session_start();
    require_once("../connection.php");
    $email = $_POST["email"];
    $name  = $_POST["name"];
    $password = $_POST["password"];
    
    $checkQuery = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE email = :email");
    $checkQuery->bindValue(":email", $email);
    $checkQuery->execute();
    $result = $checkQuery->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        die("Email already exists");
    } else {
        $query = $pdo->prepare("INSERT INTO users (email, name, password, level) VALUES (:email, :name, :password, 'User')");
        $query->bindValue(":email", $email);
        $query->bindValue(":name", $name);
        $query->bindValue(":password", $password);
        $query->execute();
        header('Location: ../pages/user.php');
    }
?>