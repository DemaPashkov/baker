
<section class="head-product">
    <div class="head-product-main">
        <div class="head-product-header">
            <h1>Продукты</h1>
        </div>
        <div class="head-product-content">

        <?php 
        // error_reporting(0);
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
                $prosucts = mysqli_query($conn,"SELECT * FROM category where id_category = '$supplier[id_category]'");
                $category = mysqli_fetch_assoc($prosucts);
                $Image_products = mysqli_query($conn,"SELECT * FROM Image_product where id_product = '$supplier[id_products]'");
                $Image_product = mysqli_fetch_assoc($Image_products);
                $images = mysqli_query($conn,"SELECT * FROM images where id_images = '$Image_product[id_images]'");
                $image = mysqli_fetch_assoc($images);
                $id_products = $supplier['id_products'];
                $name_products = $supplier['name_products'];
                $price = $supplier['price'];
                echo "<a href='tovar.php?tovar_id={$supplier['id_products']}'>";
                echo '<div class="head-product-content-block">
                <img src="img/products/'. $image['name_image'] .'" alt="">
                <h3>'.  $supplier['name_products'] .'</h3>
                <p>'.  $supplier['price'] .' - руб</p>
                </div></a>';
               
            }
           
            ?>
                        
               
        </div>
        
    </div>
</section>