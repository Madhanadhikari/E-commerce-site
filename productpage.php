<?php
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
    exit();
}

// Fetch unique categories
$categories_result = $Conn->query("SELECT DISTINCT category FROM product");

// Get selected category from dropdown (if any)
$selected_category = $_GET['category'] ?? 'All';

if ($selected_category !== 'All') {
    $stmt = $Conn->prepare("SELECT * FROM product WHERE category = ?");
    $stmt->bind_param("s", $selected_category);
    $stmt->execute();
    $sql = $stmt->get_result();
} else {
    $sql = $Conn->query("SELECT * FROM product");
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Product Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand ms-5" href="#">Welcome, <?= $_SESSION['name'] ?></a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <div class="dropdown open ms-auto me-5 bg-dark">
                <a href="Home.php" class="btn btn-outline-light me-3">Home</a>
                <a class="btn btn-dark btn-secondary dropdown-toggle" type="button" id="triggerId"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="customerorder.php">Orders</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Available Products</h3>
        <form method="get" class="d-flex">
            <label class="me-2 fw-bold">Filter:</label>
            <select class="form-select" name="category" onchange="this.form.submit()">
                <option value="All" <?= $selected_category === 'All' ? 'selected' : '' ?>>All</option>
                <?php while ($cat = $categories_result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($cat['category']) ?>" <?= $selected_category === $cat['category'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

    <div class="row g-4">
        <?php if ($sql->num_rows > 0): ?>
            <?php while ($row = $sql->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="upload/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text"><?= $row['category'] ?></p>
                            <p class="card-text fw-bold">₹<?= $row['price'] ?></p>
                            <div class="row g-2">
                                <div class="col">
                                    <a href="order.php?id=<?= $row['id'] ?>" class="btn btn-primary w-100">Buy Now</a>
                                </div>
                                <div class="col">
                                    <a href="productview.php?id=<?= $row['id'] ?>" class="btn btn-info w-100">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php else: ?>
            <div class="alert alert-info text-center">No products found for selected category.</div>
        <?php endif; ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
