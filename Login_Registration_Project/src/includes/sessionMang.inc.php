<?php

  session_set_cookie_params([
    'lifetime' => 60*30,
    'domain' => "myserver.com",
    'path' => "/",
    'secure' => true,
    'httponly' => true   
  ]);

session_start();

function HandleID() {
if(isset($_SESSION['generatedAt'])){
  $intrv = 60*30;
 
  if ($intrv < time()-$_SESSION['generatedAt']){
   session_regenerate_id(); 
   $_SESSION['generatedAt']= time();
  }
} else{
   session_regenerate_id(); 
   $_SESSION['generatedAt']= time();
}


}

















