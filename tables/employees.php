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
                        <th>Звание</th>
                        <th>Номер телефона</th>
                        <th>Почта</th>
                        <th>Дата рождения</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM employees";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM employees" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM position where id_position = '$supplier[id_position]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_employees'] . "</td>";
                            echo "<td>" .  $supplier['surname'] . "</td>";
                            echo "<td>" .  $supplier['name'] . "</td>";
                            echo "<td>" .  $supplier['otchestvo'] . "</td>";
                            echo "<td>" .  $rows['name_position'] . "</td>";
                            echo "<td>" .  $supplier['number'] . "</td>";
                            echo "<td>" .  $supplier['email'] . "</td>";
                            echo "<td>" .  $supplier['date_birth'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_employees']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_employees']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['surname'])) and !empty($_POST['name']) and !empty($_POST['otchestvo']) and !empty($_POST['id_position']) and !empty($_POST['number']) and !empty($_POST['email']) and !empty($_POST['date_birth'])){
        $surname=$_POST['surname'];
        $name=$_POST['name'];
        $otchestvo=$_POST['otchestvo'];
        $id_position=$_POST['id_position'];
        $number=$_POST['number'];
        $email=$_POST['email'];
        $date_birth=$_POST['date_birth'];
        mysqli_query($conn, "INSERT INTO `employees` (`id_employees`, `surname`, `name`, `otchestvo`, `id_position`, `number`, `email`,`date_birth`) VALUES (NULL, '$surname', '$name', '$otchestvo', '$id_position','$number','$email', '$date_birth')");
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
            <p>Звание</p>
            <select name="id_position" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM position ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_position'].'>'.  $rows['name_position'] . '</option>';
            }
            ?>
            </select>
            <p>Номер телефона</p>
            <input class="form_for-text" type="tel" placeholder="+7 (XXX) XXX-XX-XX" name="number"> <br> 
            <p>Почта</p>
            <input class="form_for-text" type="email"  name="email"> <br> 
            <p>Дата рождения</p>
            <input class="form_for-text" type="date"  name="date_birth"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM employees where id_employees={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM employees" );
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
                            <p>Звание</p>
                            <select name='id_position'>
                           ";
                         

                           $querys = mysqli_query($conn,"SELECT * FROM position ");
                           while($rows = mysqli_fetch_assoc($querys)){
                               echo '<option value='.$rows['id_position'].'>'.  $rows['name_position'] .'</option>';
                           } 

                           
                           echo "
                           </select>
                            <p>Номер телефона</p>
                            <input class='form_for-text' type='text' required name='number' value='{$supplier['number']}'/>
                            <p>Почта</p>
                            <input class='form_for-text' type='text' required name='email' value='{$supplier['email']}'/>
                            <p>Дата рождения</p>
                            <input class='form_for-text' type='text' required name='date_birth' value='{$supplier['date_birth']}'/>
                        ";
                    }
                echo '<br><br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>
                </div>';
                
                if (!empty($_POST['update'])){
                    $surname=$_POST['surname'];
                    $name=$_POST['name'];
                    $otchestvo=$_POST['otchestvo'];
                    $id_position=$_POST['id_position'];
                    $number=$_POST['number'];
                    $email=$_POST['email'];
                    $date_birth=$_POST['date_birth'];
                    mysqli_query($conn, "UPDATE `employees` SET `surname` = '$surname', `name` = '$name', `otchestvo` =  '$otchestvo', `id_position` = '$id_position',  `number` = '$number', `email` = '$email', `date_birth` = '$date_birth'  where id_employees = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM employees WHERE id_employees = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>