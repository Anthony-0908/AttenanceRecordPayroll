<?php
// session_start();

// if(isset($_SESSION['username'])){
//     header("localhost:index.php?action=login");
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <?php include('includes/navbar.php');?>
    <title>Edit Employee</title>
</head>
<body>
    <?php
    include('../connection.php');
    if(isset($_POST['edit_employee'])){
        $id = $_POST['edit_id'];
        $Sql = "SELECT * FROM employee_tbl WHERE id ='$id'";
        $Run = mysqli_query($conn, $Sql);

        foreach($Run as $row){
            ?>


<form action="updateEmployee.php" method="POST">
    
    
<div class="col-lg-6 mx-auto border border-light" style="margin-top:50px;">
<h2 class="text-center">Edit Employee Information </h2>
        <div class="mb-3">
            <label>Emmployee ID</label>
            <input type="text" name="edit_employee_id" class="form-control" placeholder="Employe ID" value="<?php echo $row['Emp_id'];?>" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="edit_password"  class="form-control"  value="<?php  $row['Password'];?>" placeholder="password">
        </div>

        
        <div class="mb-3">
            <label>Position</label>
            <input type="text" name="edit_position"  class="form-control" value="<?php echo $row['Position'];?>" placeholder="position" required>
        </div>


        
        <div class="mb-3">
            <label>Hour rate</label>
            <input type="text" name="edit_hour_rate"  class="form-control" value="<?php echo $row['hour_rate'];?>" placeholder="Hour rate" required>
        </div>

        <div class="mb-3">
             
        <input type="text" value="<?php echo $row['Firstname'];?>" class="form-control" name="edit_firstname" placeholder="firstname" required>
        </div>

        <div class="mb-3">
        <input type="text" class="form-control" value="<?php echo $row['Lastname'];?>"  name="edit_lastname" placeholder="lastname" required>
        </div>

        <div class="mb-3 mx-auto ">

            
        <input type="submit" name="update" class="btn btn-md p-3  btn-block  btn-primary w-50 " style="margin-left:175px;"  value="Update">
        </div>

       
    </form>

            <?php
        }
    }
    ?>
   
    
</body>
</html>