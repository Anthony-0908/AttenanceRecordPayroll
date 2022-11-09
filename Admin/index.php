<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Admin login</title>
</head>
<body>

<form action="" method="POST">
    <input type="text" name="admin" placeholder="Username">
    <br>
    <input type="password" name="password" placeholder="Password">

    <input type="submit" name="login" value="login">
</form>




<script src="../js/bootstrap.js"></script>
<?php
include('../connection.php');
session_start();


if(isset($_POST['login'])){
    if(empty($_POST['admin']) || empty($_POST['password'])){
        echo '<script>alert("Both fieds are empty")</script>';
    }

    else{
        $admin = mysqli_real_escape_string($conn, $_POST['admin']);

        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $login = "SELECT * FROM admin where username ='$admin' AND password ='$password'";

        $sql = mysqli_query($conn, $login);

        if($sql->num_rows > 0 ) { 
            $row = mysqli_fetch_assoc($sql);

            $_SESSION['admin'] = $row['admin'];
            header('location: home.php');



        }
        else{
            echo "error".$sql."<br>".$conn->error;

        }

    }
}
?>
    
</body>
</html>