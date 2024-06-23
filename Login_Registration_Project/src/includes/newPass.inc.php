<?php 
require_once "./sessionMang.inc.php";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_SESSION['beenInNewPass']) && isset($_SESSION['AuthedForNewPass']) ){
    if($_POST['new_password'] === $_POST['confirm_password']){
        require_once "./DBconn.inc.php";
        require_once "./passResetMVC/passResetM.inc.php";
        require_once "./passResetMVC/passResetC.inc.php";
        require_once "./signupMVC/singupM.inc.php";

        if(badPassComp($_POST['new_password'])){
            $_SESSION['errors']['badComp']='Password should be at least 8 characters in length, should include at least one upper case letter, one number and one special character.';
            header("Location: ../NewPass.php");
            die();
        }
        else{    
        updatePass($PDO,$_POST['new_password']);
        deleteToken($PDO,$_SESSION['AuthedForNewPass']);
        $_SESSION['Subs']=0;
        $_SESSION['UpdatedSucc']='Password Updated Successfully try login  .... ';
        header("Location: ../index.php");
        die();
        }

   }
   else{
   $_SESSION['errors']['PassesDontMatch']='The two passwords dont match ...';
   header("Location: ../NewPass.php");
   die();
}

}
else{
    header("Location: ../index.php");
    die();
}
