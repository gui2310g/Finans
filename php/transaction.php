<?php 
@session_start();
require_once("../connection.php");
require_once("../php/validate.php");

function addTransaction($userID, $value, $type, $date, $description, $pdo) {

    $query = "INSERT INTO transactions (user_id, value, type, date, description) VALUES (?, ?, ?, ?, ?)";

    $statement = $pdo->prepare($query);

    try {
        $statement->execute([$userID, $value, $type, $date, $description]);
        
        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
       
        echo "Error: " . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $value = $_POST['value'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $type = $_POST['check']; 
  
    $userID = $_SESSION['id_users'];

    
    if(addTransaction($userID, $value, $type, $date, $description, $pdo)) {
        $newTransaction = array(
            'date' => $date,
            'value' => $value,
            'type' => $type == 1 ? 'Deposit' : 'Withdraw',
            'description' => $description
        );

        
        if (!isset($_SESSION['transaction_form'])) {
            $_SESSION['transaction_form'] = array();
        }

        array_push($_SESSION['transaction_form'], $newTransaction);
    } else {
        echo "Error by adding transaction.";
    }
}
?>