<?php
require_once('bd.php');
include 'header.php';

if (isset($_SESSION['login_user'] )) {
    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $id_user = $rows['id_user'];
    
    mysqli_query($conn, "UPDATE `users` SET `confirmation` = '1' where id_user = '$id_user'");
   
} else {
    // header('Location index.php');
    echo "<h1>Сначала войди в аккаунт!!</h1>";
}
?>

<section class="head-product">
    <div class="head-product-main">
        <div class="head-product-header">
            <h1>Ура! Поздравляю!   <p>Вы подтвердили почту!</p></h1>
           
        </div>
        <div class="head-product-content">
        <div class="head-product-content-block">
            <h3>Вернуться на : <a href="../index.php">Главную</a></h3>
        </div>
        </div>
        
    </div>
</section>
<?php
include 'footer.php';?>