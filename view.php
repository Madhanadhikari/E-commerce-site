<?php
include 'db.php';

// Dispatch logic
if (isset($_GET['dispatch_id'])) {
    $dispatch_id = $_GET['dispatch_id'];

    // Get the order and product name
    $stmt = $Conn->prepare("SELECT o.*, p.name AS product_name FROM orders o JOIN product p ON o.product_id = p.id WHERE o.id = ?");
    $stmt->bind_param("i", $dispatch_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();

    if ($order) {
        // Insert into dispatch table
        $ins = $Conn->prepare("INSERT INTO dispatch (product_name, quantity, amount, customer_name, customer_address, order_date)
                               VALUES (?, ?, ?, ?, ?, ?)");
        $ins->bind_param(
            "sidsss",
            $order['product_name'],
            $order['quantity'],
            $order['amount'],
            $order['customer_name'],
            $order['customer_address'],
            $order['order_date']
        );
        $ins->execute();

        // Delete from orders table
        $del = $Conn->prepare("DELETE FROM orders WHERE id = ?");
        $del->bind_param("i", $dispatch_id);
        $del->execute();

        header("Location: view.php");
        exit();
    }
}

// Load all orders
$result = $Conn->query("SELECT o.id, p.name AS product_name, o.quantity, o.amount, o.customer_name, o.customer_address, o.order_date 
                        FROM orders o 
                        JOIN product p ON o.product_id = p.id  
                        ORDER BY o.order_date DESC");
?>

<!doctype html>
<html lang="en">
<head>
    <title>View Orders</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body style="background-color: #f8f9fa;">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>All Orders</h2>
        <a href="admin.php" class="btn btn-outline-primary">← Back to Home</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Amount (₹)</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center"><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td class="text-center"><?= $row['quantity'] ?></td>
                        <td class="text-center"><?= $row['amount'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['customer_address'] ?></td>
                        <td class="text-center"><?= $row['order_date'] ?></td>
                        <td class="text-center">
                            <a href="view.php?dispatch_id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Dispatch</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">No orders found.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
