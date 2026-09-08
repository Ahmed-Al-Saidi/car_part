<?php
require "../config/db.php";
session_start();

if(!isset($_SESSION['admin'])){
 header("location: login.php");
 exit;
}
if(isset($_POST['add'])){

 $name  = $_POST['name'];
 $price = $_POST['price'];

 // رفع الصورة
 $image_name = $_FILES['image']['name'];
 $tmp        = $_FILES['image']['tmp_name'];

 move_uploaded_file($tmp, "../images/".$image_name);

 // إدخال المنتج
 $stmt = $pdo->prepare(
   "INSERT INTO products (name, price, image)
    VALUES (?,?,?)"
 );
 $stmt->execute([$name,$price,$image_name]);

 echo "<div class='success'>تم إضافة المنتج بنجاح</div>";

}
?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>لوحة تحكم المدير - إضافة منتج</header>

<div class="container">
 <form method="post" enctype="multipart/form-data">

  <label>اسم المنتج</label><br>
  <input type="text" name="name" required><br><br>

  <label>السعر</label><br>
  <input type="number" name="price" required><br><br>

  <label>صورة المنتج</label><br>
  <input type="file" name="image" required><br><br>

  <button type="submit" name="add">إضافة المنتج</button>


 </form>
  <br>
 <a href="alter_product.php">الذهاب لتعديل المنتج</a>
 <br>
 <a href="../shop/story.php">الذهاب للمتجر</a>
  <br>
  <a href="logout.php">تسجيل خروج</a>
</div>

</body>
</html>
