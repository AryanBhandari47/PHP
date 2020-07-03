<?php 
session_start();
require_once "pdo.php";


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

    <div class=" w-50 mx-auto mt-5 mb-5">
        <h1>Welcome To Autos Database</h1>
        </div>
<?php

if(isset($_SESSION['error'])){
    echo($_SESSION['error']);
    unset($_SESSION['error']);
}

if(isset($_SESSION['success'])){
    echo($_SESSION['success']);
    unset($_SESSION['success']);
}

if(isset($_SESSION['email']) && isset($_SESSION['pass'])) {

    if(isset($_SESSION['recordInserted'] )){
        echo($_SESSION['recordInserted'] );
        unset($_SESSION['recordInserted'] );
        }
      
            
            $stmt = $pdo->query("SELECT user_id, make, model, year, mileage FROM autos");
            echo("<table class='container w-50 mx-auto table-bordered'><tr>
            
            
            <th>Make</th> 
            <th>Model</th> 
            <th>Year</th> 
            <th>Mileage</th> 
            <th>Edit / Delete</th> 
        
            </tr>");
            while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
               
                echo('<div class="mt-5"></div>');

                echo("<tr><td>");
                echo(htmlspecialchars($row['make'])    );
                echo("</td><td>");
        
                echo(htmlspecialchars($row['model'])    );
                echo("</td><td>");
        
                echo(htmlspecialchars($row['year'])    );
                echo("</td><td>");
        
                echo(htmlspecialchars($row['mileage'])   );
                echo("</td><td>");
        
                echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a> / ' );
                echo('<a href="delete.php?user_id='.$row['user_id'].'">Delete</a> ' );
                
                echo("</td>");
        
                echo("\n</form> \n");
               
                echo("</tr>\n");
            }
        
            echo("</table>");
        
        ?>
        
        
            <form  method="POST" class="w-50 mx-auto mt-5  " >
               
                <a href="add.php" class="btn btn-success">Add New Entry</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
                
            </form>
        
        
        
            
            <?php
}else {
    echo('<div class="w-50 mx-auto">');
    echo('<a href="login.php">');
    echo('<h4>Please log in</h4>');
    echo('</a>');
    echo('</div>');
}
  
?>
     

         
    
    <!-- <div class="spacing mb-5"></div> -->
   







    <!-- SCRIPTS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>