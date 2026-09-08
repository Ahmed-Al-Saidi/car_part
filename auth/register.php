<?php
require "../config/db.php";

if(isset($_POST['register'])){

 $name  = $_POST['name'];
 $email = $_POST['email'];
 $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

 $stmt = $pdo->prepare(
   "INSERT INTO users (name,email,password,role)
    VALUES (?,?,?,'user')"
 );
 $stmt->execute([$name,$email,$pass]);

 header("location: login.php");
}
?>

<link rel="stylesheet" href="../css/style.css">

<header>إنشاء حساب</header>

<div class="container">
 <form method="post">
  <input type="text" name="name" placeholder="الاسم" ><br><br>
  <input type="email" name="email" placeholder="البريد" ><br><br>
  <input type="password" name="password" placeholder="كلمة المرور" ><br><br>
  <button name="register">إنشاء حساب</button>
 </form>
  <a href="../index.php">الصفحة الرئيسية</a>
</div>