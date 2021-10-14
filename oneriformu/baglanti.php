<?php
$host = "localhost";
$user = "##";
$pass = "##";
$database = "##";
try {
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Bağlantı hatası: " . $e->getMessage();
    }
?>