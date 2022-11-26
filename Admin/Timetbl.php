<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title>Time Attendnace</title>
</head>
<body>
    <div class="container" style="margin-top:100px;">
    <table id="example" class="table  table-striped" style="width:100%; margin-top:200px">
        <thead class="bg-light">
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Fullname</th>
            <th>Attendance Date</th>
            <th>Time in </th>
            <th>Time out</th>
            <th>Hours</th>
            <th>Overtime</th>
            <th>Hours worked</th>
        </tr>
        </thead>
        <tbody>
            <?php
                include('../connection.php');
                $Querytable = "SELECT * FROM attendance LEFT JOIN overtime ON attendance.emp_id = overtime.emp_id;";
                $Queryrun = mysqli_query($conn, $Querytable);

                while($Row = mysqli_fetch_assoc($Queryrun)){
                    ?>

                    <tr>
                        <td>
                            <?php echo $Row['id']?>
                        </td>
                        <td>
                            <?php echo $Row['emp_id'];?>
                        </td>
                        <td>
                            <?php echo $Row['full_name'];?>
                        </td>
                        <td>
                            <?php echo $Row['attendance_date'];?>
                        </td>
                        <td>
                            <?php echo $Row['time_in']?>
                        </td>
                        <td>
                            <?php echo $Row['time_out']?>
                        </td>

                        <td>
                            <?php echo number_format($Row['hours'],2)?>
                        </td>

                        <td>
                            <?php echo $Row['overtime'];?>
                        </td>

                        <td><?php echo number_format($Row['hrs_worked'],2);?></td>
                        
                       
                    </tr>

                    <?php
                }

            ?>
        </tbody>
        
    </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    
    
    
    
    <script>

    $(document).ready(function () {
        $('#example').DataTable();
    });
    </script>
</body>
</html>
</body>
</html>