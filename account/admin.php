<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $surname = $rows['surname'];
    $names = $rows['name'];
    $status = $rows['admin'];
    $number = $rows['number'];
    $email = $rows['email'];
    $date_birth = $rows['date_birth'];

    if($status ==1){
        $admin = 'Администратор';
    }else{
        $admin = 'Покупатель';
    }
} else {
    header('Location index.php');
}
?>

<main class="main_admin admins">

    <section class="blocksss">
        <div class="df">
            <div class="img">
                <img src="../img/elements/2.png" alt="">
            </div>
            <div class="texts">
                <p><?=$surname;?> <?=$names;?> - <span><?=$admin;?></span></p>
                <p><span>Номер телефона: </span><?=$number;?></p>
                <p><span>Почта: </span><?=$email;?></p>
                <p><span>Дата рождения: </span><?=$date_birth;?></p>
                
            </div>
        </div>
</section>
</main>  


<?php
include 'footer.php';
?>