<?php

require_once("../config/db.php");
require_once("response.php");

$id = $_GET["id"] ?? 0;

$sql = "SELECT * FROM products WHERE id=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {

    response(false, "Product Not Found");

}

response(true, "Success", $product);

?>