<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title>Attendance Login</title>
</head>
<body>

<div class="text-center">

</div>
    <form  style="max-width:300px; margin:auto; margin-top:150px;"  action="#" method="POST">
   
    <h1 class="h3 mb-3">Employee Login</h1>
        <label class="sr-only">Employee ID</label>
        <input type="text" class="form-control" name="employee_id"  placeholder=" Employee id">
        <div class="mt-3" style="margin-left:40px;">
            <input type="submit" name="time_in" value="Time in" class="btn btn-lg btn-primary btn-block text-center">

            <input type="submit" name="time_out" value="Time out" class="btn btn-lg btn-primary btn-block">
        </div>
        

        <!-- <input type="submit" name="time_out" value="Time out"> -->
    </form>


    <form action="" method="POST">

    </form>


    <script src="../js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
        
    </script>

    

    <?php

// $time = "06:58:00";
// $time2 = "0:40:00";

// $secs = strtotime($time2)-strtotime("00:00:00");
// echo $result = date("H:i:s",strtotime($time)+$secs);

    include('../connection.php');



    if(isset($_POST['time_in'])){
        if(empty($_POST['employee_id'])){
            echo '<script>alert("Both fields are empty")</script>';

        }else{

             date_default_timezone_set("Asia/Manila");
            $Timein = date("H:i:s");
            $Workdate = date("Y-m-d");

            $Time_in = 1;
            $Time_out = 2;

            $Employee_id = mysqli_real_escape_string($conn , $_POST['employee_id']);

        

            $Login = "SELECT  * FROM employee_tbl WHERE  Emp_id = '$Employee_id' ";
            $result = mysqli_query($conn , $Login);

            if(mysqli_num_rows($result) > 0 ) { 
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

            if(isset($_POST['time_out'])){
                if(empty($_POST['employee_id'])){
                    echo '<script>alert("Both fields are empty")</script>';
        
                }else{
        
                     date_default_timezone_set("Asia/Manila");
                    $Timein = date("H:i:s");
                    $Timeout = date("H:i:s");
                    $Workdate = date("Y-m-d");
        
                    $Time_out = 2;
        
                    $Employee_id = mysqli_real_escape_string($conn , $_POST['employee_id']);
        
                
        
                    $Login = "SELECT  * FROM employee_tbl WHERE  Emp_id = '$Employee_id' ";
                    $result = mysqli_query($conn , $Login);
        
                    if(mysqli_num_rows($result) > 0 ) { 
                        $Insert_Time_out = "INSERT INTO attendance(emp_id , Date , Time_out, Log_type) VALUES ('$Employee_id', '$Workdate' , '$Timeout', '$Time_out')";
        
                        $Query_out = mysqli_query($conn , $Insert_Time_out);
        
                        if(($Query_out) == 1 ) { 
                            echo "<script>alert('You already clocked out  ')</script>";
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