<?php

require_once('bd.php');

if (isset($_POST['login'])) {

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $paswword_hash = md5($password);
       
        $query = "SELECT * FROM users WHERE email = '$email' and password = '$paswword_hash'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $status = $row['admin'];
       



        if($status ==1){
            session_start();
            $_SESSION['login_user'] = $email;
             header("Location: ../account/admin.php");
            echo"yes";
        }else{
            session_start();
            $_SESSION['login_user'] = $email;
            header("location: account.php");
            echo"no";
        }
        
    } else {
        echo ' <script>
        alert("Неправильные данные");
    </script>';
        // header("location: ../index.php");
    }
       
    }
    
}


?>
