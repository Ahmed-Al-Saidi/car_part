<?php


require_once("python_API.php");
require_once("response.php");


$category = $_GET["category"] ?? $_POST["category"] ?? null;

$params = [];
if ($category) {
    $params["category"] = $category;
}


$result = call_python_api("/python/ai", $_SERVER["REQUEST_METHOD"] ?? "GET", $params);


response(
    true,
    "Python AI Recommendation Result",
    $result
);


?>