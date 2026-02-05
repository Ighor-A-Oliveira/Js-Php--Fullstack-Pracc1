<?php
$host = "localhost";
$port = "3307";
$dbname = "myfirstdatabase";
$dbusername="root";
$dbpassword = "";

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
try{
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    // if an error happens we throw an exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage()); 
}