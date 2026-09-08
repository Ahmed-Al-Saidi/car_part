<?php

require_once("../config/db.php");
require_once("response.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    response(false, "Only POST Method Allowed");
}

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($email) || empty($password)) {
    response(false, "Please provide email and password");
}

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user["password"])) {
    response(false, "Invalid email or password");
}

unset($user["password"]);
response(true, "Login Successful", $user);

?>
