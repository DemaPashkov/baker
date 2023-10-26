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
            <div class="naz_tabl"><h2>Orders</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>customer_id</th>
                        <th>order_date</th>
                        <th>delivery_time</th>
                        <th>delivery_cost</th>
                        <th>courier_id</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Orders";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Orders" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['order_id'] . "</td>";
                            echo "<td>" .  $supplier['customer_id'] . "</td>";
                            echo "<td>" .  $supplier['order_date'] . "</td>";
                            echo "<td>" .  $supplier['delivery_time'] . "</td>";
                            echo "<td>" .  $supplier['delivery_cost'] . "</td>";
                            echo "<td>" .  $supplier['courier_id'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['order_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['order_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['customer_id']) and !empty($_POST['order_date']) and !empty($_POST['delivery_time']) and !empty($_POST['delivery_cost']) and !empty($_POST['courier_id']))){
        $suppliers=$_POST['customer_id'];
        $order_date=$_POST['order_date'];
        $delivery_time=$_POST['delivery_time'];
        $delivery_cost=$_POST['delivery_cost'];
        $courier_id=$_POST['courier_id'];
       
        mysqli_query($conn, "INSERT INTO `Orders` (`order_id`, `customer_id`, `order_date`, `delivery_time`, `delivery_cost`, `courier_id`) VALUES (NULL, '$suppliers', '$order_date','$delivery_time', '$delivery_cost', '$courier_id')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>customer_id</p>
            <input class="form_for-text" type="text" name="customer_id"><br>
            <p>order_date</p>
            <input class="form_for-text" type="text" name="order_date"><br>
            <p>delivery_time</p>
            <input class="form_for-text" type="text" name="delivery_time"><br>
            <p>delivery_cost</p>
            <input class="form_for-text" type="text" name="delivery_cost"><br>
            <p>courier_id</p>
            <input class="form_for-text" type="text" name="courier_id"><br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Orders where order_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Orders" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>customer_id</p>
                            <input class='form_for-text' type='text' required name='customer_id' value='{$supplier['customer_id']}'/>
                            <p>order_date</p>
                            <input class='form_for-text' type='text' required name='order_date' value='{$supplier['order_date']}'/>
                            <p>delivery_time</p>
                            <input class='form_for-text' type='text' required name='delivery_time' value='{$supplier['delivery_time']}'/>
                            <p>delivery_cost</p>
                            <input class='form_for-text' type='text' required name='delivery_cost' value='{$supplier['delivery_cost']}'/>
                            <p>courier_id</p>
                            <input class='form_for-text' type='text' required name='courier_id' value='{$supplier['courier_id']}'/><br>
                        ";
                    }
                echo ' <br> <input class="save_main-submit" type="submit" name="update" value="Изменить"> </div>';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $suppliers=$_POST['customer_id'];
                    $order_date=$_POST['order_date'];
                    $delivery_time=$_POST['delivery_time'];
                    $delivery_cost=$_POST['delivery_cost'];
                    $courier_id=$_POST['courier_id'];
                    mysqli_query($conn, "UPDATE `Orders` SET `customer_id` = '$suppliers',`order_date` = '$order_date', `delivery_time` = '$delivery_time',`delivery_cost` = '$delivery_cost', `courier_id` = '$courier_id'  where order_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Orders WHERE order_id = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>