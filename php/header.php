<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BISTROY</title>
    <link rel="stylesheet" href="../css/style.css">
    <!-- <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script> -->

</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/logo/logo.svg" alt="">
        </div>
        <nav>
            <ul>
                <li><a href="../index.php">Главная</a></li>
                <li><a href="../product.php">Наши услуги</a></li>
                <li><a href="../contact.php">Контакты</a></li>
                <?php 
        require_once('bd.php');
        session_start();
                   if (isset($_SESSION['login_user'] )) {
                    $user_check = $_SESSION['login_user'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
                    $rows = mysqli_fetch_array($query);
                    $status = $rows['admin'];
                    $id_user = $rows['id_user'];
                    if($status == 1){
                        // header("Location: ../account/admin.php");
                        $admin = '<li><a href="../account/admin.php">Личный кабинет</a></li>';
                    }else{
                        $admin = '<li><a href="account.php">Личный кабинет</a></li>';
                    }
                    
                    echo  $admin;

                }  else{
                   
                    echo '<li><a id="myBtn">Личный кабинет</a></li>';
                }
                ?>
                <!-- <li><a href="cart.php">Личный кабинет</a></li> -->
            </ul>
        </nav>
        <div class="icon">
       
            
           
        </div>
        
    </header> 

<!-- auth -->
    <div class="modal-container" id="myModal">
        <div class="modal-wrapper">
            <div class="modal">
                <form action="php/login.php" method="POST">
                <label for="email">Email</label><br>
                <input type="email" required  name="email"><br>
                <label for="password">Пароль</label><br>
                <input type="password" required name="password"><br>
                <!-- <div style="height: 100px"
                id="captcha-container"
                class="smart-captcha" 
                data-sitekey="ysc1_mFfff6eYybbeI24jjJMXshNhjavOWo0Yb2DyQyxo4d7e893a"
                ></div> -->
                <!-- <label for="password">Код</label><br>
                <input type="password" required name="code"><br> -->
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
                <!-- <div style="height: 100px"
                id="captcha-container"
                class="smart-captcha" 
                data-sitekey="ysc1_mFfff6eYybbeI24jjJMXshNhjavOWo0Yb2DyQyxo4d7e893a"
                ></div> -->
                <button name="registration">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/register.js"></script>
    <script src="js/auth.js"></script>

