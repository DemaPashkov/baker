<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Отчеты</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Продукты</th>
                        <th>Дата отчета</th>
                        <th>Выручка</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM reports";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM reports" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_reports'] . "</td>";
                            echo "<td>" .  $supplier['id_products'] . "</td>";
                            echo "<td>" .  $supplier['date_reporting'] . "</td>";
                            echo "<td>" .  $supplier['revenue'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_reports']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_reports']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['id_products'])) and !empty($_POST['date_reporting']) and !empty($_POST['revenue'])){
        $id_products=$_POST['id_products'];
        $date_reporting=$_POST['date_reporting'];
        $revenue=$_POST['revenue'];
        mysqli_query($conn, "INSERT INTO `reports` (`id_reports`, `id_products`, `date_reporting`, `revenue`) VALUES (NULL, '$id_products', '$date_reporting', '$revenue')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Продукты</p>
            <input class="form_for-text" type="text" name="id_products">
            <p>Дата отчета</p>
            <input class="form_for-text" type="date" name="date_reporting">
            <p>Выручка</p>
            <input class="form_for-text" type="text"  name="revenue"> <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM reports where id_reports={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM reports" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Продукты</p>
                            <input class='form_for-text' type='text' required name='id_products' value='{$supplier['id_products']}'/>
                            <p>Дата отчета</p>
                            <input class='form_for-text' type='date' required name='date_reporting' value='{$supplier['date_reporting']}'/>
                            <p>Выручка</p>
                            <input class='form_for-text' type='text' required name='revenue' value='{$supplier['revenue']}'/>
                          
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $id_products=$_POST['id_products'];
                    $date_reporting=$_POST['date_reporting'];
                    $revenue=$_POST['revenue'];
                    mysqli_query($conn, "UPDATE `reports` SET `id_products` = '$id_products', `date_reporting` = '$date_reporting', `revenue` =  '$revenue' where id_reports = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM reports WHERE id_reports = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section> 
<?php
include 'footer.php';
?>