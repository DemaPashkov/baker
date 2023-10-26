<?php
include 'header.php';
include '../php/bd.php';
?>

<section class="admins">
    
<div class="blocksss">
        <div class="">
            <div class="">
                <nav class="table_section-nav"> 
                    <ul> 
                      <?php
                    
                      $sql = "SHOW FULL TABLES FROM bistroy WHERE TABLE_TYPE != 'VIEW';";
                      $result = mysqli_query($conn, $sql);
                    
                      // output database names
                      if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          if($row['Tables_in_bistroy'] == 'Addresses'){
                            $tables = 'Addresses';
                            $href = 'Addresses.php';
                          }if($row['Tables_in_bistroy'] == 'Couriers'){
                            $tables = 'Couriers';
                            $href = 'Couriers.php';
                          }if(($row['Tables_in_bistroy'] == 'Customers')){
                            $tables = 'Customers';
                            $href = 'Customers.php';
                          }if(($row['Tables_in_bistroy'] == 'images')){
                            $tables = 'Images';
                            $href = 'images.php';
                          }if(($row['Tables_in_bistroy'] == 'Image_product')){
                            $tables = 'Image_product';
                            $href = 'Image_product.php';
                          }if($row['Tables_in_bistroy'] == 'Orders'){
                            $tables = 'Orders';
                            $href = 'orders.php';
                          }if($row['Tables_in_bistroy'] == 'Order_Items'){
                            $tables = 'Order_Items';
                            $href = 'Order_Items.php';
                          }if($row['Tables_in_bistroy'] == 'Product'){
                            $tables = 'Product';
                            $href = 'Product.php';
                          }if($row['Tables_in_bistroy'] == 'products'){
                            $tables = 'Products';
                            $href = 'products.php';
                          }if($row['Tables_in_bistroy'] == 'Reviews'){
                            $tables = 'Reviews';
                            $href = 'Reviews.php';
                          }if($row['Tables_in_bistroy'] == 'users'){
                            $tables = 'Users';
                            $href = 'users.php';
                          }
                          echo '<li><a href="../tables/'.$href.'" class="">'.$tables ."</a></li><br>";
                        }
                      }

                      ?>
                     
                        
                    </ul>
                </nav>
            </div>
        </div>
</div>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Продукты</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Описание</th>
                        <th>Дата производства </th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM products";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM products" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                    
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_products'] . "</td>";
                            echo "<td>" .  $supplier['name_products'] . "</td>";
                          
                            echo "<td>" .  $supplier['price'] . "</td>";
                          
                            echo "<td>" .  $supplier['description'] . "</td>";
                          
                            echo "<td>" .  $supplier['date_manufacture'] . "</td>";
                        
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
    if ((!empty($_POST['name_products'])) and !empty($_POST['price'])  and !empty($_POST['description']) and !empty($_POST['date_manufacture'])){
        $name_products=$_POST['name_products'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $date_manufacture=$_POST['date_manufacture'];
        mysqli_query($conn, "INSERT INTO `products` (`id_products`, `name_products`,  `price`,  `description`,  `date_manufacture`) VALUES (NULL, '$name_products', '$price', '$description', '$date_manufacture')");
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
           
            <p>Цена</p>
            <input class="form_for-text" type="text"  name="price"> 
            
            <p>Описание</p>
            <input class="form_for-text" type="text" name="description">
           
            <p>Дата производства</p>
            <input class="form_for-text" type="date"  name="date_manufacture"> 
            
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
                            
                            <p>Цена</p>
                            <input class='form_for-text' type='text' required name='price' value='{$supplier['price']}'/>
                           
                            <p>Описание</p>
                            <input class='form_for-text' type='text' required name='description' value='{$supplier['description']}'/>
                            <p>Дата производства</p>
                            <input class='form_for-text' type='date' required name='date_manufacture' value='{$supplier['date_manufacture']}'/>
                           
                         <br>";
                    }
                echo '<br><input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form> </div>';
                
                if (!empty($_POST['update'])){
                    $name_products=$_POST['name_products'];
                    $price=$_POST['price'];
                    $description=$_POST['description'];
                    $date_manufacture=$_POST['date_manufacture'];
                    mysqli_query($conn, "UPDATE `products` SET `name_products` = '$name_products', `price` =  '$price',  `description` =  '$description', `date_manufacture` =  '$date_manufacture' where id_products = {$_GET['red_id']}");
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