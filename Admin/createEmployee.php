<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class=""></div>
    </div>
    <form action="" method="POST">
        <input type="text" name="emp_id" placeholder="Employe ID">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <input type="text" name="position" placeholder="position">
        <br>
        <input type="text" name="firstname" placeholder="firstname">
        <br>
        <input type="" name="lastname" placeholder="lastname">
        <br>

        <input type="submit" name="submit" value="create">
   
    </form>
    <script src="../js/bootstrap.js"></script>
</body>
</html>




<?php 

include('../connection.php');
if(isset($_POST['submit'])){


    $Emp_id = $_POST['emp_id'];
    $Password = $_POST['password'];
    $Position = $_POST['position'];
    $hash = password_hash($Password , PASSWORD_BCRYPT);
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];


    $validation_id = "SELECT Emp_id FROM employee_tbl WHERE Emp_id = '$Emp_id'";
    $validate_id = mysqli_query($conn, $validation_id);

    if(mysqli_num_rows($validate_id) > 0) {
        echo "The id is already taken";




    } else{
        $sql = "INSERT INTO employee_tbl(Emp_id,Password, Position, Firstname, Lastname) VALUES('$Emp_id' ,'$hash' , '$Position','$Firstname', '$Lastname')";

        $query_run = mysqli_query($conn, $sql);
    
        if(($query_run) > 0){
            echo"<script>alert('Record inserted')</script>";
            header('viewEmployee.php');
    
        }
        else{
            echo 'not inserted'.$sql."<br>".$conn->error;
    
        }
        
    
    }



   
    
    

}
?>