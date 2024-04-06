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
    echo '<p>ADMIN</p></div></body></html>';     
}
else{
    echo '<p>USER</p></div></body></html>';  
}

//echo '<form action="./logout.php" method="post"> 
 echo '<a href="./logout.php"><button class="btn" type="submit">Logout</button></a> ';
//</form>';
}

