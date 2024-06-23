<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION["beenInsignup"])) {
   unset($_SESSION["beenInsignup"]);
   require_once "./DBconn.inc.php";
   require_once "./signupMVC/singupM.inc.php";
   require_once "./signupMVC/singupC.inc.php";

   $username = $_POST['username'];
   $passwd = $_POST['password'];
   $email = $_POST['email'];

   // make input checks ... 
   if (IsAnyEmpty($username, $passwd, $email)) {
      $_SESSION["errors"]["empty_field"] = "Fill in all Fields!";
   } else {
      if (takenUsername($PDO,$username)) {
         $_SESSION["errors"] ["invalid_username"] = "username exists!";
      }

      if (invalidEmail($email)) {
         $_SESSION["errors"] ["invalid_email"] = "invalid email !!";
      } else {
         if (IsEmailRegistered($PDO,$email)) {
            $_SESSION["errors"] ["regid_email"] = "already registered email!";
         }
      }
      
      if(badPassComp($passwd)){
         $_SESSION["errors"] ["pass"] = "Password should be at least 8 characters in length, should include at least one upper case letter, one number and one special character.";
      }
   }

   // send them back to signup.php if any Errors where found ... 
   if ( isset($_SESSION["errors"])) {
      header("Location: ../signup.php");
      die();
   }

   // continue regis if not. ..
   createUser($PDO,$username, $passwd, $email);

   // if all worked
   header("Location: ../index.php?Signup=1");

} else {
   header("Location: ../signup.php");
   die();
}
