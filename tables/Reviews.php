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
            <div class="naz_tabl"><h2>Reviews</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>courier_id</th>
                        <th>review_rating</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM Reviews";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM Reviews" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['review_id'] . "</td>";
                            echo "<td>" .  $supplier['courier_id'] . "</td>";
                            echo "<td>" .  $supplier['review_rating'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['review_id']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['review_id']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['courier_id']) and !empty($_POST['review_rating']))){
        $suppliers=$_POST['courier_id'];
        $review_rating=$_POST['review_rating'];
       
        mysqli_query($conn, "INSERT INTO `Reviews` (`review_id`, `courier_id`, `review_rating`) VALUES (NULL, '$suppliers', '$review_rating')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>courier_id</p>
            <input class="form_for-text" type="text" name="courier_id"><br>
            <p>review_rating</p>
            <input class="form_for-text" type="text" name="review_rating"><br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM Reviews where review_id={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM Reviews" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>courier_id</p>
                            <input class='form_for-text' type='text' required name='courier_id' value='{$supplier['courier_id']}'/>
                            <p>review_rating</p>
                            <input class='form_for-text' type='text' required name='review_rating' value='{$supplier['review_rating']}'/><br>
                        ";
                    }
                echo ' <br> <input class="save_main-submit" type="submit" name="update" value="Изменить"> </div>';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $suppliers=$_POST['courier_id'];
                    $review_rating=$_POST['review_rating'];
                    mysqli_query($conn, "UPDATE `Reviews` SET `courier_id` = '$suppliers',`review_rating` = '$review_rating'  where review_id = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM Reviews WHERE review_id = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>