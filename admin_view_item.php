<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
require_once('login.php');
//require('db.php');
//include("auth.php");

$query_game = "SELECT * FROM NYHCGameMode";
$query_reward = "SELECT * FROM NYHCReward";
$query_point = "SELECT * FROM NYHCPointRedemption";
$query_bg = "SELECT * FROM NYHCBackground";
$result_game = $conn->query($query_game);
$result_reward = $conn->query($query_reward);
$result_point = $conn->query($query_point);
$result_bg = $conn->query($query_bg);
$rows_game = $result_game->num_rows;
$rows_reward = $result_reward->num_rows;
$rows_point = $result_point->num_rows;
$rows_bg = $result_bg->num_rows;

?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Edit Game Mode</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>
<center><img src="Picture/NYHC_logo.png" width = "960" height = "270">
<p>Admin View Item &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_view_item.php" method = "POST">
<center>
<table border="1" id = "game_table2">
    

<div class="form">
<thead>
<tr><td colspan="11">Game Mode List</td></tr>
    <tr>
        <th><strong>No.</strong></th>
        <th><strong>ID</strong></th>
        <th colspan = "2"><strong>Name</strong></th>
        <th><strong>Card Number</strong></th>
        <th><strong>Level</strong></th>
        <th><strong>No. of Player</strong></th>
        <th><strong>Point Limit</strong></th>
        <th><strong>Link</strong></th>
        <th><strong>Edit</strong></th>
        <th><strong>Delete</strong></th>
    </tr>
</thead>
<tbody>
<?php
$count = 1;
$sel_query = "SELECT * FROM NYHCGameMode";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
    <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row["GMID"]; ?></td>
    <td align="center" colspan = "2"><?php echo $row["GMName"]; ?></td>
    <td align="center"><?php echo $row["GMCardNo"]; ?></td>
    <td align="center"><?php echo $row["GMLevel"]; ?></td>
    <td align="center"><?php echo $row["GMPlayer"]; ?></td>
    <td align="center"><?php echo $row["GMPointLimit"]; ?></td>
    <td align="center"><?php echo $row["GMDescription"]; ?></td>
    <td align="center">
    <a href="admin_edit_game.php?GMID=<?php echo $row["GMID"]; ?>">Edit</a>
</td>
<td align="center">
    <a href="admin_delete_game.php?GMID=<?php echo $row["GMID"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</div>


<div class="form">
<thead>
<tr><td colspan="11">-------------------------</td></tr>
<tr><td colspan="11">Reward List</td></tr>
    <tr>
        <th><strong>No.</strong></th>
        <th><strong>ID</strong></th>
        <th colspan = "2"><strong>Name</strong></th>
        <th><strong>Start Date</strong></th>
        <th><strong>Last Date</strong></th>
        <th><strong>Condition</strong></th>
        <th><strong>Quatity</strong></th>
        <th><strong>Type</strong></th>
        <th><strong>Edit</strong></th>
        <th><strong>Delete</strong></th>
    </tr>
</thead>
<tbody>
<?php
$count = 1;
$sel_query2 = "SELECT * FROM NYHCReward";
$result = mysqli_query($conn,$sel_query2);
while($row = mysqli_fetch_assoc($result)) { ?>
    <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row["rewardID"]; ?></td>
    <td align="center" colspan = "2"><?php echo $row["rewardName"]; ?></td>
    <td align="center"><?php echo $row["rewardStartDate"]; ?></td>
    <td align="center"><?php echo $row["rewardLastDate"]; ?></td>
    <td align="center"><?php echo $row["rewardCondition"]; ?></td>
    <td align="center"><?php echo $row["rewardQuatity"]; ?></td>
    <td align="center"><?php echo $row["rewardStatus"]; ?></td>
    <td align="center">
    <a href="admin_edit_reward.php?rewardID=<?php echo $row["rewardID"]; ?>">Edit</a>
</td>
<td align="center">
    <a href="admin_delete_reward.php?rewardID=<?php echo $row["rewardID"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</div>


<div class="form">
<thead>
<tr><td colspan="11">----------------------</td></tr>
<tr><td colspan="11">Point Redemption List</td></tr>
    <tr>
        <th><strong>No.</strong></th>
        <th><strong>ID</strong></th>
        <th><strong>Name</strong></th>
        <th><strong>Start Date</strong></th>
        <th><strong>Last Date</strong></th>
        <th><strong>Condition</strong></th>
        <th><strong>Unlock Type</strong></th>
        <th><strong>Quatity</strong></th>
        <th><strong>Link</strong></th>
        <th><strong>Edit</strong></th>
        <th><strong>Delete</strong></th>
    </tr>
</thead>
<tbody>
<?php
$count = 1;
$sel_query2 = "SELECT * FROM NYHCPointRedemption";
$result = mysqli_query($conn,$sel_query2);
while($row = mysqli_fetch_assoc($result)) { ?>
    <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><?php echo $row["pointID"]; ?></td>
    <td align="center"><?php echo $row["pointName"]; ?></td>
    <td align="center"><?php echo $row["pointStartDate"]; ?></td>
    <td align="center"><?php echo $row["pointLastDate"]; ?></td>
    <td align="center"><?php echo $row["pointCondition"]; ?></td>
    <td align="center"><?php echo $row["unlockType"]; ?></td>
    <td align="center"><?php echo $row["pointQuatity"]; ?></td>
    <td align="center"><?php echo $row["pointLink"]; ?></td>
    <td align="center">
    <a href="admin_edit_point.php?pointID=<?php echo $row["pointID"]; ?>">Edit</a>
</td>
<td align="center">
    <a href="admin_delete_point.php?pointID=<?php echo $row["pointID"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</div>

<div class="form">
<thead>
<tr><td colspan="11">-------------------------</td></tr>
<tr><td colspan="11">Background List</td></tr>
    <tr>
        <th><strong>No.</strong></th>
        <th><strong>Image</strong></th>
        <th><strong>ID</strong></th>
        <th colspan = "3"><strong>Name</strong></th>
        <th colspan = "3"><strong>Link</strong></th>
        <th><strong>Edit</strong></th>
        <th><strong>Delete</strong></th>
    </tr>
</thead>
<tbody>
<?php
$count = 1;
$sel_query2 = "SELECT * FROM NYHCBackground";
$result = mysqli_query($conn,$sel_query2);
while($row = mysqli_fetch_assoc($result)) { ?>
    <tr><td align="center"><?php echo $count; ?></td>
    <td align="center"><img src = './Picture/background/<?php echo $row['backgroundPicture']; ?>' width = 50 height = 50></td>
    <td align="center"><?php echo $row["backgroundID"]; ?></td>
    <td align="center" colspan = "3"><?php echo $row["backgroundName"]; ?></td>
    <td align="center" colspan = "3"><?php echo $row["backgroundPicture"]; ?></td>
    
    <td align="center">
    <a href="admin_edit_background.php?backgroundID=<?php echo $row["backgroundID"]; ?>">Edit</a>
</td>
<td align="center">
    <a href="admin_delete_background.php?backgroundID=<?php echo $row["backgroundID"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</div>


<div class="form">
<thead>
<tr><td colspan="11">-------------------------</td></tr>
<tr><td colspan="11">Card Style List</td></tr>
    <tr>
        <th><strong>No.</strong></th>
        <th colspan = "4"><strong>Image</strong></th>
        <th><strong>ID</strong></th>
        <th colspan = "2"><strong>Name</strong></th>
        <th><strong>Folder</strong></th>
        <th><strong>Edit</strong></th>
        <th><strong>Delete</strong></th>
    </tr>
</thead>
<tbody>
<?php
$count = 1;
$sel_query2 = "SELECT * FROM NYHCCard";
$result = mysqli_query($conn,$sel_query2);
while($row = mysqli_fetch_assoc($result)) { ?>
    <tr><td align="center"><?php echo $count; ?></td>
    <td align="center" colspan = "2"><img src = './Picture/<?php echo $row['cardPicture']; ?>/01-00.png' width = 90 height = 160></td>
    <td align="center" colspan = "2"><img src = './Picture/<?php echo $row['cardPicture']; ?>/01-01.png' width = 90 height = 160></td>
    <td align="center"><?php echo $row["cardID"]; ?></td>
    <td align="center" colspan = "2"><?php echo $row["cardName"]; ?></td>
    <td align="center"><?php echo $row["cardPicture"]; ?></td>
    
    <td align="center">
    <a href="admin_edit_card.php?cardID=<?php echo $row["cardID"]; ?>">Edit</a>
</td>
<td align="center">
    <a href="admin_delete_card.php?cardID=<?php echo $row["cardID"]; ?>">Delete</a>
</td>
</tr>
<?php $count++; } ?>
</tbody>
</div>

</table>
                                                            
</form>