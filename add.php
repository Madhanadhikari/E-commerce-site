<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD']==="POST") {
    $pname=$_POST['pname'];
    $pcat=$_POST['pcat'];
    $price=$_POST['pprice'];
    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"upload/$img");

    $sql=$Conn->prepare("insert into product(name,category,price,image) values(?,?,?,?)");
    $sql->bind_param('ssis',$pname,$pcat,$price,$img);
    $sql->execute();
    header("Location:dashboard.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Add Product</title>
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
    </head>

    <body style="background-image:url('https://img.freepik.com/premium-vector/online-shopping-digital-technology-with-icon-blue-background-ecommerce-online-store-marketing_252172-219.jpg');  background-repeat:no-repeat; background-size: cover;">
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="text-center mt-5">
      <h2> Insert Product</h2>
            </div>
<div class="d-flex justify-content-center align-items-center mt-3">
            <form action="" method="post" class="w-50 " enctype="multipart/form-data"   >
                <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pname"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Name</label>
                </div>
                 <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pcat"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Category</label>
                </div>
                 <div class="form-floating mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="pprice"
                        id="formId1"
                        placeholder=""
                    />
                    <label for="formId1">Price</label>
                </div>
                <div class="mb-3">
        <label for="pimg" class="form-label">Product Image</label>
        <input class="form-control" type="file" name="image" id="image" accept="image/*" required>
    </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button
                            type="submit"
                            class="btn btn-warning w-25"
                        >
                            Add product
                        </button>
                        
                </div>
            </form>
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
