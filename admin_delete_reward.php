<?php
require('admin_view_item.php');
$rewardID = $_REQUEST['rewardID'];
$query = "DELETE FROM NYHCReward WHERE rewardID = $rewardID"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("location: admin_view_item.php");
?>