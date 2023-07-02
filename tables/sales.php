<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Скидки</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Дата</th>
                        <th>Продукты</th>
                        <th>Цена</th>
                        <th>Пользователь</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM sales";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM sales" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_sales'] . "</td>";
                            echo "<td>" .  $supplier['date_sales'] . "</td>";
                            echo "<td>" .  $supplier['id_products'] . "</td>";
                            echo "<td>" .  $supplier['price'] . "</td>";
                            echo "<td>" .  $supplier['id_user'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_sales']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_sales']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['date_sales'])) and !empty($_POST['id_products']) and !empty($_POST['price']) and !empty($_POST['id_user'])){
        $date_sales=$_POST['date_sales'];
        $id_products=$_POST['id_products'];
        $price=$_POST['price'];
        $id_user=$_POST['id_user'];
        mysqli_query($conn, "INSERT INTO `sales` (`id_sales`, `date_sales`, `id_products`, `price`, `id_user`) VALUES (NULL, '$date_sales', '$id_products', '$price', '$id_user')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Дата</p>
            <input class="form_for-text" type="date" name="date_sales">
            <p>Продукты</p>
            <input class="form_for-text" type="text" name="id_products">
            <p>Цена</p>
            <input class="form_for-text" type="text"  name="price"> 
            <p>Пользователь</p>
            <input class="form_for-text" type="text"  name="id_user">  <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM sales where id_sales={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM sales" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Дата</p>
                            <input class='form_for-text' type='date' required name='date_sales' value='{$supplier['date_sales']}'/>
                            <p>Продукты</p>
                            <input class='form_for-text' type='text' required name='id_products' value='{$supplier['id_products']}'/>
                            <p>Цена</p>
                            <input class='form_for-text' type='text' required name='price' value='{$supplier['price']}'/>
                            <p>Пользователь</p>
                            <input class='form_for-text' type='text' required name='id_user' value='{$supplier['id_user']}'/>
                          
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $date_sales=$_POST['date_sales'];
                    $id_products=$_POST['id_products'];
                    $price=$_POST['price'];
                    $id_user=$_POST['id_user'];
                    mysqli_query($conn, "UPDATE `sales` SET `date_sales` = '$date_sales', `id_products` = '$id_products', `price` =  '$price', `id_user` =  '$id_user' where id_sales = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM sales WHERE id_sales = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section> 

<?php
include 'footer.php';
?>