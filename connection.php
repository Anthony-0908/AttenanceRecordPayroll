<?php
 $conn = new mysqli('localhost' , 'root' , '', 'employeeandpayroll');

 if($conn == false) { 
    echo "error" . $conn->error;
    
 }
?>