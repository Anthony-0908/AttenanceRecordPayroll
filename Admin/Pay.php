<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <title>Payroll</title>
</head>
<?php include('includes/navbar.php');?>
<body style="background:white; color:black;">

<?php
	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);

    $range_to = date('m/d/Y');
    $range_from = date('m/d/Y', strtotime('+15 day', strtotime($range_to)));
?>

<input type="text" class="pull-right col-lg-3" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_to.' - '.$range_from; ?>">
   
      

        <?php
include('../connection.php');

$id = $_GET['id'];

$to = date('Y-m-d');
$from = date('Y-m-d', strtotime('-15day', strtotime($to)));
if(isset($_GET['range'])){
    $range = $_GET['range'];
    $ex = explode('-', $range);
    $from = date('Y-m-d',strtotime($ex[0]));
    $to = date('Y-m-d',strtotime($ex[1]));

}
$Sql_time = "SELECT *, SUM(hours) AS total_hrs, attendance.emp_id, attendance.full_name, employee_tbl.Position,employee_tbl.Emp_id AS emp_id FROM attendance LEFT JOIN employee_tbl ON employee_tbl.Emp_id = attendance.emp_id WHERE attendance.emp_id = '$id'";

$query = mysqli_query($conn, $Sql_time);
$total = 0;
while($row = mysqli_fetch_assoc($query)){
    $fullname = $row['full_name'];

    $emp_id = $row['Emp_id'];
    $total_hrs = $row['total_hrs'];

    $gross = $row['hour_rate'] * $row['total_hrs'];


   
   
    if($gross <= 1500){
        $pag_ibig = $gross *0.01;

    }else{
        $pag_ibig = $gross * 0.02;
    }

    $phil_health = $gross * 0.04;

    $sss = $gross * 0.04;
    $total_deductions = $phil_health + $pag_ibig + $sss ;
    $net = $gross - $total_deductions;

    $taxes = $net * 24;

    if($taxes <= 250000){
        $inc_taxes = $taxes * 0;
    }
    elseif($taxes >= 250000 || $taxes <= 400000 ){
        $inc_taxes = $taxes  * 0.20;
    }elseif($taxes >= 400000 || $taxes <= 800000){
        $inc_taxes = ($taxes + 30000) *0.25; 
    }elseif($taxes >= 800000 || $taxes <= 2000000){
        $inc_taxes = ($taxes +130000) *0.30;


    }elseif($taxes >=2000000|| $taxes <=8000000){
        $inc_taxes = ($taxes + 490000) * 0.32;
    }else{
        $inc_taxes = ($taxes + 2410000) * 0.35;
    }

    $date = date('Ymd');
    $rand = rand(99,00);

    $payroll_number =($date.$rand);

}
    ?>
    


    <form action="#" method="POST">
        <div class="col-lg-6 mx-auto border border-light">
            <h2 class="bg-dark text-white">Payroll</h2>
            <div class="mb-3">
                <label>Full name</label>
                <input type="text" class="form-control" name="full_name" readonly value="<?php echo $fullname;?>">
            </div>

            <div class="mb-3">
                <label>Employee ID</label>
                <input type="text" class="form-control"  name="emp_id" readonly value="<?php echo $emp_id;?>">
            </div>

            <div class="mb-3">
            <label>Payroll Number</label>
            <input type="text" class="form-control"  name="payrollnumber" readonly value="<?php echo $payroll_number?>">
            </div>


            <div class="mb-3">
            <label>Total hours</label>
            <input type="text"  class="form-control"  name="total_hrs" readonly value="<?php echo number_format($total_hrs , 2)?>">
            </div>

            <div class="mb-3">
            <label>Gross</label>
                <input type="text" class="form-control" name="gross" readonly value="<?php echo number_format($gross,2)?>">
            </div>

            <div class="mb-3">
            <label>SSS</label>
                <input type="text" class="form-control" name="sss" readonly value="<?php echo number_format($sss,2)?>">
            </div>

            <div class="mb-3">
            <label>Pag-ibig</label>
                <input type="text" class="form-control" name="pag-ibig" readonly value="<?php echo number_format($pag_ibig,2)?>">
            </div>

            <div class="mb-3">
            <label>Phil-health</label>
            <input type="text" class="form-control" name="philhealth" readonly value="<?php echo number_format($phil_health,2)?>">
            </div>

            <div class="mb-3">
            <label>Income taxes</label>
            <input type="text"  class="form-control"  name="inc_taxes" readonly value="<?php echo number_format($inc_taxes,2)?>">
            </div>

            <div class="mb-3">
            <label>Net Pay</label>
            <input type="text" class="form-control" name="net_pay" readonly value="<?php echo number_format($net,2)?>">
            </div>


            <div class="mb-3 mx-auto">
            <input type="submit" class="btn btn-md p-3 btn-block btn-primary w-50" style="margin-left:175px;" name="insert" value="Insert">
            </div>


        </div>
           
           
           
          
          
          
          
          
        </form>

  
    <?php 
    include('../connection.php');

    if(isset($_POST['insert'])){

        date_default_timezone_set('Asia/Manila');
        $dateTimeCreated = date('Y-m-d');
        $dateTimeUpdated = date('Y-m-d');
        $Emp_id = $_POST['emp_id'];
        $full_name = $_POST['full_name'];
        $total_hrs = $_POST['total_hrs'];
        $payroll_number = $_POST['payrollnumber'];
        $gross = $_POST['gross'];
        $sss = $_POST['sss'];
        $phil_health = $_POST['philhealth'];
        $pag_ibig = $_POST['pag-ibig'];
        $inc_taxes = $_POST['inc_taxes'];
        $net_pay = $_POST['net_pay'];
        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-15day', strtotime($to)));


        $sql_validation = "SELECT * FROM payroll WHERE emp_id = '$id' AND date_to = '$to' AND date_from = '$from'";
        $result_validation = mysqli_query($conn, $sql_validation);
        if(mysqli_num_rows($result_validation) > 0 ) {
            echo "<script>alert('payroll is already generated generated')</script>";
            echo "<script> window.location.href = 'viewEmployee.php';</script>";

        }
        else{
            $Payroll = "INSERT INTO payroll (emp_id, full_name, total_hrs, date_to, date_from, payroll_number, salary, SSS , pagibig, philhealth, taxes , net_pay, DateTimeCreated, DateTimeUpdated) VALUES('$Emp_id' , '$full_name', '$total_hrs', '$to','$from','$payroll_number', '$gross', '$sss', '$pag_ibig','$phil_health', '$inc_taxes', '$net_pay', '$dateTimeCreated' , '$dateTimeUpdated')";
            $Payroll_query = mysqli_query($conn , $Payroll);
    
            if(($Payroll_query)) {
                echo "record inserted";
                echo "<script> window.location.href = 'viewEmployee.php';</script>";
                
            }else{
                echo 'not inserted'.$Payroll_query."<br>".$conn->error;
                echo "<script> window.location.href = 'viewEmployee.php';</script>";
            }
    
    
        }
    
        }

      

?>


    <?php

    

    


?>




<script src="payroll.js"></script>
<script>
</script>
</body>
</html>