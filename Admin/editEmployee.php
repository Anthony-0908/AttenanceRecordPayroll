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
    <title>Document</title>
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
        <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
        <label>Employee ID</label>
        <input type="text" name="edit_employee_id" value="<?php echo $row['Emp_id'];?>">

        <br>
        <input type="text" name="edit_password" value="<?php $row['Password']?>">
        <br>
        <input type="text" name="edit_position" value="<?php echo $row['Position']?>">
        <br>
        <input type="text" name="edit_firstname" value="<?php echo $row['Firstname'];?>">
        <br>
        <input type="text" name="edit_lastname" value="<?php echo $row['Lastname']?>">
        <br>
        <input type="submit" name="update" value="update">
        

    </form>

            <?php
        }
    }
    ?>
   
    
</body>
</html>