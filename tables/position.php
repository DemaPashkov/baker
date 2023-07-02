<?php
include 'header.php';
?>
<section class="admins">
 
    <?php
        $conn = mysqli_connect("localhost", "root", "root", "baker");
    ?>
    <div class="blocksss">
        <div>
            <div class="naz_tabl"><h2>Должность</h2></div>
            <div>
                <table>
                    <tr class="naim_atribytov">
                        <th>№</th>
                        <th>Должность</th>
                    </tr>

                    <?php 
                        $query = "SELECT * FROM position";
                        $result = mysqli_query($conn, $query);
                        $suppliers = mysqli_query($conn, "SELECT * FROM position" );
                        for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                        foreach($data as $supplier) {
                            echo "<tr class='read_tabl'>";
                            echo "<td>" .  $supplier['id_position'] . "</td>";
                            echo "<td>" .  $supplier['name_position'] . "</td>";
                            echo "<td><a href='?red_id={$supplier['id_position']}'>Изменить</a></td>";
                            echo "<td><a href='?del_id={$supplier['id_position']}'>Удалить</a></td>";
                            echo'</tr>';
                        }
                        ?>
                </table>
            </div>
            <div class='flexs'> 
            <?php

if (!empty($_POST['submit'])){
    if ((!empty($_POST['name_position']))){
        $name_position=$_POST['name_position'];
        mysqli_query($conn, "INSERT INTO `position` (`id_position`, `name_position`) VALUES (NULL, '$name_position')");
        header("Refresh:0");
    }else {
        echo "заполните все поля";
    }
}
?>
    <div class="dobaxit_danne">
        <h2>Добавить данные</h2>
        <form action="#" method="post">
            <p>Должность</p>
            <input class="form_for-text" type="text" name="name_position"><br><br>
            <input class="save_main-submit" type="submit" name="submit" value="Добавить">
        </form>
    </div>
            <?php
            if(!empty($_GET['red_id'])){
                $query = "SELECT * FROM position where id_position={$_GET['red_id']}";
                $result = mysqli_query($conn, $query);
                $suppliers = mysqli_query($conn, "SELECT * FROM position" );
                for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
                echo "<form method='POST'>";
                    foreach($data as $supplier) {
                        echo"
                        <div class='dobaxit_danne'> 
                            <h2>Изменить данные</h2>
                            <p>Должность</p>
                            <input class='form_for-text' type='text' required name='name_position' value='{$supplier['name_position']}'/>
                        </div> <br>";
                    }
                echo '<input class="save_main-submit" type="submit" name="update" value="Изменить">';
                echo'</form>';
                
                if (!empty($_POST['update'])){
                    $name_position=$_POST['name_position'];
                   
                    mysqli_query($conn, "UPDATE `position` SET `name_position` = '$name_position' where id_position = {$_GET['red_id']}");
                    header("Refresh:0");
                }
            }
            ?>
            <?php
                if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM position WHERE id_position = {$_GET['del_id']}");        
                }   
            ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>