<?php
    $hostname = "localhost";
    $database = "rh";
    $user = "root";
    $password = "usbw";

    try
    {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Falha Na Conexão: " . $e->getMessage();
    }
?>