<?php
include('../connection.php');

if(isset($_POST['update'])){
    $edit_id = $_POST['edit_id'];
    $Edit_empid = $_POST['edit_employee_id'];
    $Edit_password = $_POST['edit_password'];
    $Password = password_hash($Edit_password, PASSWORD_BCRYPT);
    $Edit_position = $_POST['edit_position'];
    $Edit_firstname = $_POST['edit_firstname'];
    $Edit_lastname = $_POST['edit_lastname'];


    $Select = "SELECT * FROM employee_tbl WHERE Emp_id = '$Edit_empid'";
    $Res_id = mysqli_query($conn, $Select);
    if(!mysqli_num_rows($Res_id)){
        echo "There is someone the same id as you";
        exit();

    }
    else{
        $Query = "UPDATE employee_tbl SET Emp_id = '$Edit_empid', Password ='$Password', Position = '$Edit_position' , Firstname = '$Edit_firstname' , Lastname = '$Edit_lastname' WHERE id = '$edit_id'";
        $Sql = mysqli_query($conn , $Query);

        if($Sql){
            echo "record Updated";
            header('location:viewEmployee.php');

        }else{
            echo"error".$Sql."<br>".$conn->error;
        }

    }


}
?>