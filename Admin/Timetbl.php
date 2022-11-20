<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Attendnace</title>
</head>
<body>
<table id="example" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Fullname</th>
            <th>Attendance Date</th>
            <th>Time in </th>
            <th>Time out</th>
            <th>Overtime</th>
            <th>Holiday</th>
            <th>Holiday Overtime</th>
            <th>Action </th>
        </tr>
        </thead>
        <tbody>
            <?php
                include('../connection.php');
                $Querytable = "SELECT * FROM attendance";
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
                            <?php echo $Row['hours'];?>
                        </td>
                        
                        <td>
                            <?php echo $Row['overtime'];?>
                        </td>

                        <td>
                            <?php echo $Row['holiday'];?>
                        </td>

                        <td>
                            <?php echo $Row['holiday_overtime'];?>
                        </td>
                        <td>
                            
                        </td>

                        <td>
                            


                        </td>

                        <td>
                            <form action="deleteEmployee.php" method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $Row['id']?>"> 
                                <button type="submit" name="delete_employee">Delete Employee</button>
                            </form>
                        </td>
                    </tr>

                    <?php
                }

            ?>
        </tbody>
        
    </table>
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