<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $names = $rows['name'];
    $status = $rows['admin'];

} else {
    header('Location index.php');
}
?>
 <link rel='stylesheet' href='../css/style.css'> 
<main class="main_admin admins">

    <section class="blocksss">
        <div class="">
            <div class="">
                <nav class="table_section-nav"> 
                    <ul> 
                      <?php
                      $conn = mysqli_connect("localhost", "root", "root", "baker");
                      $sql = "SHOW FULL TABLES FROM baker WHERE TABLE_TYPE != 'VIEW';";
                      $result = mysqli_query($conn, $sql);
                    
                      // output database names
                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          if($row['Tables_in_baker'] == 'category'){
                            $tables = 'Категория';
                            $href = 'category.php';
                          }if($row['Tables_in_baker'] == 'delivery'){
                            $tables = 'Доставка';
                            $href = 'delivery.php';
                          }if(($row['Tables_in_baker'] == 'employees')){
                            $tables = 'Сотрудники';
                            $href = 'employees.php';
                          }if($row['Tables_in_baker'] == 'ingredients'){
                            $tables = 'Ингридиенты';
                            $href = 'ingredients.php';
                          }if($row['Tables_in_baker'] == 'orders'){
                            $tables = 'Заказы';
                            $href = 'orders.php';
                          }if($row['Tables_in_baker'] == 'position'){
                            $tables = 'Должность';
                            $href = 'position.php';
                          }if($row['Tables_in_baker'] == 'products'){
                            $tables = 'Продукты';
                            $href = 'products.php';
                          }if($row['Tables_in_baker'] == 'recipes'){
                            $tables = 'Рецепты';
                            $href = 'recipes.php';
                          }if($row['Tables_in_baker'] == 'reports'){
                            $tables = 'Отчеты';
                            $href = 'reports.php';
                          }if($row['Tables_in_baker'] == 'requestCall'){
                            $tables = 'Обратные звонки';
                            $href = 'requestCall.php';
                          }if($row['Tables_in_baker'] == 'sales'){
                            $tables = 'Скидки';
                            $href = 'sales.php';
                          }if($row['Tables_in_baker'] == 'shifts'){
                            $tables = 'Смены';
                            $href = 'shifts.php';
                          }if($row['Tables_in_baker'] == 'suppliers'){
                            $tables = 'Поставщики';
                            $href = 'suppliers.php';
                          }if($row['Tables_in_baker'] == 'users'){
                            $tables = 'Пользователи';
                            $href = 'users.php';
                          }if($row['Tables_in_baker'] == 'warehouse'){
                            $tables = 'Склад';
                            $href = 'warehouse.php';
                          }
                          if($row['Tables_in_baker'] == 'cart'){
                            $tables = 'Коризины пользователей';
                            $href = 'cart.php';
                          }
                          echo '<li><a href="../tables/'.$href.'" class="">'.$tables ."</a></li><br>";
                        }
                      }

                      ?>
                     
                        
                    </ul>
                </nav>
            </div>
        </div>
</section>
</main>  

<?php
include 'footer.php';
?>