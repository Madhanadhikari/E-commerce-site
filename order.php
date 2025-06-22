<?php
include 'db.php';


if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit();
}

$customer_name = $_SESSION['name'];
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    die("Product ID missing in URL.");
}

// Fetch product details including price
$stmt = $Conn->prepare("SELECT name, price FROM product WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product_result = $stmt->get_result();
if ($product_result->num_rows === 0) {
    die("Product not found.");
}
$product = $product_result->fetch_assoc();
$product_name = $product['name'];
$product_price = $product['price'];

$calculated_amount = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = $_POST['address'] ?? '';
    $quantity = (int) ($_POST['quantity'] ?? 1);
    $amount = $quantity * $product_price;
    $calculated_amount = $amount;

    if (empty($address) || $quantity < 1) {
        echo '<div class="alert alert-danger text-center">Please fill all fields properly.</div>';
    } else {
        $insert = $Conn->prepare("INSERT INTO orders (product_id, quantity, customer_name, customer_address, amount) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("iissi", $product_id, $quantity, $customer_name, $address, $amount);
        $insert->execute();
        header("Location:home.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Place Order</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script>
        function updateAmount() {
            let price = <?= $product_price ?>;
            let qty = document.getElementById("quantity").value;
            let amt = document.getElementById("amount");
            amt.value = qty * price;
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center mb-4">Place Order for: <?= $product_name ?> (₹<?= $product_price ?>)</h3>
    <?= $msg ?? '' ?>
    <form method="post" class="mx-auto w-50 border p-4 rounded shadow-sm bg-light">
        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" class="form-control" value="<?=$customer_name?>" readonly>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Customer Address</label>
            <textarea class="form-control" name="address" id="address" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1" required oninput="updateAmount()">
        </div>
        <div class="mb-3">
            <label class="form-label">Total Amount (₹)</label>
            <input type="text" class="form-control" id="amount" value="<?= $calculated_amount ?? $product_price ?>" readonly>
        </div>
        <button type="submit" class="btn btn-success w-100">Place Order</button>
    </form>
</div>
</body>
</html>
