<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <title></title>
</head>
<body>
    <?php
    include('../connection.php');
    if(isset($_GET['add'])){
        $id = $_GET['edit_id'];
        $Sql = "SELECT * FROM attendance WHERE id ='$id'";
        $Run = mysqli_query($conn, $Sql);

        foreach($Run as $row){
            ?>

            <form actino="addTime.php" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                <label>Employee ID </label>
                <input type="text" name="edit_employee_id" readonly value="<?php echo $row['emp_id'];?>">
                <br>
                <label>Fullname</label>
                <input type="text" name="edit_fullname" readonly value="<?php echo $row['full_name'];?>">
                <br>
                <label for="">Attendance Date</label>
                <input type="text" name="edit_date" readonly value="<?php echo $row['attendance_date'];?>">
                <br>

                <label for="">Time in</label>
                <input type="text" name="edit_timeIn" readonly value="<?php echo $row['time_in'];?>">
                <br>
                <label for="">Time out</label>
                <input type="text" name="edit_timeOut" readonly value="<?php echo $row['time_out'];?>">
                <br>
                <label for="">Hours</label>
                <input type="text" name="edit_hours" readonly value="<?php echo $row['hours'];?>">
                <br>

                <div class="form-group mb-3">
                    <input type="checkbox" name="extrapay[]" value="overtime">
                    <
                </div>




                <input type="submit" name="add_time" value="Add Time">
            </form>

<?php
        }
    }

    ?>
    
</body>
</html>