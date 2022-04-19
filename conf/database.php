<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'tiendaonline';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username, $password);
} catch (PDOException $error) {
    die('Conection Failed: '.$error->getMessage());
}