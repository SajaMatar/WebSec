<?php

function isEmpty($field){
if(empty($field))return true;
else{return false;}
}

function isEmailVaild($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }
    else{return false;}
}

