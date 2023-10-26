<?php

if (isset($_POST['registration'])) {
    
    // Получаем данные из формы
    $username = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $paswword_hash = md5($password);

    // Проверяем, что все поля заполнены
    if (empty($username) || empty($number) || empty($email) || empty($password)) {
        exit();
    }
   
    require_once('bd.php');

    
   
    $sql = mysqli_query($conn, "INSERT INTO users (name, number, email, password, admin) VALUES ('$username', '$number','$email', '$paswword_hash', '0')");
    header('Location: ../index.php ');
}


?>

