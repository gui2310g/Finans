<?php 
    require_once("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Finans</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <header id="header">
        <img src="../assets/imgs/logo.png" alt="image logo">
    </header>

    <main>
        <div class="form">
            <form action="../php/create.php" method="post">
                <img src="../assets/imgs/coin.png" alt="coin photo">

                <div class="container">
                    <label for="email"><b>Email:</b></label>
                    <input type="text" placeholder="Insert your Email" name="email" required>

                    <label for="name"><b>Name:</b></label>
                    <input type="text" placeholder="Insert your Name" name="name" required>

                    <label for="password"><b>Password:</b></label>
                    <input type="password" placeholder="Insert your Password" name="password" required>

                    <button type="submit" class="btn">Sign Up</button>
                </div>
            </form>

            <button id="mybtn">You already have an account?</button>
        </div>

        <!-- modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form action="../php/Authentication.php" method="post" id="modalform">
                    <label for="email"><b>Email:</b></label>
                    <input type="text" placeholder="Insert your Email" name="modal-email" required>
                    <label for="modalpassword"><b>Password:</b></label>
                    <input type="password" placeholder="Insert your Password" name="modal-password" required>
                    <button type="submit" class="btn">Sign In</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../js/modal.js"></script>
</body>

</html>