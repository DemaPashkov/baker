<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Заказы</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Пользователь</th>
                        <th>Дата</th>
                        <th>Продукты</th>
                        <th>Цена</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM orders";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM orders" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM users where id_user = '$supplier[id_user]'");
                            $rows = mysqli_fetch_assoc($querys);
                            $prosuctts = mysqli_query($conn,"SELECT * FROM products where id_products = '$supplier[id_products]'");
                            $rows2 = mysqli_fetch_assoc($prosuctts);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_orders'] . "</td>";
                            echo "<td>" .  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . "</td>";
                            echo "<td>" .  $supplier['date_orders'] . "</td>";
                            echo "<td>" .  $rows2['name_products'] . "</td>";
                            echo "<td>" .  $supplier['price'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_orders']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_orders']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['id_user'])) and !empty($_POST['date_orders']) and !empty($_POST['id_products']) and !empty($_POST['price'])){
        $id_user=$_POST['id_user'];
        $date_orders=$_POST['date_orders'];
        $id_products=$_POST['id_products'];
        $price=$_POST['price'];
        mysqli_query($conn, "INSERT INTO `orders` (`id_orders`, `id_user`, `date_orders`, `id_products`, `price`) VALUES (NULL, '$id_user', '$date_orders', '$id_products', '$price')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Пользователь</p>
            <select name="id_user" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM users ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_user'].'>'.  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . '</option>';
            }
            ?>
            </select>
            <p>Дата</p>
            <input class="form_for-text" type="date" name="date_orders">
            <p>Продукты</p>
            <select name="id_products" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM products ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_products'].'>'.  $rows['name_products'] . '</option>';
            }
            ?>
            </select>
            <p>Цена</p>
            <input class="form_for-text" type="text" name="price"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM orders where id_orders={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM orders" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Пользователь</p>
                            <select name='id_user'>
                           ";
                           $querys = mysqli_query($conn,"SELECT * FROM users ");
                            while($rows = mysqli_fetch_assoc($querys)){
                               echo '<option value='.$rows['id_user'].'>'.  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . '</option>';
                           } 
                           echo "
                           </select>
                           <p>Дата</p>
                            <input class='form_for-text' type='date' required name='date_orders' value='{$supplier['date_orders']}'/>
                            <p>Продукты</p>
                            <select name='id_products'>
                           ";
                           $querys = mysqli_query($conn,"SELECT * FROM products ");
                            while($rows = mysqli_fetch_assoc($querys)){
                                echo '<option value='.$rows['id_products'].'>'.  $rows['name_products'] . '</option>';
                           } 
                           echo "
                           </select>
                            <p>Цена</p>
                            <input class='form_for-text' type='text' required name='price' value='{$supplier['price']}'/>
                         <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form> </div>';
                
                if (!empty($_POST['update'])){
                    $id_user=$_POST['id_user'];
                    $date_orders=$_POST['date_orders'];
                    $id_products=$_POST['id_products'];
                    $price=$_POST['price'];
                    mysqli_query($conn, "UPDATE `orders` SET `id_user` = '$id_user', `date_orders` = '$date_orders', `id_products` =  '$id_products', `price` =  '$price' where id_orders = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM orders WHERE id_orders = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>