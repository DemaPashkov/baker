<?php

include 'header.php';
require_once('../php/bd.php');

if (isset($_SESSION['login_user'])) {

    $user_check = $_SESSION['login_user'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_check'");
    $rows = mysqli_fetch_array($query);
    $names = $rows['name'];
    $status = $rows['admin'];

} else {
    header('Location index.php');
}
?>
 <link rel='stylesheet' href='../css/style.css'> 

<section class="sql-zaprosi-section">

<div class="sql-zaprosi">
<h2>SQL - Запросы</h2>
<p>1. Получить список и общее число поставщиков, поставляющих указанный ингредиент, в объеме, не менее заданного за определенный период.</p>

<?php
require_once('../php/bd.php');
$sql = "SELECT suppliers.name_suppliers AS 'Поставщик', ingredients.name_ingredients AS 'Ингредиент', ingredients.quantity AS 'Количество'
FROM suppliers JOIN ingredients ON suppliers.id_suppliers=ingredients.id_suppliers
WHERE ingredients.name_ingredients='мука' AND ingredients.quantity>50;";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table><tr><th>Поставщик</th><th>Ингредиент</th><th>Количество</th></tr>";
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Поставщик"]. "</td><td>" . $row["Ингредиент"]. "</td><td>" . $row["Количество"]. "</td></tr>";
}
echo "</table>";
} else {
echo "0 результатов";
}
?>

<p>2. Получить список и общее число поставленных изделий на склад.</p>

<?php
$query = "SELECT products.name_products AS 'Продукт', warehouse.quantity AS 'Количество'
FROM products JOIN warehouse ON products.id_products=warehouse.id_products
UNION
SELECT 'Всего:', SUM(warehouse.quantity)
FROM products JOIN warehouse ON products.id_products=warehouse.id_products;";
$results = mysqli_query($conn, $query);
echo '<table>
<thead>
<tr>
<th>Продукт</th>
<th>Количество</th>
</tr>
</thead>
<tbody>';
if ($results) {
while ($row = mysqli_fetch_assoc($results)) {
echo "<tr><td>" . $row['Продукт'] . "</td><td>" . $row['Количество'] . "</td></tr>";
}
echo '</table>';
}
?>


<p>3. Получить сведения об ингредиентах: какими поставщиками поставляется, их расценки, время поставки.</p>

<?php

$query = "SELECT ingredients.name_ingredients AS 'Ингридиент', suppliers.name_suppliers AS 'Поставщик', ingredients.price AS 'Цена ингридиента', ingredients.date_supply AS 'Дата поставки' FROM ingredients JOIN suppliers ON ingredients.id_suppliers=suppliers.id_suppliers;";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table><tr><th>Ингридиент</th><th>Поставщик</th><th>Цена ингридиента</th><th>Дата поставки</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["Ингридиент"]."</td><td>".$row["Поставщик"]."</td><td>".$row["Цена ингридиента"]."</td><td>".$row["Дата поставки"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}

?>

<p>4. Получить список и общее число изделий, сделанных в определенный период времени, состоящих из определенных ингредиентов.</p>
<?php

$sql = "SELECT products.name_products AS 'Продукт', products.date_manufacture AS 'Дата изготовления', ingredients.name_ingredients AS 'Ингридиент'
FROM products
JOIN recipes ON products.id_products=recipes.id_products
JOIN ingredients ON recipes.id_ingredients=ingredients.id_ingredients
WHERE products.name_products='Торт ШАЛЕ'
AND ingredients.name_ingredients='молоко'";
echo "
<table>
    <tr>
        <th>Продукт</th>
        <th>Дата изготовления</th>
        <th>Ингридиент</th>
    </tr>";
echo "";
foreach ($conn->query($sql) as $row) {
  echo "<tr>";
  echo "<td>" . $row['Продукт'] . "</td>";
  echo "<td>" . $row['Дата изготовления'] . "</td>";
  echo "<td>" . $row['Ингридиент'] . "</td>";
  echo "</tr>";
}
echo "</table>";

?>

<p>5. Получить список, общее количество и стоимость изделий, выпеченных за конкретный день.</p>

<?php

$sql = "SELECT products.name_products AS 'Продукт', products.quantity AS 'Количество', products.date_manufacture AS 'Дата изготовления', products.price AS 'Цена'
FROM products
WHERE products.date_manufacture='2023-06-21'
UNION
SELECT 'Всего:', SUM(products.quantity), 'Общая сумма:', SUM(products.price*products.quantity)
FROM products
WHERE products.date_manufacture='2023-06-21';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Продукт</th><th>Количество</th><th>Дата изготовления</th><th>Цена</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["Продукт"]. "</td><td>" . $row["Количество"]. "</td><td>" . $row["Дата изготовления"]. "</td><td>" . $row["Цена"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
?>


<p>6. Получить список изделий, выпеченных определенным пекарем за последнюю неделю.</p>

<?php

$sql = "SELECT products.name_products AS 'Продукт', products.date_manufacture AS 'Дата изготовления', employees.surname AS 'Фамилия', employees.name AS 'Имя', employees.otchestvo AS 'Отчество' FROM products JOIN employees ON products.id_employees=employees.id_employees WHERE products.date_manufacture BETWEEN CURRENT_DATE - INTERVAL 1 WEEK AND CURRENT_DATE AND employees.surname='Васильева' AND employees.name='Елена'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Продукт</th><th>Дата изготовления</th><th>Фамилия</th><th>Имя</th><th>Отчество</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["Продукт"]."</td><td>".$row["Дата изготовления"]."</td><td>".$row["Фамилия"]."</td><td>".$row["Имя"]."</td><td>".$row["Отчество"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>

<p>7. Получить сведения о рецептах: какой ингредиент в каком количестве необходим для выпечки определенного изделия.</p>

<?php

$sql = "SELECT products.name_products AS 'Продукт', ingredients.name_ingredients AS 'Ингредиент', recipes.quantity AS 'Необходимое количество'
FROM ingredients
JOIN recipes ON ingredients.id_ingredients=recipes.id_ingredients
JOIN products ON products.id_products=recipes.id_products
where products.name_products='Шоколадные лапки';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Продукт</th><th>Ингредиент</th><th>Необходимое количество</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["Продукт"]. "</td><td>" . $row["Ингредиент"]. "</td><td>" . $row["Необходимое количество"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>


<p>8. Получить список покупателей, купивших определенную готовую продукцию, выпеченную в определенный период.</p>

<?php

$sql = "SELECT users.surname AS 'Фамилия', users.name AS 'Имя', users.otchestvo AS 'Отчество', products.name_products AS 'Продукт', products.date_manufacture AS 'Дата изготовления'
FROM orders
JOIN products ON products.id_products=orders.id_products
JOIN users ON users.id_user=orders.id_user
WHERE products.name_products='Торт МАЛИНОВЫЙ ШОКОЛАД'
AND products.date_manufacture BETWEEN '2023-06-20' AND '2023-06-23';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Продукт</th><th>Дата изготовления</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["Фамилия"]."</td><td>".$row["Имя"]."</td><td>".$row["Отчество"]."</td><td>".$row["Продукт"]."</td><td>".$row["Дата изготовления"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>


<p>9. Получить среднее число продаж на месяц по любому виду готовой продукции.</p>

<?php

    $sql = "SELECT products.name_products AS 'Продукт', COUNT(*)/(  
    SELECT COUNT(*)
    FROM sales
    WHERE sales.date_sales BETWEEN CURRENT_DATE - INTERVAL 1 MONTH AND CURRENT_DATE) AS 'Среднее число продаж за месяц'
    FROM sales JOIN products ON products.id_products=sales.id_products
    WHERE sales.id_products=1
    AND sales.date_sales BETWEEN CURRENT_DATE - INTERVAL 1 MONTH AND CURRENT_DATE;";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      echo "<table><tr><th>Продукт</th><th>Среднее число продаж за месяц</th></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Продукт"]."</td><td>".$row["Среднее число продаж за месяц"]."</td></tr>";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }

?>


<p>10. Получить кассовый отчет за определенный период.</p>

<?php

$sql = "SELECT products.name_products AS 'Продукт', reports.date_reporting AS 'Дата отчёта', reports.revenue AS 'Доход' FROM reports JOIN products ON reports.id_products=products.id_products WHERE reports.date_reporting='2023-06-01'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Продукт</th><th>Дата отчёта</th><th>Доход</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["Продукт"] . "</td><td>" . $row["Дата отчёта"] . "</td><td>" . $row["Доход"] . "</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}

?>
</div>

</section>
<?php
include 'footer.php';
?>
