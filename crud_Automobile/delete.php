<?php

session_start();
require_once 'pdo.php';

if(!isset($_GET['user_id'])){
    $_SESSION['error'] = '<h5 style="color:red" class="w-25 mx-auto">Missing User Id</h5>';
    header('Location:index.php');
    return;
}

$stmt = $pdo->prepare("SELECT make,user_id FROM autos where user_id=:xyz");
$stmt->execute(array(
    ':xyz'=>$_GET['user_id']

));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row === false){
    $_SESSION['error'] = '<h5 style="color:red" class="w-25 mx-auto">Bad Value For User Id</h5>';
    header('Location:index.php');
    return;
}

if(isset($_POST['delete']) && isset($_POST['user_id']) ) {
    $sql = "DELETE FROM autos WHERE user_id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip'=> $_POST['user_id'] 
    ));

  $_SESSION['success'] ='<h5 style="color:green" class="w-25 mx-auto">Record Deleted</h5>';
  header('Location:index.php');
  return;

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
   <h4>Confirm : Deleting <?=  htmlentities($row['make']); ?></h4> 
</div>


<form action="#" method="POST" class="w-50 mx-auto mt-4  " >
       
    <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
        <button type="submit" name="delete"  class=" btn btn-danger mr-4"><b>Delete</b></button>
        <a href="index.php" class="btn btn-primary">Cancel</a>
    </form>

    </body>

    </html>