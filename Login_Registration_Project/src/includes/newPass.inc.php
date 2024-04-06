<?php 
require_once "./sessionMang.inc.php";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SESSION['beenInNewPass']) && isset($_SESSION['AuthedForNewPass'])){
    if($_POST['new_password'] === $_POST['confirm_password']){
        require_once "./DBconn.inc.php";
        require_once "./passResetMVC/passResetM.inc.php";
        require_once "./passResetMVC/passResetC.inc.php";
       
        updatePass($PDO,$_POST['new_password']);
        deleteToken($PDO,$_SESSION['AuthedForNewPass']);
        $_SESSION['UpdatedSucc']='Password Updated Successfully try login  .... ';
        header("Location: ../index.php");
        die();


   }
   else{
   $_SESSION['errors']['PassesDontMatch']='The two passwords dont match ...';
   header("Location: ../NewPass.php");
}

}
else{
    header("Location: ../index.php");
    die();
}