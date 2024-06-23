<?php
function getPosts($PDO){
    $query = "select * from posts";
    $stmnt = $PDO->prepare($query);
    $stmnt->execute();
    
    $stmnt->setFetchMode(PDO::FETCH_OBJ);
    $result = $stmnt->fetchall();
     if($result)
      {
        foreach($result as $row){
        
          echo "<html><div id='posts-container'>";
          echo "<div class='post'>";

          echo "<h2>" . $row->title . "</h2>";

          echo "<p style='font-size: 14px'>" . $row->username." " . $row->Published  ."</p>";

          echo"<p>". htmlentities($row->Post,ENT_QUOTES,'UTF-8'). "</p>";
          
          echo "</div></div></html>";
        }
      }

      else{
        echo "<center><span> No Blog Posts Found </span></center>";
      }


}


function insertPost($PDO,$title,$content){
    $query = "insert into posts (username,title,Post) VALUES (:user,:titl,:post);";
    $stmnt = $PDO->prepare($query);
    $stmnt->bindParam(":user",$_SESSION['usr']);
    $stmnt->bindParam(":titl",$title);
    $stmnt->bindParam(":post",$content);
    $stmnt->execute();   

    $_SESSION['UpdatedSucc']="Your Post is out now! ";
}
