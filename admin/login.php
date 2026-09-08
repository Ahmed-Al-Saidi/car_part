<?php
session_start();
require "../config/db.php";

$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if (empty($email) || empty($pass)) {
        $error = "يرجى ملء جميع الحقول";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($pass, $admin['password'])) {
            $_SESSION['admin'] = true;
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['user_name'] = $admin['name'];
            header("Location: add_product.php");
            exit;
        } else {
            $error = "بيانات الدخول غير صحيحة أو لا تملك صلاحيات مدير";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول المدير</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>تسجيل دخول المدير</header>

<div class="container">
    <form method="post">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required><br><br>
        <input type="password" name="password" placeholder="كلمة المرور" required><br><br>
        <button type="submit" name="login">دخول</button>
    </form>

    <?php if (!empty($error)): ?>
        <p style="color:red; margin-top:15px;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <br>
    <a href="../index.php">الصفحة الرئيسية</a>
</div>

</body>
</html>