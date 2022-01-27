<?php
require('admin_view_item.php');
$cardID = $_REQUEST['cardID'];
$query = "DELETE FROM NYHCCard WHERE cardID = $cardID"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("location: admin_view_item.php");
?>