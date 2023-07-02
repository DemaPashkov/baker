<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Смена</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Cотрудники</th>
                        <th>Дата начала</th>
                        <th>Дата окончания</th>
                    </tr>

                    <?php 
                       
                      
                        $suppliers = mysqli_query($conn, "SELECT * FROM shifts" );
                       
                        $query = mysqli_query($conn,"SELECT * FROM shifts");
                        for($data = []; $row = mysqli_fetch_assoc($query); $data [] = $row);
                   
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM employees where id_employees = '$supplier[id_employees]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_shifts'] . "</td>";
                            echo "<td>" .  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . "</td>";
                            echo "<td>" .  $supplier['date_start'] . "</td>";
                            echo "<td>" .  $supplier['date_end'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_shifts']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_shifts']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['id_employees'])) and !empty($_POST['date_start']) and !empty($_POST['date_end'])){
        $id_employees=$_POST['id_employees'];
        $date_start=$_POST['date_start'];
        $date_end=$_POST['date_end'];
        mysqli_query($conn, "INSERT INTO `shifts` (`id_shifts`, `id_employees`, `date_start`, `date_end`) VALUES (NULL, '$id_employees', '$date_start', '$date_end')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}

?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Cотрудники</p>
            <select name="id_employees" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM employees ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_employees'].'>'.  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . '</option>';
            }
            ?>
            </select>
            <p>Дата начала</p>
            <input class="form_for-text" type="date" name="date_start">
            <p>Дата окончания</p>
            <input class="form_for-text" type="date"  name="date_end"> <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM shifts where id_shifts={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM shifts" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        
                        echo'
                        <div class="dobaxit_danne"> 
                            <h2>Изменить данные</h2>
                            <p>Cотрудники</p>
                            <select name="id_employees">
                            ';

                            $querys = mysqli_query($conn,"SELECT * FROM employees ");
                            while($rows = mysqli_fetch_assoc($querys)){
                                echo '<option value='.$rows['id_employees'].'>'.  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . '</option>';
                            } 

                            echo '
                            
                            </select>
                            <p>Дата начала</p>
                            <input class="form_for-text" type="date" required name="date_start" value='.$supplier["date_start"].'>
                            <p>Дата окончания</p>
                            <input class="form_for-text" type="date" required name="date_end" value='.$supplier["date_end"].'>
                           
                          
                        </div> <br>';
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $id_employees=$_POST['id_employees'];
                    $date_start=$_POST['date_start'];
                    $date_end=$_POST['date_end'];
                    mysqli_query($conn, "UPDATE `shifts` SET `id_employees` = '$id_employees', `date_start` = '$date_start', `date_end` =  '$date_end' where id_shifts = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM shifts WHERE id_shifts = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section> 

<?php
include 'footer.php';
?>