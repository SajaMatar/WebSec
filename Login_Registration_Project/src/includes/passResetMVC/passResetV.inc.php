<?php
function showErrors(){
if(isset($_SESSION["errors"])){
        foreach ($_SESSION["errors"] as $err){
            echo "<p align ='center'style='
            font-family: Arial, sans-serif;z
            background: #F2DEDE;
            color: #E63219;
            padding: 5px;
            width: 90%;
            border-radius: 5px;
            margin: 10px auto;'><b>".$err."</b></p>";
        }
        
        unset($_SESSION["errors"]);
} }

function operationStatus(){
    if(isset($_SESSION['Subs']) && $_SESSION['Subs'] > 1){
        echo '<p align="center" style="
        font-family: Arial, sans-serif;
        font-style:italic;
        font-weight:bold;
        color: #555;
        padding: 5px;
        width: 90%;
        border-radius: 5px;
        margin: 10px auto;">
        if the previously submitted email is valid, you will recieve a token.
         <p align="center" style="
         font-family: Arial, sans-serif;
         font-size:13px;
         font-weight:bold;
         color: #555;
         padding: 5px;
         width: 70%;
         border-radius: 5px;
         margin: 10px auto;"> note: the token expires after 10mins </p>
          </p>
          
          <form action="./ValidateToken.php" method="post">
          <input type="submit" value="Submit recieved Token">
          </form>
          </p>          
      </form>';

    }
}