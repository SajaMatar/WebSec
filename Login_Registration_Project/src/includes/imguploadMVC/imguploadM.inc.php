<?php
function insertImage($PDO,$name){
    $query = "UPDATE users SET imageName=:imgname WHERE username=:user;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":imgname",$name);
    $statmnt->bindParam(":user",$_SESSION['usr']);
    $statmnt->execute();
}

function getImage($PDO){
    $query = "SELECT imageName FROM users WHERE username=:user;";
    $statmnt = $PDO->prepare($query);
    $statmnt->bindParam(":user",$_SESSION['usr']);
    $statmnt->execute();
    $result = $statmnt->fetch();

    return $result['imageName'];
}
