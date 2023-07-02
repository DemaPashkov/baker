<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ПаПик</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/logo/logo.svg" alt="">
        </div>
        <nav>
            <ul>
                <li><a href="../account/admin.php">Главная</a></li>
                <li><a href="../account/sql.php">Sql Запросы</a></li>
                <li><a href="../account/table.php">База данных</a></li>
            </ul>
        </nav>
        <div class="icon">
        <?php 
        error_reporting(0);
        session_start();

                   if (isset($_SESSION['login_user'])) {
                    echo '<a href="../php/account.php"><img src="../img/icon/user.svg" alt=""></a>';

                }else{
                    echo '<div id="myBtn"><img src="../img/icon/user.svg" alt=""></div>';
                }
                   ?>
                   
            
            <img src="../img/icon/cart.svg" alt="">
        </div>
        
    </header> 
