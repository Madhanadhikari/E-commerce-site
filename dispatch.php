<?php
include 'db.php';

if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

// Fetch all dispatched records directly from dispatch table
$sql = $Conn->query("SELECT * FROM dispatch ORDER BY dispatch_date DESC");
?>

<!doctype html>
<html lang="en">
<head>
    <title>Dispatched Orders</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dispatched Orders</h2>
            <a href="admin.php" class="btn btn-outline-primary">← Back to Admin</a>
        </div>

        <?php if ($sql->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount (₹)</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Order Date</th>
                        <th>Dispatch Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $sql->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= $row['product_name']?></td>
                        <td class="text-center"><?= $row['quantity'] ?></td>
                        <td class="text-center"><?= $row['amount'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['customer_address'] ?></td>
                        <td class="text-center"><?= $row['order_date'] ?></td>
                        <td class="text-center"><?= $row['dispatch_date'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="alert alert-info text-center">No dispatched records found.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
