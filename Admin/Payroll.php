<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>
<?php include('includes/navbar.php');?>
<body style="background:white; color:black;"></body>

<?php
	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);

    $range_to = date('m/d/Y');
    $range_from = date('m/d/Y', strtotime('+30 day', strtotime($range_to)));
?>

<input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_to.' - '.$range_from; ?>">
        <thead>
            <tr>
            <th>Employee id</th>
            <th>Hours</th>
            <th>Employee Name</th>
            <th>Postion</th>
            <th>Basic Salary</th>
            <th>Deduction</th>
            <th>SSS</th>
            <th>Pag-ibig</th>
            <th>Philhealth</th>
            <th>Taxes</th>
            <th>Net Pay</th>
            <th>Action</th>
            </tr>
           
        </thead>
  

    <tbody>
      

        <?php
include('../connection.php');

$to = date('Y-m-d');
$from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
if(isset($_GET['range'])){
    $range = $_GET['range'];
    $ex = explode('-', $range);
    $from = date('Y-m-d',strtotime($ex[0]));
    $to = date('Y-m-d',strtotime($ex[1]));

}
$Sql_time = "SELECT *, SUM(hours) AS total_hrs, attendance.emp_id, attendance.full_name, employee_tbl.Position,employee_tbl.Emp_id AS emp_id FROM attendance LEFT JOIN employee_tbl ON employee_tbl.Emp_id = attendance.emp_id WHERE attendance.attendance_date BETWEEN '$from' AND '$to' GROUP BY attendance.emp_id  ORDER BY employee_tbl.Lastname, employee_tbl.Firstname, employee_tbl.Position";

$query = mysqli_query($conn, $Sql_time);
$total = 0;
while($row = mysqli_fetch_assoc($query)){

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
    ?>
    <tr>
        <form aciton="#" method="POST">
            <td><?php echo $payroll_number?></td>
            <td><?php echo $to?></td>
            <td><?php echo $from?></td>
            <td><?php echo $row['total_hrs'];?></td>
            <td><?php echo $row['full_name'];?></td>
            <td><?php echo $row['Position'];?></td>
            <td><?php echo number_format($gross, 2)?></td>
            <td><?php echo number_format($total_deductions, 2)?></td>
            <td><?php echo number_format($sss, 2)?></td>
            <td><?php echo number_format($phil_health, 2)?></td>
            <td><?php echo number_format($pag_ibig, 2)?></td>
            <td><?php echo number_format($inc_taxes, 2)?></td>
            <td><?php echo number_format($net, 2);?></td>
            <td><?php echo number_format($inc_taxes , 2)?></td>
            <td>
        </form>
        <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddPayroll">Generate</button>
        </td>
        <td>
            <form action="generatepayslip.php" method="POST">
                <input type="hidden" name="id_emp" value="<?php echo $row['emp_id'];?>">
                <input type="submit" name="generate" value="generate invoice">
            </form>
           
        </td>
       
      
        </td>
       



    </tr>





<?php
}



 

?>



        </tr>
    </tbody>
    </table>

    <?php

    

    


?>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    $document.on('submit'), '#insertPayroll', function(e){
        e.preventDefault();

        var formData = new Formdata(this);
        formData.append('save_payroll',true)
        $.ajax({
            type:"POST",
            url:"modal/payroll_modal.php",
            data:formData,
            processData:false,
            contentType:false,
            success:function(response){
                var res= jQuery.parseJSON(response);
                if(res.status == 422)
                {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);

                }else if(res.status == 200){
                    $('#errorMessage').addClass('d-none');
                    $('#AddPayroll').modal('hide');
                    $('#insertPayroll')[0].reset();
                }
            }
        })
            
    }
</script>
</body>
</html>