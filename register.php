<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD']==="POST") {
    $name=$_POST['name'];
    $uname = $_POST['uname'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

     if (empty($name) || empty($uname) || empty($mail) || empty($pass) || empty($cpass)) {
        echo '<div class="alert alert-danger">All fields are required.</div>';
    }elseif(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        echo '<div class="alert alert-danger">Enter valid Email.</div>';
    }elseif($pass!=$cpass){
        echo '<div class="alert alert-danger">Password do not match.</div>';
    }else{
        $hash=password_hash($pass,PASSWORD_DEFAULT);
        $sql=$Conn->prepare("insert into pro(name,uname,mail,password) values(?,?,?,?)");
        $sql->bind_param("ssss",$name,$uname,$mail,$hash);
        $sql->execute();
        header("Location:login.php");
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Register</title>
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
                <div class="col bg-primary border rounded">
                        
                </div>
                 
                <div class="col d-flex justify-content-center align-items-center g-3 bg-white border rounded me-4 mt-3">
<form action="" method="post" class="w-50">
    <h2 class="text-center mt-3 text-primary ">Register</h2>
    
    <div class="form-floating mb-3 mt-3">
        <input
            type="text"
            class="form-control"
            name="name"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Name</label>
        </div>

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
            name="mail"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Email</label>
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
         <div class="form-floating mb-3 mt-3">
        <input
            type="text"
            class="form-control"
            name="cpass"
            id="formId1"
            placeholder=""
        />
        <label for="formId1">Confirm Password</label>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-3">
            <button 
                type="submit"
                class="btn btn-primary w-25"
            >
                Register
            </button>
            <a href="login.php" class="ms-3">Already have an Account. Click here</a>
            
        </div>
      
       

    
</form>
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
