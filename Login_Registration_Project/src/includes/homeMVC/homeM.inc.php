<?php

function checkPriv($PDO,$usr){
  $query = "SELECT * FROM roles where username= :usr";
  $statmnt = $PDO->prepare($query);
  $statmnt->bindParam(":usr",$usr);
  $statmnt->execute();
  $result = $statmnt->fetch();
  
  return $result;
}