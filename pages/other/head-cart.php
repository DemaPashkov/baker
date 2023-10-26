
<section class="head-product">
    <div class="head-product-main">
        <div class="head-product-header">
            <h1>Корзина</h1>
        </div>
        <div class="head-product-content">
        <?php 
        if (isset($_SESSION['login_user'])) {
            require_once('php/bd.php');
          
           $user_check = $_SESSION['login_user'];
           $querys = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
           $rowsq = mysqli_fetch_array($querys);
           $id_user = $rowsq['id_user'];

            $query = "SELECT * FROM cart where id_users = '$id_user'";
            $result = mysqli_query($conn, $query);
            $suppliers = mysqli_query($conn, "SELECT * FROM cart where id_users = '$id_user'");
            
            for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
            foreach($data as $supplier) {
                $prosuctts = mysqli_query($conn,"SELECT * FROM products where id_products = '$supplier[id_products]'");
                $rows2 = mysqli_fetch_assoc($prosuctts);
                $nums = mysqli_num_rows($suppliers);
                $Image_products = mysqli_query($conn,"SELECT * FROM Image_product where id_product = '$supplier[id_products]'");
                $Image_product = mysqli_fetch_assoc($Image_products);
                $images = mysqli_query($conn,"SELECT * FROM images where id_images = '$Image_product[id_images]'");
                $image = mysqli_fetch_assoc($images);
              
                echo '<div class="head-product-content-block">
                      <img src="img/products/'. $image['name_image'] .'" alt="">
                        <h3>'.  $rows2['name_products'] .'</h3>
                        <p>'.  $supplier['price'] .' - руб</p>';
                echo "<a href='?del_id={$supplier['id_cart']}'>Удалить</a></div>"; 
                }
            if (!empty($_GET['del_id'])){
                $supplier = mysqli_query($conn, "DELETE FROM cart WHERE id_cart= {$_GET['del_id']}");        
                }   
        } else{
            echo '<p class="error">Сначала требуется авторизоваться</p>';
        }
               ?>
                <?php
               
                     if (isset($_SESSION['login_user'])) {
                        $sqlf = mysqli_query($conn, "SELECT SUM(count) as total_quantity
                        FROM cart where id_users = '$id_user'
                        GROUP BY id_products;");
                         $rowsd2 = mysqli_fetch_assoc($sqlf);
                        $nums = mysqli_num_rows($sqlf);
                       echo'<div class="counts">   
                       <p>Количество:  <span>'.$nums.'</span></p>
                       ';
                       $sqlf = mysqli_query($conn, "SELECT SUM(products.price * cart.count) as total_cost
                       FROM products
                       JOIN cart ON products.id_products = cart.id_products where id_users = '$id_user';");
                        $rowsd2 = mysqli_fetch_assoc($sqlf);
                   
                        echo'<p>Общая стоимость: <span>'.$rowsd2['total_cost'].'</span> </p>
                            <p>Доставка:   <span>0 рублей</span></p>
                            <p>Итого: <span>'.$rowsd2['total_cost'].' рублей</span></p>
                            <button>Оформить заказ</button>
                        </div>
                        ';
                     
                    }
                        ?>
    
        </div>
        
    </div>
</section>