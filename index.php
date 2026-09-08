<?php 
require_once "API/python_API.php";
$data = call_python_api("/");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>متجر قطع غيار السيارات</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>🛠️ متجر قطع غيار السيارات</header>

<div class="container">
  <a href="auth/register.php">إنشاء حساب</a>
  <br>
  <a href="auth/login.php">تسجيل دخول</a>
  <br>
  <a href="admin/login.php">تسجيل دخول المدير</a>
</div>

</body>
</html>
