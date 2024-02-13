<?php 
    @session_start();
    require_once("../connection.php");
    require_once("../php/validate.php");
    require_once("../php/transaction.php");
    
    validateUserLevel('User');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Finans</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <header id="header">
        <div id="nav">
            <img src="../assets/imgs/coin-finans.png" alt="image logo">
            <nav class="topnav" id="myTopnav">
                <ul class="links">
                    <li><a href="">Home</a></li>
                    <li><a href="../pages/transactions.php">Launches</a></li>
                </ul>
            </nav>
        </div>

        <div id="profile">
            <img src="../assets/imgs/profile.png" alt="">
            <ul class="links">
                <li>
                    <div class="dropdown">
                        <button class="dropbtn">
                            <?php echo @$_SESSION['name_users'] ?>
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="../pages/transactions.php">Launches</a>
                            <a href="../php/logout.php">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="money">
                    <div>
                        <?php 
                            $userID = $_SESSION['id_users'];
            
                            $query = "SELECT * FROM transactions WHERE user_id = ?";
                            $statement = $pdo->prepare($query);
                            $statement->execute([$userID]);
                            $accountTransactions = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                            $total = 0; 
                            
                            foreach ($accountTransactions as $transaction) {
                                if ($transaction['type'] == '1') {
                                    $total += $transaction['value'];
                                } elseif ($transaction['type'] == '2') {
                                    $total -= $transaction['value'];
                                }
                            }
                            
                            echo "<span id='total'>USD $ " . number_format($total, 2, ',', '.') . "</span>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="info">
                    <div class="titles">
                        <div>
                            <span>Deposits</span> <span>&#x2193;</span>

                        </div>

                        <div>
                            <span>Withdraws</span> <span>&#x2191;</span>
                        </div>
                    </div>

                    <hr />

                    <div class="finans-history">
                        <table class="transaction-row">
                            <?php 
                                    $userID = $_SESSION['id_users'];
                                    $query = "SELECT * FROM transactions WHERE user_id = ? and type = '1'";
                                    $statement = $pdo->prepare($query);
                                    $statement->execute([$userID]);
                                    $deposit_transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
                                
                                    $_SESSION['deposit_transactions'] = $deposit_transactions;
                                
                                    foreach ($deposit_transactions as $transaction) {
                                        echo "<tr>";
                                        echo "<td class='value'>USD $ {$transaction['value']}</td>";
                                        echo "</tr>";
                                        echo "<tr class='description'>";
                                        echo "<td >{$transaction['description']}</td>";
                                        echo "<td>{$transaction['date']}</td>";
                                        echo "</tr>";

                                    }
                            ?>
                        </table>

                        <table class="transaction-row">
                            <?php 
                                    $userID = $_SESSION['id_users'];
                                    $query = "SELECT * FROM transactions WHERE user_id = ? and type = '2'";
                                    $statement = $pdo->prepare($query);
                                    $statement->execute([$userID]);
                                    $withdraw_transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
                                
                                    $_SESSION['withdraw_transaction'] = $withdraw_transactions;
                                
                                    foreach ($withdraw_transactions as $transaction) {
                                        echo "<tr>";
                                        echo "<td class='value'>USD $ {$transaction['value']}</td>";
                                        echo "</tr>";
                                        echo "<tr class='description'>";
                                        echo "<td>{$transaction['description']}</td>";
                                        echo "<td>{$transaction['date']}</td>";
                                        echo "</tr>";
                                    }
                                ?>
                        </table>
                    </div>

                    <div>
                        <a href="../pages/transactions.php">
                            <button type="button" class="btn" id="transactions-button">See all</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>