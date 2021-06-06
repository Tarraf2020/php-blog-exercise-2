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
<div class="grid-container">

<div class="grid-item" id="register">
 

<h3>Register</h3>
<form method="post" action="">
   
   
   
   <input type="text" autocomplete="off" name="username" placeholder="Username" required  />
   <input type="password" autocomplete="off" name="password" placeholder="password" required  value="Alfa512#"/>
   <input type="password" autocomplete="off" name="password1" placeholder="confirm password"value="Alfa512#" required />

   <input type="email" autocomplete="off" name="email" placeholder="Email"  value="omar1@gmail.com" required />
   



  <input type="submit" name="register" VALUE="register"/>
  <a href="login.php">Login</a>

 

</form>
</body>
</html>
<?php

require('includes/users.inc.php');

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
           $user1 = new Users();

           if (isset($_POST['register'])) {
               $user1->register_user($_POST['username'], $_POST['password'], $_POST['email']);
           }
           ?>