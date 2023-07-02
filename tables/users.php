<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Сотрудники</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Номер телефона</th>
                        <th>Почта</th>
                        <th>Дата рождения</th>
                        <th>Роль</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM users";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM users" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        
                        foreach($data as $supplier) {
                            if ($supplier['admin'] == 1){
                                $rols = 'Администратор';
                            }else{
                                $rols = 'Покупатель';
                            }
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_user'] . "</td>";
                            echo "<td>" .  $supplier['surname'] . "</td>";
                            echo "<td>" .  $supplier['name'] . "</td>";
                            echo "<td>" .  $supplier['otchestvo'] . "</td>";
                            echo "<td>" .  $supplier['number'] . "</td>";
                            echo "<td>" .  $supplier['email'] . "</td>";
                            echo "<td>" .  $supplier['date_birth'] . "</td>";
                            echo "<td>" .  $rols . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_user']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_user']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['surname'])) and !empty($_POST['name']) and !empty($_POST['otchestvo']) and !empty($_POST['number']) and !empty($_POST['email']) and !empty($_POST['date_birth'])  and !empty($_POST['admin'])){
        $surname=$_POST['surname'];
        $name=$_POST['name'];
        $otchestvo=$_POST['otchestvo'];
        $number=$_POST['number'];
        $email=$_POST['email'];
        $date_birth=$_POST['date_birth'];
        $admin=$_POST['admin'];
        mysqli_query($conn, "INSERT INTO `users` (`id_users`, `surname`, `name`, `otchestvo`, `number`, `email`,`date_birth`, `admin`) VALUES (NULL, '$surname', '$name', '$otchestvo','$number','$email', '$date_birth', '$admin')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Фамилия</p>
            <input class="form_for-text" type="text" name="surname">
            <p>Имя</p>
            <input class="form_for-text" type="text" name="name">
            <p>Отчество</p>
            <input class="form_for-text" type="text"  name="otchestvo"> <br> 
            <p>Номер телефона</p>
            <input class="form_for-text" type="tel" placeholder="+7 (XXX) XXX-XX-XX" name="number"> <br> 
            <p>Почта</p>
            <input class="form_for-text" type="email"  name="email"> <br> 
            <p>Дата рождения</p>
            <input class="form_for-text" type="date"  name="date_birth"> <br> <br>
            <p>Роль</p>
            <input class="form_for-text" type="text"  name="admin"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM users where id_user={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM users" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Фамилия</p>
                            <input class='form_for-text' type='text' required name='surname' value='{$supplier['surname']}'/>
                            <p>Имя</p>
                            <input class='form_for-text' type='text' required name='name' value='{$supplier['name']}'/>
                            <p>Отчество</p>
                            <input class='form_for-text' type='text' required name='otchestvo' value='{$supplier['otchestvo']}'/>
                            <p>Номер телефона</p>
                            <input class='form_for-text' type='text' required name='number' value='{$supplier['number']}'/>
                            <p>Почта</p>
                            <input class='form_for-text' type='text' required name='email' value='{$supplier['email']}'/>
                            <p>Дата рождения</p>
                            <input class='form_for-text' type='date' required name='date_birth' value='{$supplier['date_birth']}'/>
                            <p>Роль</p>
                            <input class='form_for-text' type='text' required name='admin' value='{$supplier['admin']}'/>
                         <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form> </div>';
                
                if (!empty($_POST['update'])){
                    $surname=$_POST['surname'];
                    $name=$_POST['name'];
                    $otchestvo=$_POST['otchestvo'];
                    $number=$_POST['number'];
                    $email=$_POST['email'];
                    $date_birth=$_POST['date_birth'];
                    $admin=$_POST['admin'];
                    mysqli_query($conn, "UPDATE `users` SET `surname` = '$surname', `name` = '$name', `otchestvo` =  '$otchestvo', `number` = '$number', `email` = '$email', `date_birth` = '$date_birth', `admin` = '$admin'  where id_user = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM users WHERE id_user = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>