<?php
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid product ID.";
    exit();
}

$product_id = intval($_GET['id']);

$stmt = $Conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found.";
    exit();
}

$product = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Product Details</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .product-image {
            height: 350px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand ms-5" href="#">Welcome, <?= $_SESSION['name'] ?></a>
    <div class="ms-auto me-4">
        <a href="home.php" class="btn btn-outline-light me-2">Home</a>
        <a href="productpage.php" class="btn btn-outline-light">Products</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow">
        <div class="row g-0">
            <div class="col-md-6">
                <img src="upload/<?= $product['image'] ?>" class="product-image" alt="<?=$product['name'] ?>">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h3 class="card-title"><?= $product['name'] ?></h3>
                    <p class="text-muted">Category: <?= $product['category'] ?></p>
                    <h4 class="text-success">₹<?= $product['price'] ?></h4>
                    
                    <a href="order.php?id=<?= $product['id'] ?>" class="btn btn-primary">Buy Now</a>
                    <a href="productpage.php" class="btn btn-secondary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
