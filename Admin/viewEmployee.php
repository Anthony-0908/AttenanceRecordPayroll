<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
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
    
</body>
</html>