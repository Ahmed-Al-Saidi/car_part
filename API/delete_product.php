<?php

require_once("../config/db.php");
require_once("response.php");

$id=$_POST["id"] ?? "";

if(empty($id)){

    response(false,"Product ID Required");

}

$sql="DELETE FROM products WHERE id=?";

$stmt=$pdo->prepare($sql);

$stmt->execute([$id]);

response(true,"Product Deleted");

?>