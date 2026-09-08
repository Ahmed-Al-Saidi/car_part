<?php
session_start();
require "../config/db.php";

$items = [];
$total = 0;

if (isset($_SESSION['invoice_id'])) {
    $stmt = $pdo->prepare("
        SELECT p.id, p.name, p.price, p.image
        FROM invoice_products ip
        JOIN products p ON ip.product_id = p.id
        WHERE ip.invoice_id = ?
    ");
    $stmt->execute([$_SESSION['invoice_id']]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الفاتورة</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>الفاتورة</header>

<div class="container">
    <?php if (empty($items)): ?>
        <p>لا توجد منتجات في الفاتورة حالياً.</p>
    <?php else: ?>
        <table border="1" style="width:100%; border-collapse:collapse; text-align:center;">
            <thead>
                <tr>
                    <th>اسم المنتج</th>
                    <th>السعر</th>
                    <th>الصورة</th>
                    <th>إجراء</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i): 
                    $total += $i['price'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($i['name']) ?></td>
                        <td><?= htmlspecialchars($i['price']) ?> ريال</td>
                        <td><img src="../images/<?= htmlspecialchars($i['image']) ?>" alt="<?= htmlspecialchars($i['name']) ?>" width="50"></td>
                        <td><a href="story.php?remove=<?= $i['id'] ?>" style="background:#ef4444; color:#fff;">حذف</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br>
    <div class="total">
        الإجمالي: <?= $total ?> ريال
    </div>
    <br><br>
    <a href="story.php">رجوع للمتجر</a>
</div>

</body>
</html>