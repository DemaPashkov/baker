<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Категория</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Категория</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM category";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM category" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_category'] . "</td>";
                            echo "<td>" .  $supplier['name_category'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_category']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_category']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name_category']))){
        $suppliers=$_POST['name_category'];
       
        mysqli_query($conn, "INSERT INTO `category` (`id_category`, `name_category`) VALUES (NULL, '$suppliers')");
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
            <input class="form_for-text" type="text" name="name_category"><br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM category where id_category={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM category" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Наименование</p>
                            <input class='form_for-text' type='text' required name='name_category' value='{$supplier['name_category']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $suppliers=$_POST['name_category'];
                  
                    $query = "UPDATE `category` SET `name_category` = '$suppliers' where id_category = {$_GET['red_id']}";
                    mysqli_query($conn, "UPDATE `category` SET `name_category` = '$suppliers' where id_category = {$_GET['red_id']}");
                    var_dump($query);
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM category WHERE id_category = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
?>