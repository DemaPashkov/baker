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
                <li><a href="admin.php">Админка</a></li>
                <li><a href="sql.php">Sql</a></li>
                <li><a href="table.php">Таблицы</a></li>
            </ul>
        </nav>
        <div class="icon">
        <?php 
        session_start();
                   if (isset($_SESSION['login_user'])) {
                    echo '<a href="../php/account.php"><img src="../img/icon/user.svg" alt=""></a>';

                }  else{
                    echo '<div id="myBtn"><img src="../img/icon/user.svg" alt=""></div>';
                }
                   ?>
            
           
            <a href="exit.php">Выйти</a>
        </div>
        
    </header> 
