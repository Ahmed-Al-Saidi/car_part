<?php
session_start();
require "../config/db.php";

if(isset($_POST['login'])){

 $email = $_POST['email'];
 $pass  = $_POST['password'];

 $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
 $stmt->execute([$email]);
 $user = $stmt->fetch();

 if($user && password_verify($pass, $user['password'])){
   $_SESSION['user_id']   = $user['id'];
   $_SESSION['user_name'] = $user['name'];
   $_SESSION['role']      = $user['role'];
   $_SESSION['shop_id']   = 1;

   header("location: ../shop/story.php");
   exit;
 }else{
   $error = "بيانات الدخول غير صحيحة";
 }
}
?>

<link rel="stylesheet" href="../css/style.css">

<header>تسجيل الدخول</header>

<div class="container">
 <form method="post">
  <input type="email" name="email" placeholder="البريد" required><br><br>
  <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
  <button name="login">دخول</button>
 </form>

 <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <br>
    <a href="../auth/register.php">التسجيل</a>
    <br>
    <a href="../index.php">الصفحة الرئيسية</a>
</div>