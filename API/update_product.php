<?php

require_once("../config/db.php");
require_once("response.php");

$id    = $_POST["id"] ?? "";
$name  = $_POST["name"] ?? "";
$price = $_POST["price"] ?? "";
$image = $_POST["image"] ?? "";

if (empty($id)) {
    response(false, "Product ID Required");
}

$sql = "UPDATE products SET name = ?, price = ?, image = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $name,
    $price,
    $image,
    $id
]);

response(true, "Product Updated");

?>