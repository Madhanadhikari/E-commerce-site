<?php
include 'db.php';
$sql = $Conn->query("SELECT * FROM product");
?>

<!doctype html>
<html lang="en">
<head>
    <title>Product Dashboard</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Product Dashboard</h2>
            <div>
                <a href="add.php" class="btn btn-success me-2">➕ Add Product</a>
                <a href="admin.php" class="btn btn-outline-primary">← Back to Home</a>
            </div>
        </div>

        <!-- Product Table -->
        <?php if ($sql->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price (₹)</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php while($row = $sql->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td class="text-center">
                            <img src="upload/<?= $row['image'] ?>" alt="product image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                        </td>
                        <td><?= $row['name'] ?></td>
                        <td><?=$row['category'] ?></td>
                        <td class="text-center"><?= $row['price'] ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td class="text-center">
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="alert alert-info text-center">No products found.</div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
