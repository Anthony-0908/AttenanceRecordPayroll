<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time</title>
</head>
<body>
    <?php
    include('../connection.php');
    if(isset($_GET['addtime']))
    {
        $time_id = $_GET['add_id'];
        $query = "SELECT * FROM attendance WHERE id = '$time_id'";
        $query_run = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($query_run)){

           echo $row['full_name'];
           ?>

           <h2>Hello world  </h2>
           
           <?php
        }
        
    }
 

    

    ?>
    
</body>
</html>