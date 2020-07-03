<?php


session_start();

if(isset($_POST['cancel'])){
header('Location:logout.php');

}

if(isset($_POST['login'])){
    $_SESSION['email'] = $_POST['email']; $_SESSION['pass']= $_POST['pass'];
    if(isset($_POST['email']) && !empty($_POST['pass']) ){
        if($_POST['pass']!="php123") {
            $_SESSION['error'] = "<div class='mx-auto w-50 pt-2'><h5 class='text-danger'>Incorrect password </h5></div>";
            error_log("Login Failed ".$_POST['email']." ".password_hash($_POST['email'], PASSWORD_DEFAULT) );  
            header('Location:login.php');
            return;
        }
    
       
        $email = $_POST['email'];
        if(filter_var( $email, FILTER_VALIDATE_EMAIL)){
            session_start();
            $_SESSION['name']  = $_POST['email'];
            $_SESSION['success'] = "Logged In.";
            error_log("Login Success ".$_POST['email']); 
            header('Location:index.php');
            return;
            
        }
        else {
            
            $_SESSION['error'] = "<div class='mx-auto w-50 pt-2'><h5 class='text-danger'>Email must have an at-sign (@)</h5></div>";
            error_log("Login Failed ".$_POST['email']." ".password_hash($_POST['email'], PASSWORD_DEFAULT) );  
            header('Location:login.php');
            return;
    
                
    }
   
        
}else {
    $_SESSION['error'] = "<div class='mx-auto w-50 pt-2'><h5 class='text-danger'>Email and Password are required.</h5></div>";
            error_log("Login Failed ".$_POST['email']." ".password_hash($_POST['email'], PASSWORD_DEFAULT) );  
            header('Location:login.php');
            return;
}
}

   



    

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aryan Bhandari</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>

    <body>

        <!-- HEADING  -->
        <div class=" mx-auto w-50 pt-5">
            <h2>Please Login First</h2>
        </div>

        <?php
        
     
                if(isset($_SESSION['error'])){
                    echo($_SESSION['error']); 
                unset($_SESSION['error']);
                }

                if(isset($_SESSION['success'])){
                    echo("<div class='mx-auto w-50 pt-2'><h5 class='text-success'>".$_SESSION['success']."</h5></div>");
                    unset($_SESSION['success']);
                }
            
       
        
        ?>


<!-- 
     pass = php123   
-->
        <!-- Login FORM  -->
        

<div class="container">
<form method="POST" class="w-50 mt-3 " value="Log In" >
                <div class="form-group">
                    <label for="who">User Name:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" >
                   
                </div>

                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="pass" class="form-control" id="pass" name="pass" placeholder="Enter password"  >
                   
                </div>
                <input type="submit" value="Log In" name="login" class="btn btn-success">
                <input type="submit" value="Cancel" name="cancel" class="btn btn-danger ">

                <h5 class="mt-3">Password is php123</h5>
                

            </form>
</div>
            
           

      


        <!-- SCRIPTS -->
       
          <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js "></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js "></script>
    </body>

    </html>