<?php

function isEmpty($file){
    if(filesize($file) === 0){
        return true;
    }
    else{
        return false;
    }
}

function notImage($file){
    if(!$file){
        $_SESSION['errors']['excp_img']="Your file is huge we wont accept it!";
        return 2;
    }
    $allowed = ['image/png' => 'png', 'image/jpeg'=>'jpg'];
    $type= finfo_file(finfo_open(FILEINFO_MIME_TYPE),$file);

    if(in_array($type,array_keys($allowed))){
        $_SESSION['imgext']=$allowed[$type];
        return 0;
    }
    else{
        return 1;
    } 
}

function tooLargefile($file){
    if(filesize($file) > 3145728){
        return true;
    }
    else{
        return false;
    }


}
