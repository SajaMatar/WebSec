<?php
function showErrors(){
if(isset($_SESSION["errors"])){
        foreach ($_SESSION["errors"] as $err){
            echo "<p align ='center'style='
            background: #F2DEDE;
            color: #E63219;
            padding: 5px;
            width: 90%;
            border-radius: 5px;
            margin: 10px auto;'><b>".$err."</b></p>";
        }
        
        unset($_SESSION["errors"]);
} }


function Update(){
if(isset($_SESSION['UpdatedSucc'])){
    echo "<p align ='center' style='
    background:#D4EDDA ;
    color: #40754C;
    padding: 5px;
    width: 90%;
    border-radius: 5px;
    margin: 10px auto;'><b>".$_SESSION['UpdatedSucc']."</b></p>";
    unset($_SESSION['UpdatedSucc']);
} }