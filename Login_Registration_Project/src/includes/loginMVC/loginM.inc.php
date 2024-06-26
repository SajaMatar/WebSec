<?php
function getUser($PDO,$username){
    $query = "select * from users where username = :username;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":username",$username);
    $statmnt->execute();
    $result = $statmnt->fetch(PDO::FETCH_ASSOC);
    return $result;
}



function correctPass($result,$passwd){
if(password_verify($passwd,$result["passwd"])){
    return true;
}
else{return false;}
}

function IsBlocked($PDO,$username){
    $query = "select * from users where username = :username;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":username",$username);
    $statmnt->execute();
    $result=$statmnt->fetch(PDO::FETCH_ASSOC);
   if ($result['invCounter'] < 4) {return false;}
   else {return true; }
}

function  invCounter($PDO,$username){
    $query = "UPDATE users SET invCounter = invCounter+1 WHERE username = :username;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":username",$username);
    $statmnt->execute();
}

function  ZeroInvCounterU($PDO,$username){
    $query = "UPDATE users SET invCounter = 0 WHERE username = :username;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":username",$username);
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
