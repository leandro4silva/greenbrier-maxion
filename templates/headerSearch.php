<?php
    include_once("helpers/url.php");
    include_once("helpers/connection.php");
    include_once("helpers/process.php");
     
    if(isset($_SESSION['msg'])){
        $printMsg = $_SESSION['msg'];
        $_SESSION['msg'] = '';
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
</head>

<body>
    <header>
        <nav class="container nav-search">
            <a class="logo" href="<?= $BASE_URL ?>index.php">
                <img src="<?= $BASE_URL ?>assets/img/php.svg" alt="PHP">
            </a>
            <ul>
                <li>
                    <form class="search" action="<?= $BASE_URL ?>helpers/process.php" method="POST">
                        <input type="hidden" name="type" value="search">
                        <input type="text" placeholder="Pesquisar pelo produto" name="name">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
