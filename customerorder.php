<?php
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$customer_name = $_SESSION['name'];

// Get pending orders
$sql = $Conn->prepare("SELECT o.id, p.name AS product_name, o.quantity, o.amount, o.order_date, o.customer_address 
                       FROM orders o 
                       JOIN product p ON o.product_id = p.id 
                       WHERE o.customer_name = ? 
                       ORDER BY o.order_date DESC");
$sql->bind_param("s", $customer_name);
$sql->execute();
$orders = $sql->get_result();

// Get dispatched orders
$dispatch = $Conn->prepare("SELECT * FROM dispatch WHERE customer_name = ? ORDER BY dispatch_date DESC");
$dispatch->bind_param("s", $customer_name);
$dispatch->execute();
$dispatched = $dispatch->get_result();
?>

<!doctype html>
<html lang="en">
<head>
    <title>My Orders</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background-color: #f0f2f5;">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Hello, <?= htmlspecialchars($customer_name) ?>! Your Orders</h3>
            <a href="home.php" class="btn btn-outline-primary">← Back to Home</a>
        </div>

        <!-- Pending Orders -->
        <h4 class="mb-3">Pending Orders</h4>
        <?php if ($orders->num_rows > 0): ?>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount (₹)</th>
                        <th>Address</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $orders->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td class="text-center"><?= $row['quantity'] ?></td>
                        <td class="text-center"><?= $row['amount'] ?></td>
                        <td><?= nl2br(htmlspecialchars($row['customer_address'])) ?></td>
                        <td class="text-center"><?= $row['order_date'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="alert alert-info text-center mb-5">No pending orders.</div>
        <?php endif; ?>

        <!-- Dispatched Orders -->
        <h4 class="mb-3">Dispatched Orders</h4>
        <?php if ($dispatched->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount (₹)</th>
                        <th>Address</th>
                        <th>Order Date</th>
                        <th>Dispatch Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $dispatched->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td class="text-center"><?= $row['quantity'] ?></td>
                        <td class="text-center"><?= $row['amount'] ?></td>
                        <td><?= nl2br(htmlspecialchars($row['customer_address'])) ?></td>
                        <td class="text-center"><?= $row['order_date'] ?></td>
                        <td class="text-center"><?= $row['dispatch_date'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="alert alert-secondary text-center">No dispatched orders yet.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
