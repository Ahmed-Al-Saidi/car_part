<?php

require_once("../config/db.php");
require_once("response.php");

$sql="SELECT id,name,email FROM users";

$stmt=$pdo->prepare($sql);

$stmt->execute();

$users=$stmt->fetchAll(PDO::FETCH_ASSOC);

response(true,"Users",$users);

?>