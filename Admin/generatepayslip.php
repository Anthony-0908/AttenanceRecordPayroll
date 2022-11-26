<?php 
include('../connection.php');

require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

include('../connection.php');


$html .='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }

        
table, 
tr,
th, 
td{
    border: 1px solid black;
    border-collapse: collapse;
}
table{
    width:100%;
}

    </style>
</html>
';


$id = $_GET['payroll_id'];
$to = date('Y-m-d');
$from = date('Y-m-d', strtotime('-15day', strtotime($to)));

// $Sql_time = "SELECT *, SUM(hours) AS total_hrs, attendance.emp_id, attendance.full_name, employee_tbl.Position,employee_tbl.Emp_id AS emp_id FROM attendance LEFT JOIN employee_tbl ON employee_tbl.Emp_id = attendance.emp_id WHERE attendance.emp_id = '$id'";
// $Sql = "SELECT  payroll.total_hrs, payroll.emp_id , payroll.date_to , payroll.date_from, payroll.payroll_number, payroll.SSS, payroll.pagibig, payroll.philhealth, payroll.taxes , payroll.net_pay FROM payroll LEFT JOIN attendance ON payroll.emp_id = attendance.emp_id WHERE payroll.emp_id = '$id'";
$Sql = "SELECT * ,  employee_tbl.hour_rate FROM employee_tbl LEFT JOIN payroll ON payroll.emp_id = employee_tbl.Emp_id  WHERE payroll.emp_id = '$id' ";
$query = mysqli_query($conn, $Sql);

// $Sql_rate = "SELECT employee_tbl.hour_rate FROM employee_tbl LEFT JOIN payroll ON payroll.emp_id = employee_tbl.Emp_id WHERE payroll.emp_id = '$id'";
// $query_rate = mysqli_query($conn, $Sql_rate);
// $row = mysqli_fetch_array($query_rate);
while($rows = mysqli_fetch_array($query)){ 

$sss = $rows['SSS'];
$pagibig = $rows['pagibig'];
$philhealth = $rows['philhealth'];


date_default_timezone_set('Asia/Manila');
$dateToday = date('Y-m-d');

$total_deductions = $sss + $pagibig + $philhealth;
    

$html.='
    <div class="body">
    <div style="text-align:center">
        <h2>Payslip</h2>
    </div>

    <div style="text-align:left">
        <h4>Employers name:</h4>
        <p style="margin-top:-40px; margin-left:135px;">Dual Force Security Agency</p>
        <h4>Employee Name</h4>
        <p style="margin-top:-40px; margin-left:135px;">'.$rows['full_name'].'</p>
        <h4>Employee ID</h4>
        <p style="margin-top:-40px; margin-left:135px;">'.$rows['emp_id'].'</p>
        <h4>Pay period</h4>
        <p style="margin-top:-40px; margin-left:90px;">'.$rows['date_from'].' - '.$rows['date_to'].'</p>
    </div>
    <p style="font-style:bold; margin-left:600px;">'.$rows['payroll_number'].'</p>
    <table>
   
    <tr>
        <td>Basic salary</td>
        <td>14,500</td>
        <td></td>
    </tr>

    <tr>
    <td>Gross Salary</td>
    <td></td>
    <td>'.$rows['salary'].'</td>
    
    </tr>

   
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>Overtime Pay</td>
    <td>'.$rows['overtime_pay'].'</td>
    <td>&nbsp;</td>
    </tr>

     
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>SSS</td>
    <td>'.$rows['SSS'].'</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>Pag-ibig</td>
    <td>'.$rows['pagibig'].'</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>Philhealth</td>
    <td>'.$rows['philhealth'].'</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>Taxes</td>
    <td>'.$rows['taxes'].'</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>Total Deduction</td>
    <td>'.$total_deductions .'</td>
    <td>&nbsp;</td>
    </tr>

    <tr>
    <td>Net Pay</td>
    <td>'.$rows['net_pay'].'</td>
    <td>&nbsp;</td>
    </tr>

    </table>

    
   
   
    
    
    <h2></h2>
    </div>

';

}

$dompdf = new Dompdf;
ob_start();
// require('payslip.php');
// $html = ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
ob_end_clean();
$dompdf->stream('payslip.pdf', ['Attachment' => 0]);



?>

