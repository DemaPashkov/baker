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
                <li><a href="../index.php">Главная</a></li>
                <li><a href="../product.php">Продукция</a></li>
                <li><a href="../contact.php">Контакты</a></li>
                <li><a href="../cart.php">Коризина</a></li>
            </ul>
        </nav>
        <div class="icon">
        <?php 
        session_start();
        require_once('bd.php');
                   if (isset($_SESSION['login_user'] )) {
                    $user_check = $_SESSION['login_user'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
                    $rows = mysqli_fetch_array($query);
                    $status = $rows['admin'];
                    $id_user = $rows['id_user'];
                    if($status ==1){
                        // header("Location: ../account/admin.php");
                        $admin = '<a href="../account/admin.php"><img src="../img/icon/user.svg" alt=""></a>';
                    }else{
                        $admin = '<a href="account.php"><img src="../img/icon/user.svg" alt=""></a>';
                    }
                    
                    echo  $admin;
                   

                }  else{
                  
                       
                  
                    echo '<div id="myBtn"><img src="../img/icon/user.svg" alt=""></div>';
                }
                   $sqlf = mysqli_query($conn, "SELECT SUM(count) as total_quantity
                        FROM cart where id_users = '$id_user'
                        GROUP BY id_products;");
                        $rowsd2 = mysqli_fetch_assoc($sqlf);
                        $nums = mysqli_num_rows($sqlf);
                       echo'<div class="countsss">   
                       <p>'.$nums.'</p>
                       </div>
                       ';?>
            
            <a href="../cart.php"><img src="../img/icon/cart.svg" alt=""></a>
            <a href="exit.php">Выйти</a>
        </div>
        
    </header> 

<!-- auth -->
    <div class="modal-container" id="myModal">
        <div class="modal-wrapper">
            <div class="modal">
                <form action="php/login.php" method="POST">
                <label for="email">Email</label><br>
                <input type="text" required name="email"><br>
                <label for="password">Пароль</label><br>
                <input type="password" required name="password"><br>
                <button name="login">Войти</button><br><br>
                <div class="register-auth" id="myBtn2"><p>Зарегистрироваться</p></div>
                </form>
            </div>
        </div>
    </div>
    
    
    <!-- register -->
    <div class="modal-container2" id="myModal2">
        <div class="modal-wrapper2">
            <div class="modal2">
                <form action="php/register.php" method="POST">
                <label for="name">ФИО</label><br>
                <input type="text" required id="name" name="name"><br>
                <label for="tel">Номер телефона</label><br>
                <input type="text" required id="tel" name="number"><br>
                <label for="email">Email</label><br>
                <input type="text" required id="email" name="email"><br>
                <label for="password">Пароль</label><br>
                <input type="password" required id="password" name="password"><br><br>
                <button name="registration">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/register.js"></script>
    <script src="js/auth.js"></script>

