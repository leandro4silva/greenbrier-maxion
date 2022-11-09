<?php
    include_once("helpers/url.php");
    include_once("helpers/connection.php");
    include_once("helpers/process.php");

    if(isset($_SESSION['msg'])){
        $printMsg = $_SESSION['msg'];
        $_SESSION['msg'] = '';
    }

    if(isset($_SESSION['sales'])){
        $sales = $_SESSION['sales'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenbrier Maxion</title>
    <link rel="stylesheet" href="<?= $BASE_URL ?>assets/css/styles.css">
    <script src="https://unpkg.com/phosphor-icons"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script src="./assets/js/main.js" defer type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header>
        <nav class="container">
            <a class="logo" href="<?= $BASE_URL ?>index.php">
                <img src="<?= $BASE_URL ?>assets/img/php.svg" alt="PHP">
            </a>
            <ul>
                <li>
                    <a href="<?= $BASE_URL ?>product.php">Produtos</a>
                </li>
            </ul>
        </nav>
    </header>
    