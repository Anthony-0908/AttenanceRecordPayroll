<?php

session_start();

if(isset($_SESSION['admin'])){
    header("localhost:index.php?action=login");
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Admin Home</title>
</head>
<body>
    
<?php
include('includes/header.php');
include('includes/navbar.php');
?>
   

   <h2>Hello world </h2>



    <?php 
// include('includes/scripts.php');
include('includes/footer.php');

?>
    <script src="../js/bootstrap.js"></script>
</body>
</html>