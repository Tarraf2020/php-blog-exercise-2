
<?php
require('includes/DB.inc.php');
class Users extends DB
{
    public function read_users()
    {
        $con = $this->connect();
        $stmt = $con->prepare("SELECT username, password FROM users");
        $stmt->execute();



        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            print_r($result);
            print("\n");
        }
    }
    public function register_user($username, $password, $email)
    {

        if (empty($username) || empty($email) || empty($password) || empty($password1)) {
            $error = "Complete all fields";
        }
        // Given password

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        } else {

            $con = $this->connect();
            $stmt = $con->prepare("SELECT * FROM `users` WHERE `username` = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count > 0) {
                echo "user already exixst";
                exit();
            }
            $stmt = $con->prepare("SELECT email FROM `users` WHERE `email` = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->rowCount();

            if ($count > 0) {
                echo "email already exixst";
                exit();
            } else {
                $stmt = $con->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
                $hashpassword = (md5($password));

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashpassword);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
            }
        }
    }
    public function login_user($username, $password)
    {
        $con = $this->connect();



        $stmt = $con->prepare("SELECT username, password from users where username=:username and password=:password");
        $stmt->bindParam(':username', $username);
        $hashpassword = (md5($password));



        $stmt->bindParam(':password', $hashpassword);

        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location:index.php");
        } else {
            echo "please enter a valid username and password";
        }
    }
    public function logout(){
        Session_start();

unset($_SESSION['username']);
header("Location: login.php");




    }
}




?>