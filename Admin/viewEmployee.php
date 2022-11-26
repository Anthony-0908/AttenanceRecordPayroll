<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.css"> -->
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title>Employee Table </title>
</head>

<?php include('includes/navbar.php');?>

<body>
   
    
    <div class="container" style="margin-top:20px;">
    <a href="createEmployee.php" class="btn btn-primary mb-4">Add Employee</a>
    <table id="example" class="table table-striped " style="width:100%;  ">
        <thead>
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Position</th>
            <th>Hour rate</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Payroll</th>
            <th>Payslip</th>
        </tr>
        </thead>
        <tbody>
            <?php
                include('../connection.php');
                $Querytable = "SELECT * FROM employee_tbl";
                $Queryrun = mysqli_query($conn, $Querytable);

                while($Row = mysqli_fetch_assoc($Queryrun)){
                    ?>

                    <tr>
                        <td>
                            <?php echo $Row['id']?>
                        </td>
                        <td>
                            <?php echo $Row['Emp_id'];?>
                        </td>
                        <td>
                            <?php echo $Row['Position'];?>
                        </td>
                        <td><?php echo $Row['hour_rate']?></td>
                        <td>
                            <?php echo $Row['Firstname']?>
                        </td>
                        <td>
                            <?php echo $Row['Lastname']?>
                        </td>

                        <td>
                            <form action="editEmployee.php" method="POST">
                                <input type="hidden" name="edit_id" value="<?php echo $Row['id']?>">
                                <button type="submit" class="btn btn-success" name="edit_employee">Edit Employee</button>
                            </form>
                        </td>

                        <td>
                            <form action="deleteEmployee.php" method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $Row['id']?>"> 
                                <button type="submit" class="btn btn-danger" name="delete_employee">Delete Employee</button>
                            </form>
                        </td>

                        <td>
                            <a class="btn btn-outline-dark" href="pay.php?id=<?php echo $Row['Emp_id'];?>">Payroll</a>
                        </td>

                        <td>
                            <a class="btn btn-outline-primary" href="generatepayslip.php?payroll_id=<?php echo $Row['Emp_id'];?>">Payslip</a>
                    </td>
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