
<?php
    $tovar_id =  $_GET['tovar_id'];  
    $query = "SELECT * FROM products where id_products = '$tovar_id'";
    $result = mysqli_query($conn, $query);
    $suppliers = mysqli_query($conn, "SELECT * FROM products where id_products = '$tovar_id'" );
    for($data = []; $row = mysqli_fetch_assoc($result); $data [] = $row);
    foreach($data as $supplier) {
        $prosuctts = mysqli_query($conn,"SELECT * FROM employees where id_employees = '$supplier[id_employees]'");
        $employees = mysqli_fetch_assoc($prosuctts);
        $prosucts = mysqli_query($conn,"SELECT * FROM category where id_category = '$supplier[id_category]'");
        $category = mysqli_fetch_assoc($prosucts);
        $Image_products = mysqli_query($conn,"SELECT * FROM Image_product where id_product = '$tovar_id'");
        $Image_product = mysqli_fetch_assoc($Image_products);
        $images = mysqli_query($conn,"SELECT * FROM images where id_images = '$Image_product[id_images]'");
        $id_products = $supplier['id_products'];
        $name_products = $supplier['name_products'];
        $description = $supplier['description'];
        $price = $supplier['price'];
        $date_manufacture = $supplier['date_manufacture'];
               
    }
   
?>

<section class="head-product">
    <div class="head-product-main">
        <div class="head-product-header">
            <h1><?=$supplier['name_products']?></h1>
        </div>
        <div class="head-product-content">
            <div class="head-product-content-walp">
                <div class="head-product-content-walp-left">
                <?php
               
                while($image = mysqli_fetch_assoc($images)){
                    echo "<img src='img/products/$image[name_image]'> <br>";
                }
                
                $countPhoto = mysqli_query($conn, "SELECT * FROM `Image_product` WHERE `id_product` = '$tovar_id'");
                $count = mysqli_fetch_array($countPhoto);
                // var_dump($count[0]);
                if($count[0] >= 1){
                    // $more = "<br>Посмотреть все фотки"; 
                    // $more = "посмотреть все фотки";
                    $images2 = mysqli_query($conn,"SELECT * FROM images where id_images = '$Image_product[id_images]'");
                    $image2 = mysqli_fetch_assoc($images2);
                    while($image2 = mysqli_fetch_object($images2)){
                    echo "
                    <div class='more-photos'>
                        <img src='img/products/$image2[name_image]' alt='test'>
                    </div>";
                    }
                } else{
               echo "Больше нет фоток";
               }
                ?>
                </div>
                <div class="head-product-content-walp-right">
                    <h2><?=$name_products?></h2>
                    <p> <?=$description?></p>
                    <p>ближайшие даты: <span><?=$date_manufacture?> </span></p>
                    <p > Цена: <span class="price"><?=$price?> рублей</span> за 10 километров или 1 кг</p>
                </div>
            </div>
        </div>
    </div>
</section>