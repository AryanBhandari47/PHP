<?php

session_start();
require_once 'pdo.php';

if(!isset($_GET['user_id'])){
    $_SESSION['error'] = '<h5 style="color:red" class="w-25 mx-auto">Missing User Id</h5>';
    header('Location:index.php');
    return;
}

$stmt = $pdo->prepare("SELECT * FROM autos where user_id=:xyz");
$stmt->execute(array(
    ':xyz'=>$_GET['user_id']

));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row === false){
    $_SESSION['error'] = '<h5 style="color:red" class="w-25 mx-auto">Bad Value For User Id</h5>';
    header('Location:index.php');
    return;
}

$make = htmlentities($row['make']);
$model = htmlentities($row['model']);
$year = htmlentities($row['year']);
$mileage = htmlentities($row['mileage']);
$user_id = $row['user_id'];



// SAVE 
// if(isset($_POST['add'])){
   
//     if(empty($_POST['make']) || empty($_POST['model']) || empty($_POST['year']) || empty($_POST['mileage'])  ){
        
//         $_SESSION['error'] =" <h5 class='text-danger text-center mt-4 submitMsg'>All fields are required.</h5>";
        
//         header('Location:add.php');
//         return ;
//     }
// else {
  
//     if(!is_numeric($_POST['mileage'] ) || !is_numeric($_POST['year'])){
//         $_SESSION['error'] = " <h5 class='text-danger text-center mt-4 submitMsg'>Mileage and year must be numeric</h5>";
//         header('Location:add.php');
//         return ;
//     }
//     else 
//     {
        
//              $sql = "INSERT INTO autos (make,model,year,mileage) VALUES (:make , :model, :year , :mileage)";
            
//          $stmt = $pdo->prepare($sql);
//          $stmt->execute(array(
//              ':make' => $_POST['make'],
//              ':model' => $_POST['model'],
//              ':year' => $_POST['year'],
//              ':mileage' => $_POST['mileage'],
            
             
//         ));
//         $_SESSION['recordInserted'] = " <h5 class='text-success text-center mt-4 submitMsg'>Record added.</h5>";
//         header('Location:index.php');
//         return;
//          }
// }
       
    
   
 
if(isset($_POST['save'])  ) {

    if(!empty($_POST['make']) && !empty($_POST['model']) && !empty($_POST['year']) && !empty($_POST['mileage'])  ) {

        $sql = "UPDATE autos SET make= :make ,
                                 model= :model,
                                 year= :year,
                                 mileage= :mileage,
                                 user_id=:user_id
                                 WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':make'=>$_POST['make'],
            ':model'=>$_POST['model'],
            ':year'=>$_POST['year'],
            ':mileage'=>$_POST['mileage'],
            ':user_id'=> $_POST['user_id']
        ));

        $_SESSION['success'] ='<h5 style="color:green" class="w-25 mx-auto">Record Updated</h5>';
        header('Location:index.php');
        return;
      
    }
    else {
        $_SESSION['fieldreqerror'] = '<h5 style="color:red" class="w-25 mx-auto">All fields are required</h5>';
        header('Location:edit.php?user_id= '.$row["user_id"].'');
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

<div class="container w-50 mx-auto mt-5">
   <h2>Editing Automobile</h2>
</div>

<?php
if(isset($_SESSION['fieldreqerror'])){
    echo($_SESSION['fieldreqerror']);
    unset($_SESSION['fieldreqerror']);
}
?>

<form method="POST" class="w-50 mx-auto mt-4">

<div class="form-group">
<label for="make"><b>Make:</b></label>
<input type="text" name="make" class=" form-control" value="<?= $make ?>" >
</div>

<div class="form-group">
<label for="model"><b>Model:</b></label>
<input type="text" name="model" class=" form-control" value="<?= $model ?>" >
</div>

<div class="form-group">
<label for="year"><b>Year:</b></label>
<input type="text" name="year" class="form-control" value="<?= $year ?>" >
</div>

<div class="form-group">
<label for="mileage"><b>Mileage:</b></label>
<input type="text" name="mileage" class="form-control" value="<?= $mileage ?>" >
</div>

<input type="hidden" name="user_id" value="<?= $user_id ?>">  
  
    <button type="submit" name="save"  class=" btn btn-success mr-4"><b>Save</b></button>
    <a href="index.php" class="btn btn-primary">Cancel</a>
</form>


    </body>

    </html>