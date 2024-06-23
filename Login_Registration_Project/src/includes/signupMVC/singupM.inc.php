<?php


function getUsername($PDO,$username){
    $query = "select username from users where username = :username;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":username",$username);
    $statmnt->execute();
    $result = $statmnt->fetch();
    return $result;

}

function getEmail($PDO,$email){
    $query = "select email from users where email = :email;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":email",$email);
    $statmnt->execute();
    $result = $statmnt->fetch();
    return $result;
}

function insertUser($PDO,$username,$passwd,$email){
    $query="INSERT INTO users(username,passwd,email,invCounter) VALUES(:username,:passwd,:email,0);";
    $statmnt = $PDO->prepare($query);
    $hashedPass = password_hash($passwd,PASSWORD_BCRYPT,['cost'=>15]);
    $statmnt->bindParam(":username",$username);
    $statmnt->bindParam(":passwd",$hashedPass);
    $statmnt->bindParam(":email",$email);
    $statmnt->execute(); 
}


function enable_2FA($PDO,$username,$secret){
    $query = "UPDATE users SET 2faCode = :sec where username = :user ;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":sec",$secret);
    $statmnt->bindParam(":user",$username);
    $statmnt->execute(); 

}

function is2FAen($PDO,$username){
    $query = "select 2faCode from users where username= :user";
    $stm = $PDO->prepare($query);
    $stm->bindParam(":user",$username);
    $stm->execute();

    $result = $stm->fetch();
  

    if ($result['2faCode'] === "0"){
        return false;
    }
    else{
        return true;
    }
}

function get2FAkey($PDO,$username){
    $query = "select 2faCode from users where username= :user";
    $stm = $PDO->prepare($query);
    $stm->bindParam(":user",$username);
    $stm->execute();
    $result = $stm->fetch();
    return $result['2faCode'] ;
}


function badPassComp($password){
    $uppercase   = preg_match('@[A-Z]@', $password);
    $lowercase   = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    if(!$uppercase || !$lowercase || !$specialChars || strlen($password) < 8) {
        return true;
    }else{
       return false;
    }

}
