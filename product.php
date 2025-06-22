<?php
include 'db.php';

$sql=$Conn->query("select * from product");


?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="d-flex justify-content-center align-items-center mt-3">
                <h1>Products</h1>
            </div>
<div class="ms-4 w-50 mt-5">
<a href="add.php" class="btn btn-outline-success">Add products</a>
<a href="home.php" class="btn btn-warning">Home</a>

</div>
              <div class="d-flex justify-content-center align-items-center mt-3">
                <div
                    class="table-responsive w-75"
                >
                    <table
                        class="table table-primary"
                    >
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row=$sql->fetch_assoc()){ ?>
                            <tr class="">
                                <td scope="row"> <?= $row['id'] ?> </td>
                                <td> <?= $row['name'] ?></td>
                                <td> <?= $row['category'] ?></td>
                                <td> <?= $row['price'] ?></td>
                                <td> <a href="edit.php?id=<?=$row['id']?>">Edit</a></td>
                                <td> <a href="delete.php?id=<?=$row['id']?>">delete</a></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                </div>
                
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
