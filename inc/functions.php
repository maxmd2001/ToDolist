<?php

class Sign{
    // check of the
    function validate($email, $pass, $rePass = false){
        // email, password check
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $_SESSION['err'] = 'it is not an email';
            return false;
        }
        elseif(strlen($pass) < 6){
            $_SESSION['err'] = 'the password is shorter than 6';
            return false;
        }
        elseif($pass != $rePass && $rePass != false){
            $_SESSION['err'] ='the passwords are not equal';
            return false;

        }

        return true;
    }

    // make a new account
    function signUp($email, $pass){
        // get $conn
        global $conn;

        try {
            // hashed password 
            $hasedPassword = password_hash($pass, PASSWORD_BCRYPT);

            // add the new account
            $conn->query("use app1");
            $sql = "INSERT INTO aaccounts (email, password) VALUES (:email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':email' => $email, ':password' => $hasedPassword]);

            $_SESSION['err'] = 'sign up sesscufly';

            // transfer to index
            header("Location: index.php");

        } catch (PDOException $th) {            
            $_SESSION['err'] = 'the email is used';
            // die($th);
        }
    }

    // check if the email is in the database only
    function signInWIthEmail($email){  

        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM aaccounts WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;

        } catch (PDOException $th) {
            $_SESSION['err'] = 'can\'t sign in now try again later';
        }         


    }



}

$sign = new Sign();
// echo 'meowww';



?>