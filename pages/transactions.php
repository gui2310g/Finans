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
    <title>Transactions - Finans</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/launch.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <header id="header">
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
                            <a href="../pages/user.php">Home</a>
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
                <div class="title">
                    <div>
                        <span id="total">Launches</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="info">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Value</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody id="transactions-list">
                            <?php
                                if (isset($_SESSION['transaction_form'])) {
                                  
                                    foreach ($_SESSION['transaction_form'] as $transaction) {
                                        echo "<tr>";
                                        echo "<td>{$transaction['date']}</td>";
                                        echo "<td>{$transaction['value']}</td>";
                                        echo "<td>{$transaction['type']}</td>";
                                        echo "<td>{$transaction['description']}</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    $userID = $_SESSION['id_users'];
                                    $query = "SELECT * FROM transactions WHERE user_id = ?";
                                    $statement = $pdo->prepare($query);
                                    $statement->execute([$userID]);
                                    $transactions = $statement->fetchAll(PDO::FETCH_ASSOC);
                            
                                    $_SESSION['transaction_form'] = $transactions;
                                
                                    
                                    foreach ($transactions as $transaction) {
                                        echo "<tr>";
                                        echo "<td>{$transaction['date']}</td>";
                                        echo "<td>{$transaction['value']}</td>";
                                        echo "<td>{$transaction['type']}</td>";
                                        echo "<td>{$transaction['description']}</td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <button class="btn button-float" id="mybtn">
                <span>+</span>
            </button>
        </div>

        <!-- modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div>
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Add a value</h2>
                </div>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="transaction-form">
                    <label for="value"><b>Value:</b></label>
                    <input type="text" name="value" id="value" required>

                    <label for="description"><b>Description:</b></label>
                    <input type="text" name="description" id="description" required>

                    <label for="date"><b>Date:</b></label>
                    <input id="date" type="date" name="date" required />

                    <div>
                        <label for="deposit">Deposit</label>
                        <input type="radio" name="check" id="deposit" id="value" value="1" checked>

                        <label for="withdraw">Withdraw</label>
                        <input type="radio" name="check" id="withdraw" id="value" value="2">
                    </div>
                    <button type="submit" class="btn" id="submit">Add</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../js/modal.js"></script>
</body>

</html>