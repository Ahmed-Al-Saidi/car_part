<?php
require "../config/db.php";

if(isset($_POST['update'])) {

    $current_name = $_POST['current_name']; // اسم المنتج الحالي لتحديده
    $new_name     = $_POST['name'];         // الاسم الجديد (اختياري)
    $new_price    = $_POST['price'];        // السعر الجديد (اختياري)

    // جلب المنتج الحالي من قاعدة البيانات
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name = ?");
    $stmt->execute([$current_name]);
    $product = $stmt->fetch();

    if(!$product){
        echo "<p class='error'>المنتج غير موجود!</p>";
        exit;   
    }

    // تحديد القيم الجديدة أو الاحتفاظ بالقيم القديمة
    $final_name  = !empty($new_name) ? $new_name : $product['name'];
    $final_price = !empty($new_price) ? $new_price : $product['price'];

    // التحقق من رفع صورة جديدة
    if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != ""){
        $image_name = $_FILES['image']['name'];
        $tmp        = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../images/".$image_name);
    } else {
        $image_name = $product['image']; // الاحتفاظ بالصورة القديمة
    }

    // تحديث البيانات في قاعدة البيانات
    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, image = ? WHERE name = ?");
    $stmt->execute([$final_name, $final_price, $image_name, $current_name]);

    echo "<p class='success'>تم تعديل المنتج بنجاح</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>لوحة تحكم المدير - تعديل منتج</header>

<div class="container">
 <form method="post" enctype="multipart/form-data">

  <label>اسم المنتج الحالي</label><br>
  <input type="text" name="current_name" required><br><br>

  <label>الاسم الجديد (اختياري)</label><br>
  <input type="text" name="name"><br><br>

  <label>السعر الجديد (اختياري)</label><br>
  <input type="number" name="price"><br><br>

  <label>صورة جديدة (اختياري)</label><br>
  <input type="file" name="image"><br><br>

  <button type="submit" name="update">تعديل المنتج</button>

 </form>

 <br>
 <a href="../shop/story.php">الذهاب للمتجر</a>
</div>

</body>
</html>
