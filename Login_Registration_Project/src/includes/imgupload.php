<?php
require_once "./sessionMang.inc.php";

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_SESSION['authed'] )){
    $_SESSION['upload']=1;
    require_once("./loginMVC/loginV.inc.php");
    
   echo '<!DOCTYPE html>
   <html lang="en">
   <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Image Uploader</title>
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
   
   input[type="file"] {
     margin-bottom: 20px;
   }
   
   button {
     padding: 10px;
     background-color: #007bff;
     color: #fff;
     border: none;
     border-radius: 5px;
     cursor: pointer;
     transition: background-color 0.3s ease;
   }
   
   button:hover {
     background-color: #0056b3;
   }
   
   button:active {
     background-color: #004185;
   }
   
</style>
   </head>
   <body>
   
   <div class="container">
     <h2>Upload Image</h2>
     <form action="imgupload.inc.php" method="post" enctype="multipart/form-data">
       <input type="file" name="image" id="image" accept="image/*" required>
       <button type="submit">Upload</button>
     </form>';
     showErrors();
       
   echo '</div>
   </body>
   </html>
 ';
}

else {
    header("Location: ../index.php");
    die();
}
