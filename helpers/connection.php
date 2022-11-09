<?php 
    $host = 'localhost';
    $dbname = 'maxion';
    $user = 'leandro';
    $password = 'Le123479le12@';

    try{
        $conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        $error = $e->getMessage();
        echo "Erro: $error";
    }

?>