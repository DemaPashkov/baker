<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Рецепты</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Ингридиенты</th>
                        <th>Количество</th>
                        <th>Продукты </th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM recipes";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM recipes" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            $querys = mysqli_query($conn,"SELECT * FROM ingredients where id_ingredients = '$supplier[id_ingredients]'");
                            $rows = mysqli_fetch_assoc($querys);
                            $products = mysqli_query($conn,"SELECT * FROM products where id_products = '$supplier[id_products]'");
                            $rows2 = mysqli_fetch_assoc($products);
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_recipes'] . "</td>";
                            echo "<td>" .  $supplier['name_recipes'] . "</td>";
                            echo "<td>" .  $rows['name_ingredients'] . "</td>";
                            echo "<td>" .  $supplier['quantity'] . "</td>";
                            echo "<td>" .  $rows2['name_products'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_recipes']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_recipes']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name_recipes'])) and !empty($_POST['id_ingredients']) and !empty($_POST['quantity']) and !empty($_POST['id_products'])){
        $name_recipes=$_POST['name_recipes'];
        $id_ingredients=$_POST['id_ingredients'];
        $quantity=$_POST['quantity'];
        $id_products=$_POST['id_products'];
        mysqli_query($conn, "INSERT INTO `recipes` (`id_recipes`, `name_recipes`, `id_ingredients`, `quantity`, `id_products`) VALUES (NULL, '$name_recipes', '$id_ingredients', '$quantity', '$id_products')");
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
            <input class="form_for-text" type="text" name="name_recipes">
            <p>Ингридиенты</p>
            <select name="id_ingredients" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM ingredients ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_ingredients'].'>'.  $rows['name_ingredients'] . '</option>';
            }
            ?>
            </select>
            <p>Количество</p>
            <input class="form_for-text" type="text"  name="quantity"> 
            <p>Продукты</p>
            <select name="id_products" >
            <?php
            $querys = mysqli_query($conn,"SELECT * FROM products ");
            while($rows = mysqli_fetch_assoc($querys)){
            echo '<option value='.$rows['id_products'].'>'.  $rows['name_products'] . '</option>';
            }
            ?>
            </select> <br> <br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM recipes where id_recipes={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM recipes" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Наименование</p>
                            <input class='form_for-text' type='text' required name='name_recipes' value='{$supplier['name_recipes']}'/>
                            <p>Ингридиенты</p>
                            <select name='id_ingredients'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM ingredients ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id_ingredients'].'>'.  $rows['name_ingredients'] . '</option>';
                            }
                            echo" 
                            </select>
                            <p>Количество</p>
                            <input class='form_for-text' type='text' required name='quantity' value='{$supplier['quantity']}'/>
                            <p>Продукты</p>
                            <select name='id_products'>
                            ";
                            $querys = mysqli_query($conn,"SELECT * FROM products ");
                            while($rows = mysqli_fetch_assoc($querys)){
                            echo '<option value='.$rows['id_products'].'>'.  $rows['name_products'] . '</option>';
                            }
                            echo "
                            </select>
                            <br> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>  </div>';
                
                if (!empty($_POST['update'])){
                    $name_recipes=$_POST['name_recipes'];
                    $id_ingredients=$_POST['id_ingredients'];
                    $quantity=$_POST['quantity'];
                    $id_products=$_POST['id_products'];
                    mysqli_query($conn, "UPDATE `recipes` SET `name_recipes` = '$name_recipes', `id_ingredients` = '$id_ingredients', `quantity` =  '$quantity', `id_products` =  '$id_products' where id_recipes = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM recipes WHERE id_recipes = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section> 

<?php
include 'footer.php';
?>