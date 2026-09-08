<?php

require_once("../config/db.php");
require_once("response.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    response(false, "Only POST Method");
}

$name = $_POST["name"] ?? "";
$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if (empty($name) || empty($email) || empty($password)) {
    response(false, "Please fill all fields");
}

$sql = "SELECT * FROM users WHERE email=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    response(false, "Email already exists");
}

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users(name,email,password) VALUES(?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $name,
    $email,
    $password
]);

response(true, "Account Created Successfully");

?>
