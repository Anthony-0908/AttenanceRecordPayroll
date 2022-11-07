<?php
include('../connection.php');
if(isset($_POST['delete_employee'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM employee_tbl WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        echo '<script>alert("Employee is deleted")</script>';
        header("location:viewEmployee.php");

    }
    else
    {
        echo '<script>alert("Employee is not deleted")</script>';
        header("location:viewEmployee.php");
    }

}
?>
