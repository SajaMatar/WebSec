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
