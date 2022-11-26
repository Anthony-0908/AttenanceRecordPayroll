<?php
session_start();
if(isset($_SESSION['username'])){
    header("localhost:index.php?action=login");
}


?>

<!-- navbar side -->
     <?php include('includes/navbar.php');?>
    

    <?php include('Timetbl.php');?>
    <!-- Core Scripts - Include with every page -->
	<script src="asset/plugins/jquery-1.10.2.js"></script>
    <script src="asset/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="asset/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="asset/plugins/pace/pace.js"></script>
    <!-- Page-Level Plugin Scripts-->

</body>

</html>
