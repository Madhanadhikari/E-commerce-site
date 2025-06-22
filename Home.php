<?php
include 'db.php';

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
}

$sql = $Conn->query("SELECT * FROM product Limit 6");

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Home</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            .card-img-top {
  height: 250px;
  object-fit: cover;
}
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             <nav
                class="navbar navbar-expand-sm navbar-dark bg-dark"
             >
                <a class="navbar-brand ms-5" href="#">Welcome, <?=$_SESSION['name']?></a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                ></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    
                   
                   <div class="dropdown open ms-auto me-5 bg-dark">
                    <a href="productpage.php" class="btn btn-outline-light me-3">Products</a>
                    <a
                        class="btn btn-dark btn-secondary dropdown-toggle"
                        type="button"
                        id="triggerId"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        Profile
                    </a>
                    <div class="dropdown-menu drop-down-menu-dark" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="customerorder.php">Orders</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                   </div>
                   
                </div>
             </nav>
             
        </header>
        <main class="container mt-4">
          <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
          
            <div class="carousel-inner" style="height:250px;" role="listbox">
              <div class="carousel-item active">
                <img
                  src="carousal/image.png"
                  class="w-100 d-block"
                  alt="First slide"
                />
            
              </div>
              <div class="carousel-item">
                <img
                  src="carousal/image2.png"
                  class="w-100 d-block"
                  alt="Second slide"
                />
                
              </div>
              <div class="carousel-item">
                <img
                  src="carousal/image3.png"
                  class="w-100 d-block"
                  alt="Third slide"
                />
              </div>
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselId"
              data-bs-slide="prev"
            >
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselId"
              data-bs-slide="next"
            >
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          
  <div class="d-flex justify-content-between align-items-center mb-3 px-4">
  <strong>Available Products</strong>
  <a href="productpage.php" class="btn btn-info">View All →</a>
</div>
  <div class="row g-4">
    <?php while($row = $sql->fetch_assoc()) { ?>
    <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <img src="upload/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $row['name'] ?></h5>
          <p class="card-text"><?= $row['category']?></p>
          <p class="card-text fw-bold">₹<?=$row['price'] ?></p>
          <div
            class="row justify-content-center align-items-center g-2"
          >
            <div class="col"><a href="order.php?id=<?= $row['id'] ?>" class="btn btn-primary w-100">Buy Now</a></div>
            <div class="col"><a href="productview.php?id=<?= $row['id'] ?>" class="btn btn-info w-100">View</a></div>
          </div>
          
          
          
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
