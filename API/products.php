<?php

require_once("../config/db.php");
require_once("response.php");

$sql = "SELECT * FROM products";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

response(true, "Products", $products);

?>