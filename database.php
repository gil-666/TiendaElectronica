<?php
$server = 'localhost';
$username = 'root';
$password = 'PASS';
$database = 'tiendaelectronica';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Conected failed: '.$e->getMessage()); 
    
   
}

?>
