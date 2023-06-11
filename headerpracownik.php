<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION["user_id"])){
    $mysqli = require "dbh_inc.php";
    $sql = "SELECT * FROM employees WHERE id = {$_SESSION["user_id"]}";
    $result = mysqli_query($mysqli,$sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel pracownika</title>
    <link rel="icon" href="img/logo2.png">
    <!--pliki css -->
    <link rel="stylesheet" href="css/style.css">
    
    <!--skrypty -->
    
</head>
<body>
    
    <!--nagłówek -->
    <header>
        <div class="logo">Cukiernia internetowa</div>
        <nav>
            <ul class ="nav_links">
                <li><a href="panelpracownika.php">Zamówienia</a></li>
                <li><a href="add_product.php">Dodaj ciasto</a></li>
                <li><a href="change_product.php">Edytuj dostępność</a></li>
                <?php if (isset($user)): ?>
                    <li><a href="logout.php">Wyloguj</a></li>
                <?php endif; ?>
                
                <select class="langOption" id="langSwitcher">
                    <option value="pl">PL</option>
                    <option value="pl">EN</option>
                </select>
            </ul>
        </nav>
    </header>
