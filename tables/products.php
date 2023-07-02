<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Продукты</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Описание</th>
                        <th>Фото</th>
                        <th>Дата производства </th>
                        <th>Сотрудник</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM products";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM products" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM category where id_category = '$supplier[id_category]'");
                            $rows = mysqli_fetch_assoc($querys);
                            $prosuctts = mysqli_query($conn,"SELECT * FROM employees where id_employees = '$supplier[id_employees]'");
                            $rows2 = mysqli_fetch_assoc($prosuctts);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_products'] . "</td>";
                            echo "<td>" .  $supplier['name_products'] . "</td>";
                            echo "<td>" .  $rows['name_category'] . "</td>";
                            echo "<td>" .  $supplier['price'] . "</td>";
                            echo "<td>" .  $supplier['quantity'] . "</td>";
                            echo "<td>" .  $supplier['description'] . "</td>";
                            echo "<td>" .  $supplier['photo'] . "</td>";
                            echo "<td>" .  $supplier['date_manufacture'] . "</td>";
                            echo "<td>" .  $rows2['surname'] . " " .  $rows2['name'] . " " .  $rows2['otchestvo'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_products']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_products']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name_products'])) and !empty($_POST['id_category']) and !empty($_POST['price']) and !empty($_POST['quantity'])and !empty($_POST['description']) and !empty($_POST['photo']) and !empty($_POST['date_manufacture']) and !empty($_POST['id_employees'])){
        $name_products=$_POST['name_products'];
        $id_category=$_POST['id_category'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];
        $description=$_POST['description'];
        $photo=$_POST['photo'];
        $date_manufacture=$_POST['date_manufacture'];
        $id_employees=$_POST['id_employees'];
        mysqli_query($conn, "INSERT INTO `products` (`id_products`, `name_products`, `id_category`, `price`, `quantity`, `description`, `photo`, `date_manufacture`, `id_employees`) VALUES (NULL, '$name_products', '$id_category', '$price', '$quantity', '$description', '$photo', '$date_manufacture', '$id_employees')");
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
            <input class="form_for-text" type="text" name="name_products">
            <p>Категория</p>
            <select name="id_category" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM category ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_category'].'>'.  $rows['name_category'] . '</option>';
            }
            ?>
            </select>
            <p>Цена</p>
            <input class="form_for-text" type="text"  name="price"> 
            <p>Количество</p>
            <input class="form_for-text" type="text" name="quantity">
            <p>Описание</p>
            <input class="form_for-text" type="text" name="description">
            <p>Фото</p>
            <input class="form_for-text" id="photo" hidden type="file" name="photo">
            <label for="photo">Загрузить фото</label>
            <p>Дата производства</p>
            <input class="form_for-text" type="date"  name="date_manufacture"> 
            <p>Сотрудник</p>
            <select name="id_employees" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM employees ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_employees'].'>'.  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . '</option>';
            }
            ?> 
            </select>
            <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM products where id_products={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM products" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Наименование</p>
                            <input class='form_for-text' type='text' required name='name_products' value='{$supplier['name_products']}'/>
                            <p>Категория</p>
                            <select name='id_category'>
                           ";
                           $querys = mysqli_query($conn,"SELECT * FROM category ");
                            while($rows = mysqli_fetch_assoc($querys)){
                               echo '<option value='.$rows['id_category'].'>'.  $rows['name_category'] . '</option>';
                           } 
                           echo "
                           </select>
                            <p>Цена</p>
                            <input class='form_for-text' type='text' required name='price' value='{$supplier['price']}'/>
                            <p>Количество</p>
                            <input class='form_for-text' type='text' required name='quantity' value='{$supplier['quantity']}'/>
                            <p>Описание</p>
                            <input class='form_for-text' type='text' required name='description' value='{$supplier['description']}'/>
                            <p>Дата производства</p>
                            <input class='form_for-text' type='date' required name='date_manufacture' value='{$supplier['date_manufacture']}'/>
                            <p>Сотрудник</p>
                            <select name='id_employees'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM employees ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id_employees'].'>'.  $rows['surname'] . " " .  $rows['name'] . " " .  $rows['otchestvo'] . '</option>';
                            }
                            echo "
                            </select>
                         <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form> </div>';
                
                if (!empty($_POST['update'])){
                    $name_products=$_POST['name_products'];
                    $id_category=$_POST['id_category'];
                    $price=$_POST['price'];
                    $quantity=$_POST['quantity'];
                    $description=$_POST['description'];
                    $date_manufacture=$_POST['date_manufacture'];
                    $id_employees=$_POST['id_employees'];
                    mysqli_query($conn, "UPDATE `products` SET `name_products` = '$name_products', `id_category` = '$id_category', `price` =  '$price', `quantity` =  '$quantity', `description` =  '$description', `date_manufacture` =  '$date_manufacture', `id_employees` =  '$id_employees' where id_products = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM products WHERE id_products = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>