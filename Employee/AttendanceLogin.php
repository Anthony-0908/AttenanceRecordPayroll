
  <?php
    // session_start();
    include('../connection.php');

    if(isset($_POST['attendance'])){
        date_default_timezone_set('Asia/Manila');
        $time = date("h:i:s");
        $today = date("D - F d, Y");
        $date = date("Y-m-d");
        $in = "6:00:00";
        $out = "20:00:00";

        $code = $_POST['operation'];

        if($code == "time-in"){
            $id = $_POST['employee_id'];
            $Password = $_POST['password'];

            $sql_id = "SELECT * FROM employee_tbl WHERE Emp_id ='$id'";
            $result = mysqli_query($conn, $sql_id);

            if(mysqli_num_rows($result) > 0 ){ 
                while($row_login = mysqli_fetch_assoc($result)) { 
                    if(!password_verify($Password , $row_login['Password'])){

                        echo "this credential is wrong ";
                        // $_SESSION['id'] = $row_login['id'];
                        // header('Location:Home.php');
                        
                    }
                    else{
                        echo "this credential is right";
                        $sql2 = "SELECT * FROM attendance WHERE emp_id = '$id' and attendance_date ='$date'";
                        $result_attendance = mysqli_query($conn , $sql2);
                        if(!$row2 = $result_attendance->fetch_assoc()){
                            $fname = $row_login['Firstname'];
                            $lname = $row_login['Lastname'];
                            $full = $lname. ',' . $fname;

                            $first = new DateTime($in);
                            $second = new DateTime($out);
                            $interval = $first->diff($second);
                            $hrs = $interval->format('%h');
                            $mins = $interval->format('%i');
                            $mins = $mins/60;
                            $int = $hrs + $mins;
                           

                            $sql_timein = "INSERT INTO attendance(emp_id , full_name, attendance_date , time_in, time_out, hours) VALUES ('$id', '$full', '$date', '$in' , '$out', '$int')";

                            $result3 = mysqli_query($conn , $sql_timein);
                            echo "time in: $full";

                    

                        }
                        else{
                            echo "You alread have time in ";
                        }



                    }
                }
            }
        }

        if($code == "time-out"){
            $id =$_POST['employee_id'];
            $Password = $_POST['password'];

            $sql_id2 = "SELECT * FROM employee_tbl WHERE Emp_id = '$id'";

            $result_timeout = mysqli_query($conn , $sql_id2);

            if(mysqli_num_rows($result_timeout) > 0 ) { 
                while($row_logout = mysqli_fetch_assoc($result_timeout)){
                    if(!password_verify($Password , $row_logout['Password'])){
                        echo "This credential is wrong";
                    }
                    else{
                        $query = "SELECT * FROM attendance WHERE emp_id = '$id' AND attendance_date ='$date'";
                        $queryres = mysqli_query($conn , $query);
                        while($rowres = mysqli_fetch_array($queryres)){
                            $timein = $row_login['time_in'];
                        }
                        //the constant variable should be $timein this is only a test drive 
                        $first = new DateTime($in);
                        $second = new DateTime($out);
                        $interval = $second->diff($first);
                        $hrs = $interval->format('%h');
                        $mins = $interval->format('%i');
                        $mins = $mins/60;
                        $int = $hrs + $mins;
                        

                        $sql_timeout = "UPDATE attendance SET time_out ='$out' , hours ='$int' WHERE emp_id ='$id' AND attendance_date ='$date'";

                        $result_timeout = mysqli_query($conn, $sql_timeout);
                        echo "You have timed out";
                        header("location:AttendanceLogin.php");
                    }
                }
            }
        }





    }


?>

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
<div>
    <p id="date"></p>
    <p id="time" class="bold"></p>
</div>
    <form id="formdata" style="max-width:300px; margin:auto; margin-top:150px;"  action="" method="POST">
   
    <h1 class="h3 mb-3">Employee Login</h1>
        <label class="sr-only">Employee ID</label>
        <input type="text" class="form-control" name="employee_id"  placeholder=" Employee id">

        <input type="password" class="form-control mt-3" name="password" placeholder="password">
      
        <div class="input-group mt-3 mb-3">
          <select name="operation" class="form-control">
            <option value="time-in">Time In</option>
            <option value="time-out">Time Out</option>
          </select>
        </div>

        <input type="submit" class="btn btn-primary btn-block" name="attendance" value="Submit">
        

        <!-- <input type="submit" name="time_out" value="Time out"> -->
    </form>
    <script src="../js/bootstrap.js"></script>
    <script src="../Employee/plugins/moment/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
      var interval = setInterval(function() {
   var momentNow = moment();
   $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
   $('#time').html(momentNow.format('hh:mm:ss A'));
 }, 100);
    </script>


  


   
    

  
    
</body>
</html>