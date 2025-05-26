<?php
$server = 'localhost';
$username = 'root';
$password = '14$2025';
$database = 'tiendaelectronica';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die('Conected failed: '.$e->getMessage()); 
    
   
}

?>
