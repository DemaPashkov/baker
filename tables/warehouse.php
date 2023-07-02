<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Склад</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Продукты</th>
                        <th>Количество</th>
                    </tr>

                    <?php 
                       
                      
                        $suppliers = mysqli_query($conn, "SELECT * FROM warehouse" );
                       
                        $query = mysqli_query($conn,"SELECT * FROM warehouse");
                        for($data = []; $row = mysqli_fetch_assoc($query); $data [] = $row);
                   
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM products where id_products = '$supplier[id_products]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_warehouse'] . "</td>";
                            echo "<td>" .  $rows['name_products'] . " </td>";
                            echo "<td>" .  $supplier['quantity'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_warehouse']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_warehouse']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['id_products'])) and !empty($_POST['quantity'])){
        $id_products=$_POST['id_products'];
        $quantity=$_POST['quantity'];
        mysqli_query($conn, "INSERT INTO `warehouse` (`id_warehouse`, `id_products`, `quantity`) VALUES (NULL, '$id_products', '$quantity')");
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
            <select name="id_products" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM products ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_products'].'>'.  $rows['name_products'] . '</option>';
            }
            ?>
            </select>
            <p>Количество</p>
            <input class="form_for-text" type="text" name="quantity"> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM warehouse where id_warehouse={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM warehouse" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        
                        echo'
                        <div class="dobaxit_danne"> 
                            <h2>Изменить данные</h2>
                            <p>Продукты</p>
                            <select name="id_products">
                            ';

                            $querys = mysqli_query($conn,"SELECT * FROM products ");
                            while($rows = mysqli_fetch_assoc($querys)){
                                echo '<option value='.$rows['id_products'].'>'.  $rows['name_products'] . '</option>';
                            } 
                            echo '
                            </select>
                            <p>Количество</p>
                            <input class="form_for-text" type="text" required name="quantity" value='.$supplier["quantity"].'>
                        </div> <br>';
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $id_products=$_POST['id_products'];
                    $quantity=$_POST['quantity'];
                    mysqli_query($conn, "UPDATE `warehouse` SET `id_products` = '$id_products', `quantity` = '$quantity' where id_warehouse = {$_GET['red_id']}");
                    header("Refresh:0");
                   
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM warehouse WHERE id_warehouse = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section> 

<?php
include 'footer.php';
?>