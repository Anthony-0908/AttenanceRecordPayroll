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
<body>
    <a href="Timetbl.php">Attendance</a>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Employee ID</th>
            <th>Position</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Edit</th>
            <th>Delete</th>
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
                        <td>
                            <?php echo $Row['Firstname']?>
                        </td>
                        <td>
                            <?php echo $Row['Lastname']?>
                        </td>

                        <td>
                            <form action="editEmployee.php" method="POST">
                                <input type="hidden" name="edit_id" value="<?php echo $Row['id']?>">
                                <button type="submit" name="edit_employee">Edit Employee</button>
                            </form>
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