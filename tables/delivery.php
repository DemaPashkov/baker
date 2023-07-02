<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Доставка</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Город</th>
                        <th>Индекс</th>
                        <th>Улица</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM delivery";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM delivery" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_delivery'] . "</td>";
                            echo "<td>" .  $supplier['locality'] . "</td>";
                            echo "<td>" .  $supplier['indeks'] . "</td>";
                            echo "<td>" .  $supplier['street'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_delivery']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_delivery']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['locality']) and !empty($_POST['indeks'])  and !empty($_POST['street']))){
        $locality=$_POST['locality'];
        $index=$_POST['indeks'];
        $street=$_POST['street'];
        mysqli_query($conn, "INSERT INTO `delivery` (`id_delivery`, `id_user`,`locality`, `indeks`, `street`, `house`, `apartment`) VALUES (null, 1, '$locality', '$index', '$street', 1, 1)");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
        var_dump($_POST['locality']);
        var_dump($_POST['indeks']);
        var_dump($_POST['street']);
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Город</p>
            <input class="form_for-text" type="text" name="locality">
            <p>Индекс</p>
            <input class="form_for-text" type="text" name="indeks">
            <p>Улица</p>
            <input class="form_for-text" type="text" name="street"> <br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM delivery where id_delivery={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM delivery" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Город</p>
                            <input class='form_for-text' type='text' required name='locality' value='{$supplier['locality']}'/>
                            <p>Индекс</p>
                            <input class='form_for-text' type='text' required name='indeks' value='{$supplier['indeks']}'/>
                            <p>Улица</p>
                            <input class='form_for-text' type='text' required name='street' value='{$supplier['street']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $locality=$_POST['locality'];
                    $index=$_POST['indeks'];
                    $street=$_POST['street'];
                    mysqli_query($conn, "UPDATE `delivery` SET `locality` = '$locality', `indeks` = '$index', `street` = '$street' where id_delivery = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM delivery WHERE id_delivery = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>