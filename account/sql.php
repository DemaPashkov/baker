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
<p>1. Получить список всех заказов за определенный период..</p>

<?php
require_once('../php/bd.php');
$sql = "SELECT *
FROM Orders
WHERE order_date BETWEEN '2021-01-01' AND '2021-01-31';";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table><tr><th>order_id</th><th>customer_id</th><th>order_date</th><th>	delivery_time</th><th>delivery_cost</th><th>courier_id</th></tr>";
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["delivery_cost"]. "</td><td>" . $row["courier_id"]. "</td></tr>";
}
echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}
?>

<p>2. Получить список всех заказов определенного клиента. (ID 2 клиента)</p>

<?php
$sql = "SELECT *
FROM Orders
WHERE customer_id = 2;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table><tr><th>order_id</th><th>customer_id</th><th>order_date</th><th>	delivery_time</th><th>delivery_cost</th><th>courier_id</th></tr>";
  while($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["delivery_cost"]. "</td><td>" . $row["courier_id"]. "</td></tr>";
  }
echo '</table>';
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
  }
?>


<p>3. Получить список всех заказов, которые были доставлены определенным курьером.</p>

<?php

$query = "SELECT o.*
FROM Orders o
JOIN Couriers c ON o.courier_id = c.courier_id
WHERE c.courier_name = 'Курьер 3';";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  echo "<table><tr><th>order_id</th><th>customer_id</th><th>order_date</th><th>	delivery_time</th><th>delivery_cost</th><th>courier_id</th></tr>";
  while($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["delivery_cost"]. "</td><td>" . $row["courier_id"]. "</td></tr>";
  }
    echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}

?>

<p>4. Получить список заказов, которые еще не были доставлены.</p>
<?php

$sql = "SELECT *
FROM Orders
WHERE order_id NOT IN (SELECT order_id FROM Addresses);";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<table><tr><th>order_id</th><th>customer_id</th><th>order_date</th><th>	delivery_time</th><th>delivery_cost</th><th>courier_id</th></tr>";
  while($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["delivery_cost"]. "</td><td>" . $row["courier_id"]. "</td></tr>";
  }
    echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}
?>

<p>5. Получить список всех заказов, у которых сумма доставки превышает заданное значение.</p>

<?php

$sql = "SELECT *
FROM Orders
WHERE delivery_cost > 10.00;";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<table><tr><th>order_id</th><th>customer_id</th><th>order_date</th><th>	delivery_time</th><th>delivery_cost</th><th>courier_id</th></tr>";
  while($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["delivery_cost"]. "</td><td>" . $row["courier_id"]. "</td></tr>";
  }
    echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}
?>


<p>6. Получить список всех клиентов с указанием наполнения заказа, даты и времени.</p>

<?php

$sql = "SELECT c.customer_name, p.product_name, o.order_date, o.delivery_time
FROM Customers c
JOIN Orders o ON c.customer_id = o.customer_id
JOIN Order_Items oi ON o.order_id = oi.order_id
JOIN Product p ON oi.product_id = p.product_id;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>customer_name</th><th>order_date</th><th>	delivery_time</th><th>product_name</th></tr>";
  while($row = $result->fetch_assoc()) {
  echo "<tr><td>" . $row["customer_name"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["product_name"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}

?>

<p>7. Получить список курьеров с наибольшим количеством отзывов и с наибольшей оценкой.</p>

<?php

$sql = "SELECT c.courier_name, COUNT(r.review_id) AS review_count, MAX(r.review_rating) AS max_rating
FROM Couriers c
JOIN Reviews r ON c.courier_id = r.courier_id
GROUP BY c.courier_name
ORDER BY review_count DESC, max_rating DESC;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>courier_name</th><th>review_count</th><th>max_rating</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["courier_name"]. "</td><td>" . $row["review_count"]. "</td><td>" . $row["max_rating"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}

?>


<p>8. Получить список всех товаров, которые были заказаны клиентами определенной возрастной группы и определенного пола. (25 лет - мужчина)</p>

<?php

$sql = "SELECT p.product_name
FROM Customers c
JOIN Orders o ON c.customer_id = o.customer_id
JOIN Order_Items oi ON o.order_id = oi.order_id
JOIN Product p ON oi.product_id = p.product_id
WHERE c.customer_age = 25 AND c.customer_gender = 'М';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>product_name</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["product_name"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}

?>


<p>9. Получить список всех заказов, сделанных клиентами с определенным почтовым индексом.</p>

<?php

    $sql = "SELECT *
    FROM Orders o
    JOIN Customers c ON o.customer_id = c.customer_id
    WHERE c.customer_postal_code = '123456';";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
      echo "<table><tr><th>order_id</th><th>customer_id</th><th>order_date</th><th>	delivery_time</th><th>delivery_cost</th><th>courier_id</th><th>customer_postal_code</th> </tr>";
      while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["order_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["order_date"]. "</td><td>" . $row["delivery_time"]. "</td><td>" . $row["delivery_cost"]. "</td><td>" . $row["courier_id"]. "</td><td>" . $row["customer_postal_code"]. "</td></tr>";
      }
      echo "</table>";
    } else {
      echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
    }

?>


<p>10. Получить список всех клиентов, у которых не было сделано ни одного заказа.</p>

<?php

$sql = "SELECT *
FROM Customers c
LEFT JOIN Orders o ON c.customer_id = o.customer_id
WHERE o.order_id IS NULL;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>Продукт</th><th>Дата отчёта</th><th>Доход</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["Продукт"] . "</td><td>" . $row["Дата отчёта"] . "</td><td>" . $row["Доход"] . "</td></tr>";
  }
  echo "</table>";
} else {
  echo "Пока нет результатов, пожалуйста заполните БД необходимыми данными для получения того результата, которого вы хотите";
}

?>
</div>
</section>
