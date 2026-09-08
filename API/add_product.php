<?php

require_once("../config/db.php");
require_once("response.php");

$name = $_POST["name"] ?? "";
$price = $_POST["price"] ?? "";
$image = $_POST["image"] ?? "";

if (empty($name) || empty($price)) {
    response(false, "Name and price are required");
}

$sql = "INSERT INTO products(name, price, image) VALUES(?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $name,
    $price,
    $image
]);

response(true, "Product Added");

?>