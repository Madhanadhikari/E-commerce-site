<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD']==="POST") {
   
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
   
    
     if (empty($uname)||empty($pass)) {
        echo '<div class="alert alert-danger">All fields are required.</div>';
    }elseif($uname && $uname === 'Admin'){
        $_SESSION['id']=$id;
                $_SESSION['name']=$uname;
        header("Location:admin.php");
    }else{
        $sql=$Conn->prepare("select id,password from pro where uname=?");
        $sql->bind_param('s',$uname);
        $sql->execute();
        $sql->bind_result($id,$password);
        if ($sql->fetch()) {
            if (password_verify($pass,$password)) {
                $_SESSION['id']=$id;
                $_SESSION['name']=$uname;
                header("Location:Home.php");
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
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
            <div
                class="row justify-content-center align-items-center g-2 col bg-primary" style="height:98vh"
            >
              
                 
                <div class="col d-flex justify-content-center align-items-center g-3 bg-white border rounded ms-4 mt-3">

<form action="" method="post" class="w-50">
    <h2 class="text-center mt-3 text-success ">Login</h2>
   
         <div class="form-floating mb-3 mt-3">
        <input
            type="text"
            class="form-control"
            name="uname"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Username</label>
        </div>
        
         <div class="form-floating mb-3 mt-3">
        <input
            type="text"
            class="form-control"
            name="pass"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Password</label>
        </div>
         
        <div class="d-flex justify-content-center align-items-center mb-3">
            <button 
                type="submit"
                class="btn btn-success w-25"
            >
                Login
            </button>
            <a href="register.php" class="ms-3">Don't have an Account. Click here</a>
            
        </div>
      
       

    
</form>
                </div>

                 <div class="col bg-primary border rounded">
                        
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
