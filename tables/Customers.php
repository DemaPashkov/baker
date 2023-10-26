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
            <div class="naz_tabl"><h2>Customers</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>customer_name</th>
                        <th>customer_age</th>
                        <th>customer_gender</th>
                        <th>customer_postal_code</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Customers";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Customers" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['customer_id'] . "</td>";
                            echo "<td>" .  $supplier['customer_name'] . "</td>";
                            echo "<td>" .  $supplier['customer_age'] . "</td>";
                            echo "<td>" .  $supplier['customer_gender'] . "</td>";
                            echo "<td>" .  $supplier['customer_postal_code'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['customer_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['customer_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['customer_name']) and !empty($_POST['customer_age']) and !empty($_POST['customer_gender']) and !empty($_POST['customer_postal_code']))){
        $suppliers=$_POST['customer_name'];
        $customer_age=$_POST['customer_age'];
        $customer_gender=$_POST['customer_gender'];
        $customer_postal_code=$_POST['customer_postal_code'];
       
        mysqli_query($conn, "INSERT INTO `Customers` (`customer_id`, `customer_name`, `customer_age`, `customer_gender`, `customer_postal_code`) VALUES (NULL, '$suppliers', '$customer_age','$customer_gender', '$customer_postal_code')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>customer_name</p>
            <input class="form_for-text" type="text" name="customer_name"><br>
            <p>customer_age</p>
            <input class="form_for-text" type="text" name="customer_age"><br>
            <p>customer_gender</p>
            <input class="form_for-text" type="text" name="customer_gender"><br>
            <p>customer_postal_code</p>
            <input class="form_for-text" type="text" name="customer_postal_code"><br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Customers where customer_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Customers" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>customer_name</p>
                            <input class='form_for-text' type='text' required name='customer_name' value='{$supplier['customer_name']}'/>
                            <p>customer_age</p>
                            <input class='form_for-text' type='text' required name='customer_age' value='{$supplier['customer_age']}'/>
                            <p>customer_gender</p>
                            <input class='form_for-text' type='text' required name='customer_gender' value='{$supplier['customer_gender']}'/>
                            <p>customer_postal_code</p>
                            <input class='form_for-text' type='text' required name='customer_postal_code' value='{$supplier['customer_postal_code']}'/><br>
                        ";
                    }
                echo ' <br> <input class="save_main-submit" type="submit" name="update" value="Изменить"> </div>';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $suppliers=$_POST['customer_name'];
                    $customer_age=$_POST['customer_age'];
                    $customer_gender=$_POST['customer_gender'];
                    $customer_postal_code=$_POST['customer_postal_code'];
                    mysqli_query($conn, "UPDATE `Customers` SET `customer_name` = '$suppliers',`customer_age` = '$customer_age', `customer_gender` = '$customer_gender',`customer_postal_code` = '$customer_postal_code'  where customer_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Customers WHERE customer_id = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>