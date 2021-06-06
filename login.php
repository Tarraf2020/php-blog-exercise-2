<?php
require('includes/users.inc.php');
?>
<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        <?php
        include "css/style.css";

        ?>
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    $user1 = new Users();

 
    if (isset($_POST['login_user'])) {
        $user1->login_user($_POST['username'], $_POST['password']);
    }


    ?>


    <div class="grid-container">

      
        <div class="grid-item">
            <h3>Log in</h3>

            <form method="post" action="">

                <input type="text" autocomplete="off" name="username" value="zz" placeholder="Username" required />


                <input type="password" autocomplete="off" name="password" value="Alfa512#"  placeholder="Password" required />





                <input type="submit" name="login_user" VALUE="Login" />
                <a href="register.php">Create New User</a>

            </form>


        </div>
    </div>

</body>

</html>