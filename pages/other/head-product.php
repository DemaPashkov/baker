
<section class="head-product">
    <div class="head-product-main">
        <div class="head-product-header">
            <h1>Продукты</h1>
        </div>
        <div class="head-product-content">

        <?php 
        error_reporting(0);
        require_once('php/bd.php');
        if (isset($_SESSION['login_user'])) {
        $user_check = $_SESSION['login_user'];
           $querys = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
           $rowsq = mysqli_fetch_array($querys);
           $id_user = $rowsq['id_user'];
        }
        

            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);
            $suppliers = mysqli_query($conn, "SELECT * FROM products" );
            for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
            foreach($data as $supplier) {
                $prosuctts = mysqli_query($conn,"SELECT * FROM employees where id_employees = '$supplier[id_employees]'");
                $rows2 = mysqli_fetch_assoc($prosuctts);
                $id_products = $supplier['id_products'];
                $name_products = $supplier['name_products'];
                $price = $supplier['price'];
                echo '<div class="head-product-content-block">
                <img src="img/products/'. $supplier['photo'] .'" alt="">
                <h3>'.  $supplier['name_products'] .'</h3>
                <p>'.  $supplier['price'] .' - руб</p>
                ';
                echo "<a href='?add_id={$supplier['id_products']}'>Добавить</a>
                </div>"; 
            }
            if (!empty($_GET['add_id'])){
                $supplier = mysqli_query($conn, "INSERT INTO `cart` (`id_cart`, `id_users`, `id_products`,`price`, `count`) VALUES (NULL,'$id_user', '$_GET[add_id]', '$price', '1')");        
            }   
            ?>
                        
               
        </div>
        
    </div>
</section>