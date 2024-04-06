<?php
function IsAnyEmpty($username, $passwd){
    if (empty($username) || empty($passwd)) {
        return true;
    } else {
        return false;
    }
}


function checkCreds($PDO, $username, $passwd){
    $result = getUser($PDO, $username);
    if ($result) {
        
        if (correctPass($result, $passwd)) {
            if(!isBlocked($PDO,$username)){
                ZeroInvCounterU($PDO,$username);
                return true;}

           else{
                $_SESSION['email']=$result['email'];
                require_once "./mailer.php"; 
                mailer("BLOCKED","Too many invalid logins have been attempted. to restore the account reset the password.");
         return false; }
        }
        
        else {
            invCounter($PDO,$username); 
            return false;
        }
        
    } 
    
    else {
        return false;
    }
}
