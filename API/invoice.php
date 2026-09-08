<?php

require_once("../config/db.php");
require_once("response.php");

$sql="SELECT * FROM invoices";

$stmt=$pdo->prepare($sql);

$stmt->execute();

$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

response(true,"Invoices",$data);

?>