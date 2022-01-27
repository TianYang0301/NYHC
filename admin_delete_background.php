<?php
require('admin_view_item.php');
$backgroundID = $_REQUEST['backgroundID'];
$query = "DELETE FROM NYHCBackground WHERE backgroundID = $backgroundID"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("location: admin_view_item.php");
?>