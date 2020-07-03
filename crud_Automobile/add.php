<?php
require_once "pdo.php";
session_start();

if(!isset($_SESSION['name']) ){  
    die("<h2>Access Denied.</h2>");
}


if(isset($_POST['cancel'])){
header('Location:index.php');

}



// ADD

if(isset($_POST['add'])){
   
    if(empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])  ){
        
        $_SESSION['error'] =" <h5 class='text-danger text-center mt-4 submitMsg'>All fields are required.</h5>";
        
        header('Location:add.php');
        return ;
    }
else {
  
    if(!is_numeric($_POST['mileage'] ) || !is_numeric($_POST['year'])){
        $_SESSION['error'] = " <h5 class='text-danger text-center mt-4 submitMsg'>Mileage and year must be numeric</h5>";
        header('Location:add.php');
        return ;
    }
    else 
    {
        
             $sql = "INSERT INTO autos (make,model,year,mileage) VALUES (:make , :model, :year , :mileage)";
            
         $stmt = $pdo->prepare($sql);
         $stmt->execute(array(
             ':make' => $_POST['make'],
             ':model' => $_POST['model'],
             ':year' => $_POST['year'],
             ':mileage' => $_POST['mileage'],
            
             
        ));
        $_SESSION['recordInserted'] = " <h5 class='text-success text-center mt-4 submitMsg'>Record added.</h5>";
        header('Location:index.php');
        return;
         }
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
  

    <?php
     
 echo('<div class="container w-50 mt-3 mb-5">');
     if(isset($_SESSION['name']) && !empty($_SESSION['name'])){
        echo("<h2> Tracking Autos For ".$_SESSION['name']."</h2>");
    }  
echo('</div>');
    
   
            if(isset($_SESSION['error']) ){

                echo($_SESSION['error']);
               unset($_SESSION['error']);
 
            }
            
               
      ?>

    <!------------Tracking Form---------->
    <form action="#" method="POST" class="w-50 mx-auto mt-3  " >
        <div class="form-group">

            <label for="make"><b>Make:</b></label>
            <input type="text" name="make" class=" form-control" placeholder="Enter Make" id="name" >
            
        </div>

        <div class="form-group">

        <label for="model"><b>Model:</b></label>
        <input type="text" name="model" class=" form-control" placeholder="Enter Model" id="name" >

        </div>



        <div class="form-group">
            <label for="year"><b>Year:</b></label>
            <input type="text" name="year" class="form-control" placeholder="Enter Year" id="phone" >
           
        </div>

        <div class="form-group">
            <label for="mileage"><b>Mileage:</b></label>
            <input type="text" name="mileage" class="form-control" placeholder="Enter Mileage" id="mileage" >
          
        </div>

        <button type="submit" name="add" id="addButton" class="addButton btn btn-success mr-4"><b>Add</b></button>
        <button type="submit" class="btn btn-danger " name="cancel">Cancel</button>
    </form>



    


    <!-- SCRIPTS -->
   

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>