<?php
$server = 'sql.freedb.tech';
$username = 'freedb_intel2024';
$password = 'rBxUn5*%EESvNv!';
$database = 'freedb_tiendaelectronica';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Conected failed: '.$e->getMessage()); 
    
   
}

?>