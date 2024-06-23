<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_SESSION['authed']) && isset($_SESSION['upload'])){
    require_once('./imageuploadMVC/imageuploadC.inc.php');
    require_once('./imageuploadMVC/imageuploadM.inc.php');



 
    if(isEmpty($_FILES['image']['tmp_name'])){
        $_SESSION['errors']['img']="you must upload a file!";
    }  

    else {
        $check = notImage( $_FILES['image']['tmp_name']);
        if($check==1){
            $_SESSION['errors']['notimg']="file must be an image!";
        }
         else if($check==0) {
            if(tooLargefile($_FILES['image']['tmp_name'])){
                $_SESSION['errors']['Largeimg']="file must be less than 3MB";
            }
            else{
                require_once("./DBconn.inc.php");
                $uploadsDir='../uploads/';
                $newName= bin2hex(random_bytes(10)).'.'.$_SESSION['imgext'];
                unset($_SESSION['imgext']);

                if(move_uploaded_file($_FILES['image']['tmp_name'],$uploadsDir.$newName)){
                    $_SESSION['UpdatedSucc']="image uploaded successfully!";
                    insertImage($PDO,$newName);
                    header("Location: ./welcome.inc.php");
                    die();
                }
                else{
                    $_SESSION['errors']['upimgerror']="Error while uploading image ..";
                }   
            }
        }
        
    }

    if(isset($_SESSION['errors'])){
        header("Location: ./imgupload.php");
        die();
    }


}

else { 
    header("Location: ../index.php");
    die();
}
