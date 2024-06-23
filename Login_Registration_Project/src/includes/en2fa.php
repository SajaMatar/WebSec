<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['authed'] )){
    require_once "./DBconn.inc.php";
    require_once "./signupMVC/singupM.inc.php";
    require_once("./vendor/autoload.php");


    if ( !is2FAen($PDO,$_SESSION['usr']) ) {

    $Obj2fa = new PragmaRX\Google2FA\Google2FA();
    $userSecret = $Obj2fa->generateSecretKey();

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f1f1f1;
      }
      
      .container {
      
        max-width: 400px;
        margin: 400px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
      
      h2 {
        text-align: center;
      }
      
      form {
        display: flex;
        flex-direction: column;
      }
     
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA Secret Code </title>
    <link rel="stylesheet" href="SecCode.css">
    </head>
    <body>
    <div class="container">
      <h2>Secret Code</h2>
      <p>Your secret code is:  <b>'.$userSecret.'</b> </p>
      <div class="secret-code" id="secret-code"></div>
    </div>
    
    </body>
    </html>
    ';
  
    enable_2FA($PDO,$_SESSION['usr'],$userSecret);
    }

    else{
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
          }
          
          .container {
          
            max-width: 400px;
            margin: 400px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }
          
          h2 {
            text-align: center;
          }
          
          form {
            display: flex;
            flex-direction: column;
          }
          
          label {
            font-weight: bold;
          }
               
          button:active {
            background-color: #004185;
          }
          
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>2FA Secret Code </title>
        <link rel="stylesheet" href="SecCode.css">
        </head>
        <body>
        <div class="container">
          <h2> 2FA is already enabled</h2>
        </div>
        
        </body>
        </html>
        ';
    }

    
}

else {
    header("Location: ../index.php");
    die();
}
