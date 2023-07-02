<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Поставщики</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Поставщики</th>
                        <th>Адрес</th>
                        <th>Номер телефона</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM suppliers";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM suppliers" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_suppliers'] . "</td>";
                            echo "<td>" .  $supplier['name_suppliers'] . "</td>";
                            echo "<td>" .  $supplier['address'] . "</td>";
                            echo "<td>" .  $supplier['number'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_suppliers']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_suppliers']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name_suppliers'])) and !empty($_POST['address']) and !empty($_POST['number'])){
        $suppliers=$_POST['name_suppliers'];
        $address=$_POST['address'];
        $number=$_POST['number'];
        mysqli_query($conn, "INSERT INTO `suppliers` (`id_suppliers`, `name_suppliers`, `address`, `number`) VALUES (NULL, '$suppliers', '$address', '$number')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Поставщики</p>
            <input class="form_for-text" type="text" name="name_suppliers">
            <p>Адресс</p>
            <input class="form_for-text" type="text" name="address">
            <p>Номер телефона</p>
            <input class="form_for-text" type="tel" placeholder="+7 (XXX) XXX-XX-XX" name="number"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM suppliers where id_suppliers={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM suppliers" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Поставщики</p>
                            <input class='form_for-text' type='text' required name='name_suppliers_u' value='{$supplier['name_suppliers']}'/>
                            <p>Адресс</p>
                            <input class='form_for-text' type='text' required name='address_u' value='{$supplier['address']}'/>
                            <p>Номер телефона</p>
                            <input class='form_for-text' type='text' required name='number_u' value='{$supplier['number']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $suppliers=$_POST['name_suppliers_u'];
                    $address=$_POST['address_u'];
                    $number=$_POST['number_u'];
                    $query = "UPDATE `suppliers` SET `name_suppliers` = '$suppliers', `address` = '$address', `number` =  '$number' where id_suppliers = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `suppliers` SET `name_suppliers` = '$suppliers', `address` = '$address', `number` =  '$number' where id_suppliers = {$_GET['red_id']}");
                    header("Refresh:0");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM suppliers WHERE id_suppliers = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>