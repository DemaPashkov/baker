<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
    error_reporting(0);
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Ингридиенты</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Поставщик</th>
                        <th>Дата поставки</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM ingredients";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM ingredients" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM suppliers where id_suppliers = '$supplier[id_suppliers]'");
                            $rows = mysqli_fetch_assoc($querys);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_ingredients'] . "</td>";
                            echo "<td>" .  $supplier['name_ingredients'] . "</td>";
                            echo "<td>" .  $supplier['price'] . "</td>";
                            echo "<td>" .  $supplier['quantity'] . "</td>";
                            echo "<td>" .  $rows['name_suppliers'] . "</td>";
                            echo "<td>" .  $supplier['date_supply'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_ingredients']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_ingredients']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name_ingredients'])) and !empty($_POST['price']) and !empty($_POST['quantity']) and !empty($_POST['id_suppliers']) and !empty($_POST['date_supply'])){
        $name_ingredients=$_POST['name_ingredients'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];
        $id_suppliers=$_POST['id_suppliers'];
        $date_supply=$_POST['date_supply'];
        mysqli_query($conn, "INSERT INTO `ingredients` (`id_ingredients`, `name_ingredients`, `price`, `quantity`, `id_suppliers`, `date_supply`) VALUES (NULL, '$name_ingredients', '$price', '$quantity', '$id_suppliers','$date_supply')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Наименование</p>
            <input class="form_for-text" type="text" name="name_ingredients">
            <p>Цена</p>
            <input class="form_for-text" type="text" name="price">
            <p>Количество</p>
            <input class="form_for-text" type="text"  name="quantity"> <br> 
            <p>Поставщик</p>
            <select name="id_suppliers" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM suppliers ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_suppliers'].'>'.  $rows['name_suppliers'] . '</option>';
            }
            ?>
            </select>
            <p>Дата поставки</p>
            <input class="form_for-text" type="date"  name="date_supply"> <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM ingredients where id_ingredients={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM ingredients" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Наименование</p>
                            <input class='form_for-text' type='text' required name='name_ingredients' value='{$supplier['name_ingredients']}'/>
                            <p>Цена</p>
                            <input class='form_for-text' type='text' required name='price' value='{$supplier['price']}'/>
                            <p>Количество</p>
                            <input class='form_for-text' type='text' required name='quantity' value='{$supplier['quantity']}'/>
                            <p>Поставщик</p>
                            <select name='id_suppliers'>
                            ";
                         

                            $querys = mysqli_query($conn,"SELECT * FROM suppliers ");
                            while($rows = mysqli_fetch_assoc($querys)){
                                echo '<option value='.$rows['id_suppliers'].'>'.  $rows['name_suppliers'] .'</option>';
                            } 
 
                            
                            echo "
                            </select>
                            <p>Дата поставки</p>
                            <input class='form_for-text' type='text' required name='date_supply' value='{$supplier['date_supply']}'/>
                        <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>  </div>';
                
                if (!empty($_POST['update'])){
                    $name_ingredients=$_POST['name_ingredients'];
                    $price=$_POST['price'];
                    $quantity=$_POST['quantity'];
                    $id_suppliers=$_POST['id_suppliers'];
                    $date_supply=$_POST['date_supply'];
                    mysqli_query($conn, "UPDATE `ingredients` SET `name_ingredients` = '$name_ingredients', `price` = '$price', `quantity` =  '$quantity', `id_suppliers` = '$id_suppliers',  `date_supply` = '$date_supply' where id_ingredients = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM ingredients WHERE id_ingredients = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>