<?php

function IsAnyEmpty( $username ,$passwd,$email){
    if(empty($username) || empty($passwd || empty($email))){
        return true;
    }
    else{
        return false;
    }
}

function takenUsername($PDO,$username){
    if(getUsername($PDO,$username)){
        return true;
    }
    else{
        return false;
    }

} 

function invalidEmail($email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        return true;
    }
    else{
        return false;
    }
}

function IsEmailRegistered($PDO,$email){
    if(getEmail($PDO,$email)){
        return true;
    }
    else{
        return false;
    }

}

function createUser($PDO,$username,$passwd,$email){
    insertUser($PDO,$username,$passwd,$email);
}

