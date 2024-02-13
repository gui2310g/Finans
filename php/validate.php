    <?php 
        function validateUserLevel($requiredLevel) {
            @session_start();

            if (isset($_SESSION['level_users']) && $_SESSION['level_users'] === $requiredLevel) {
                return true;
            } else {
            
                header("Location: ../index.html");
                exit();
            }
        }
    ?>