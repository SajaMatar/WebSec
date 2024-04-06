<?php

function isEmailRegistered($PDO,$email){
    $query = "SELECT ID From users where email = :email;";
    $statmnt=$PDO->prepare($query);
    $statmnt->bindParam(':email',$email);
    $statmnt->execute();
    $result = $statmnt->fetch();
    return $result;    
}

function createToken($PDO,$email){
    try{
        if(isEmailRegistered($PDO,$email)){
            $query = "INSERT INTO PassReset(email,token) VALUES (:email,:token)";
            $statmnt=$PDO->prepare($query);
            $statmnt->bindParam(':email',$email);
            $rands = random_bytes(20);
            $token = (bin2hex($rands));
            $hashed_token = sha1($token);
            $statmnt->bindParam(':token',$hashed_token);
            $statmnt->execute();

            return  $token;
        }
        else{
            return false;
    } }   
    catch (PDOException $E){
        $_SESSION['errors']['alreadySent']="A token has already been sent ..";
    }
}

function getToken($PDO,$token){
    $query = "SELECT * From PassReset where token = :token;";
    $statmnt=$PDO->prepare($query);
    $statmnt->bindParam(':token',$token);
    $statmnt->execute();
    $result = $statmnt->fetch(PDO::FETCH_ASSOC);
    return $result;    
}

function isTokenValid($PDO,$tok){   
   $token = getToken($PDO,sha1($tok));

    if($token){
       
        if(time() - $token['created'] < 600){
            $_SESSION['AuthedForNewPass']=$token['token'];
            header("Location: ../../NewPass.php");
        }
        else{
            deleteToken($PDO,$token['token']);
            unset($_SESSION['Subs']);
            $_SESSION['errors']['invalidToken']= "Invalid Token ... ";
            header("Location: ../../ValidateToken.php");
        }

    } 
    else{
        $_SESSION['errors']['invalidToken']="Invalid Token ...";
        header("Location: ../../ValidateToken.php");
    }
 }


 function deleteToken($PDO,$token){
    $query = "DELETE FROM PassReset WHERE token = :token;";
    $statmnt=$PDO->prepare($query);
    $statmnt->bindParam(':token',$token);
    $statmnt->execute();
 }



 function updatePass($PDO,$new_pass){
    $query = "UPDATE users SET passwd=:passwd,invCounter=0 WHERE email=:email;";
    $statmnt = $PDO->prepare($query);
    $hashedPass = password_hash($new_pass,PASSWORD_BCRYPT,['cost'=>12]);
    $statmnt->bindParam(':passwd',$hashedPass);
    $statmnt->bindParam(':email', $_SESSION['email']);
    $statmnt->execute();
}