<?php
require('admin_view_item.php');
$pointID = $_REQUEST['pointID'];
$query = "DELETE FROM NYHCPointRedemption WHERE pointID = $pointID"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("location: admin_view_item.php");
?>