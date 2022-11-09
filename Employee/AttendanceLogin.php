<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Login</title>
</head>
<body>
    <form action="#" method="POST">
        <input type="text" name="employee_id" placeholder=" Employee id">
        <br>
        <input type="password" name="password" placeholder="Password">
        <br>
        <input type="submit" name="time_in" value="Time in">

        <!-- <input type="submit" name="time_out" value="Time out"> -->
    </form>


    <form action="" method="POST">

    </form>
    

    <?php

// $time = "06:58:00";
// $time2 = "0:40:00";

// $secs = strtotime($time2)-strtotime("00:00:00");
// echo $result = date("H:i:s",strtotime($time)+$secs);

    include('../connection.php');



    if(isset($_POST['time_in'])){
        if(empty($_POST['employee_id']) || empty($_POST['password'])){
            echo '<script>alert("Both fields are empty")</script>';

        }else{

             date_default_timezone_set("Asia/Manila");
            $Timein = date("H:i:s");
            $Workdate = date("Y-m-d");

            $Time_in = 1;

            $Employee_id = mysqli_real_escape_string($conn , $_POST['employee_id']);

            $Password = mysqli_real_escape_string($conn, $_POST['password']);

            $Login = "SELECT  * FROM employee_tbl WHERE  Emp_id = '$Employee_id' ";
            $result = mysqli_query($conn , $Login);

            if(mysqli_num_rows($result) > 0 ) { 
                while($row = mysqli_fetch_assoc($result)){
                    if(password_verify($Password , $row['Password'])){

                        $_SESSION['id'] = $row['id'];

                        // header('location:Home.php');



                    }
                }

                $Insert_Time_in = "INSERT INTO attendance(emp_id , Date , Time, Log_type) VALUES ('$Employee_id', '$Workdate' , '$Timein', '$Time_in')";

                $Query = mysqli_query($conn , $Insert_Time_in);

                if(($Query) == 1) { 
                    echo "<script>alert('You already clocked in ')</script>";
                }
                else{
                    echo "<script>alert('Record not Inserted')</script>";
                }
            }
        }
    }

    

?>
    
</body>
</html>