<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("location: ../auth/login.php");
    exit;
}

$shopId = $_SESSION['shop_id'] ?? 1;

if (!isset($_SESSION['invoice_id'])) {
    $stmt = $pdo->prepare("INSERT INTO invoices (shop_id) VALUES (?)");
    $stmt->execute([$shopId]);
    $_SESSION['invoice_id'] = $pdo->lastInsertId();
}

$addId = $_GET['add'] ?? $_POST['add'] ?? null;
if ($addId) {
    $stmt = $pdo->prepare("INSERT INTO invoice_products (invoice_id, product_id) VALUES (?, ?)");
    $stmt->execute([$_SESSION['invoice_id'], $addId]);
    header("Location: story.php");
    exit;
}

$removeId = $_GET['remove'] ?? $_POST['remove'] ?? null;
if ($removeId) {
    $stmt = $pdo->prepare("DELETE FROM invoice_products WHERE invoice_id = ? AND product_id = ? LIMIT 1");
    $stmt->execute([$_SESSION['invoice_id'], $removeId]);
    header("Location: story.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قطع غيار السيارات</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    قطع غيار السيارات
    <br>
    <p style="font-size:16px; margin-top:5px;">مرحبًا <?= htmlspecialchars($_SESSION['user_name'] ?? '') ?></p>
</header>

<div class="container">
    <div class="cards">
        <?php foreach ($products as $p): ?>
            <div class="card">
                <img src="../images/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                <h3><?= htmlspecialchars($p['name']) ?></h3>
                <p><?= htmlspecialchars($p['price']) ?> ريال</p>
                <a href="?add=<?= $p['id'] ?>">إضافة للسلة</a>
            </div>
        <?php endforeach; ?>
    </div>
    <br><br>
    <a href="invoice.php">عرض الفاتورة</a>
    <br>
    <a href="../auth/logout.php">تسجيل خروج</a>
</div>

</body>
</html>
