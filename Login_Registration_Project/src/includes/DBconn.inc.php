<?php
$config = parse_ini_file('../Private/config.ini');

try {
    $PDO = new PDO("mysql:host=".$config['servername'].";dbname=".$config['dbname'], $config['username'], $config['password'] );
    $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    echo "you have an error connceting to DB".$e->getMessage();
}
