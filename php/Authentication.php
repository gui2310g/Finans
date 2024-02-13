<?php 
    @session_start();
    require_once("../connection.php");
    
    $email = $_POST["modal-email"];
    $password = $_POST["modal-password"];
    
    $query = $pdo->prepare("SELECT * from users where email = :email and password = :password ");
    $query->bindValue(":email", $email); 
    $query->bindValue(":password", $password);
    $query->execute();

    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);

    if($total_reg > 0) {
        
        $level = $res[0]['level'];

        $_SESSION['level_users'] = $res[0]['level'];
        $_SESSION['id_users'] = $res[0]['id'];
        $_SESSION['name_users'] = $res[0]['name'];
        
        if ($level == 'User') {
            header('Location: ../pages/user.php');
            exit(); 
        } else {
            header('Location: ../index.html');
            exit();
        }
        
    } else {
        die("Error for logging");
        exit();
    }
?>