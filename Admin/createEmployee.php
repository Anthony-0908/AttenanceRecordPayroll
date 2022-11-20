<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Create Employee</title>
</head>
<body>
<?php include('includes/navbar.php');?>
    <div class="container">
        <div class=""></div>
    </div>
    <form action="" method="POST">

    
        <div class="col-lg-6 mx-auto border border-light" style="margin-top:50px;">
        <div class="mb-3">
            <label>Emmployee ID</label>
            <input type="text" name="emp_id" class="form-control" placeholder="Employe ID" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password"  class="form-control" placeholder="password">
        </div>

        
        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="position"  class="form-control" placeholder="position" required>
        </div>


        
        <div class="mb-3">
            <label>Hour rate</label>
            <input type="text" name="hour_rate"  class="form-control" placeholder="Hour rate" required>
        </div>

        <div class="mb-3">
             
        <input type="text" class="form-control" name="firstname" placeholder="firstname" required>
        </div>

        <div class="mb-3">
        <input type="text" class="form-control"  name="lastname" placeholder="lastname" required>
        </div>

        <div class="mb-3 mx-auto ">

            
        <input type="submit" name="submit" class="btn btn-md p-3  btn-block  btn-primary w-50 " style="margin-left:175px;"  value="create">
        </div>

       
        </div>
        
       
        <br>
        
        <br>

       
   
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
    $Hour = $_POST['hour_rate'];
    $hash = password_hash($Password , PASSWORD_BCRYPT);
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];


    $validation_id = "SELECT Emp_id FROM employee_tbl WHERE Emp_id = '$Emp_id'";
    $validate_id = mysqli_query($conn, $validation_id);

    if(mysqli_num_rows($validate_id) > 0) {
        echo "The id is already taken";




    } else{
        $sql = "INSERT INTO employee_tbl(Emp_id,Password, Position, hour_rate, Firstname, Lastname) VALUES('$Emp_id' ,'$hash' , '$Position','$Hour','$Firstname', '$Lastname')";

        $query_run = mysqli_query($conn, $sql);
    
        if(($query_run) > 0){
            echo"<script>alert('Record inserted')</script>";
            header('Location:viewEmployee.php');
    
        }
        else{
            echo 'not inserted'.$sql."<br>".$conn->error;
    
        }
        
    
    }



   
    
    

}
?>