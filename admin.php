<?php
include 'db.php';


// Total products
$count = $Conn->prepare("SELECT COUNT(*) FROM product");
$count->execute();
$count->bind_result($total);
$count->fetch();
$count->close();

// Total orders
$order = $Conn->prepare("SELECT COUNT(*) FROM orders");
$order->execute();
$order->bind_result($ordercount);
$order->fetch();
$order->close();

// Dispatched orders count
$dispatch = $Conn->prepare("SELECT COUNT(*) FROM dispatch");
$dispatch->execute();
$dispatch->bind_result($dispatchCount);
$dispatch->fetch();
$dispatch->close();

// Revenue from dispatch
$revenue = $Conn->prepare("SELECT SUM(amount) FROM dispatch");
$revenue->execute();
$revenue->bind_result($totalRevenue);
$revenue->fetch();
$revenue->close();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand ms-5" href="#">Welcome, <?= $_SESSION['name'] ?></a>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <form class="d-flex ms-auto me-5">
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                </form>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <div class="row g-4 justify-content-center">
            <!-- Product Count -->
            <div class="col-md-5 col-lg-3">
                <div class="card shadow">
                    <div class="card-body bg-primary text-white text-center rounded">
                        <h4>No. of Products</h4>
                        <h2><?= $total ?></h2>
                        <a href="add.php" class="btn btn-light btn-sm mt-2">Add</a>
                        <a href="dashboard.php" class="btn btn-warning btn-sm mt-2">View</a>
                    </div>
                </div>
            </div>

            <!-- Order Count -->
            <div class="col-md-5 col-lg-3">
                <div class="card shadow">
                    <div class="card-body bg-warning text-dark text-center rounded">
                        <h4>No. of Orders</h4>
                        <h2><?= $ordercount ?></h2>
                        <a href="view.php" class="btn btn-success btn-sm mt-2">View</a>
                    </div>
                </div>
            </div>

            <!-- Dispatched Orders -->
            <div class="col-md-5 col-lg-3">
                <div class="card shadow">
                    <div class="card-body bg-success text-white text-center rounded">
                        <h4>Dispatched</h4>
                        <h2><?= $dispatchCount ?></h2>
                        <a href="dispatch.php" class="btn btn-light btn-sm mt-2">View</a>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="col-md-5 col-lg-3">
                <div class="card shadow">
                    <div class="card-body bg-dark text-white text-center rounded">
                        <h4>Total Revenue</h4>
                        <h2>₹<?=$totalRevenue?></h2>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
