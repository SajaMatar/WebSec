<?php
require_once "./sessionMang.inc.php";
//session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION["beenInPassReset"])) {
    if (!isset($_SESSION['Subs'])) {
        unset($_SESSION["beenInPassReset"]);
        $_SESSION['Subs'] = 1;
        require_once "./DBconn.inc.php";
        require_once "./passResetMVC/passResetM.inc.php";
        require_once "./passResetMVC/passResetC.inc.php";
        require_once "./mailer.php";
      
        
        if (!isEmpty($_POST['email'])) {
            if (isEmailVaild($_POST['email'])) {
                $tok = createToken($PDO, $_POST['email']);
                if ($tok) {
                    $_SESSION['valToken'] = true;
                    $_SESSION['email'] = $_POST['email'];
                          
            mailer("Password Reset","This is your token please dont share! ".$tok);

                } else {
                    $_SESSION['errors']['EmailNotReged']= "This email isnt registered.";
                    header("Location: ../ValidateToken.php");
                    die();     
                }

            } else {
                $_SESSION['errors']["invalidEmail"] = "invalid email!";
            }
        } 
        else {
            $_SESSION['errors']["EmptyEmailField"] = "Enter an email!";
        }


        if (isset($_SESSION['errors'])) {
            header("Location: ../PassReset.php");
            die();
        } else {
           header("Location: ../ValidateToken.php");
            die();
        }
    } else {
        $_SESSION['Subs'] += 1;
        $_SESSION['errors']['SubbedBefore'] = "Already submitted an email! ";
        header("Location: ../PassReset.php");
        die();
    }

} else {
   // echo $_SERVER['REQUEST_METHOD']." ".$_SESSION["beenInPassReset"];
    header("Location: ../PassReset.php");
    exit();
}
