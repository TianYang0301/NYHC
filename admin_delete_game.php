<?php
require('admin_view_item.php');
$GMID = $_REQUEST['GMID'];
$query = "DELETE FROM NYHCGameMode WHERE GMID = $GMID"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("location: admin_view_item.php");
?>