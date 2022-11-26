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
<div class="text-center">
    <form style="max-width:300px; margin:auto; margin-top:150px;" action="" method="POST">
        <h1 class="h3 mb-3">Login Admin</h1>
        <label class="sr-only">Username</label>
        <input type="text" name="admin" class="form-control">

        <label for="password" class="sr-only">Password</label>

        <input type="password" name="password" class="form-control">

        <div class="mt-3">
            <button name="login" class="btn btn-lg btn-primary btn-block">Sign in</button>
        </div>
</form>
    </div>





<script src="../js/bootstrap.js"></script>
<?php
session_start();
include('../connection.php');



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

            $_SESSION['username'] = $row['username'];
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