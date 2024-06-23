<?php
function homePage($PDO, $usr)
{
    echo '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome Page</title>
        <link rel="stylesheet" href="../../css/welcome.css">    
    </head>
    
    <body>
        <div class="container"> <h1>Welcome ' .htmlspecialchars($usr) . '!</h1>
        <p>We\'re glad you\'re here.</p>';

if(checkPriv($PDO,$usr)){
    echo '<p>ADMIN</p>';     
}
else{
    echo '<p>USER</p>';  
}
require_once "./loginMVC/loginV.inc.php";
showErrors();
Update();
 echo '</div></body></html><p align="center"> <a href="./logout.php"><button class="btn" type="submit">Logout</button></a> ';

 echo '<a href="./en2fa.php"><button class="btn" type="submit">Enable 2FA</button></a>' ;
 
 echo '<a href="./imgupload.php"><button class="btn" type="submit">Upload An Image</button></a> ' ;

 echo '<a href="./blog.php"><button class="btn" type="submit">Blog</button></a> ' ;



 if(isset($_SESSION['display_image'])){
    echo '<br><a href="./imghide.php"><button class="btn" type="submit">Hide Image</button></a> </p>' ;

    require_once "./imageuploadMVC/imageuploadM.inc.php";
    $imgname = getImage($PDO);
 
    echo'
      <div class="circular-image">
        <img src="../uploads/'.$imgname.'" alt="user Image">
      </div>
      </body>
      </html>
    ';  
    
 }
 else{
    echo '<br><a href="./imgdisplay.php"><button class="btn" type="submit">Display Image</button></a> </p>  </body>
    </html> ' ;
 }

 
}
