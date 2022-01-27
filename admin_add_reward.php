<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['rewardID'])) {
    $rewardID = $_GET['rewardID'];
    $rewardName = $_GET['rewardName'];
    $rewardStartDate = $_GET['rewardStartDate'];
    $rewardLastDate = $_GET['rewardLastDate'];
    $rewardCondition = $_GET['rewardCondition'];
    $rewardQuatity = $_GET['rewardQuatity'];
    $rewardStatus = $_GET['rewardStatus'];

    $query = "INSERT INTO NYHCReward 
    (rewardID, rewardName, rewardStartDate, rewardLastDate, rewardCondition, rewardQuatity, rewardStatus) 
    VALUES ('$rewardID', '$rewardName', 
    '$rewardStartDate', '$rewardLastDate', '$rewardCondition', '$rewardQuatity', '$rewardStatus')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Add Reward</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Add Reward &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_add_reward.php" method = "GET">
<center>
<table border="1" id = "css001">
<tr>
    <td>Reward ID: </td>
    <td><input name="rewardID" placeholder="Start From 2001" type="text" id = "t001"
value="<?php if(isset($_GET['rewardID'])){ echo $rewardID;}?>"></td></tr>

<tr>
    <td>Reward Name: </td>
    <td><input name="rewardName" placeholder="Reward Name" type="text" id = "t001"
value="<?php if(isset($_GET['rewardID'])){ echo $rewardName;}?>"></td></tr>

<tr>
    <td>Reward Start Date: </td>
    <td><input name="rewardStartDate" placeholder="Start Date" type="date" id = "t001"
    value = <?php echo date("Y-m-d");?>></td></tr>

<tr>
    <td>Reward Last Date: </td>
    <td><input name="rewardLastDate" placeholder="Last Date" type="date" id = "t001"
value="<?php if(isset($_GET['rewardID'])){ echo $rewardLastDate;}?>"></td></tr>

<tr>
    <td>Condition: </td>
    <td><select name="rewardCondition" id = "t001">
        <option value = "1">No Condition</option>
        <option value = "2">Play A Game Mode</option>
        <option value = "3">Earn or Use Point</option>
        <option value = "4">Improve Level</option>
    </select></td></tr>

<tr>
    <td>Reward Type: </td>
    <td><select name="rewardStatus" id = "t001">
        <option value = "1">Points</option>
        <option value = "2">Draw Ticket</option>
    </select></td></tr>

<tr>
    <td>Reward Quatity: </td>
    <td><input name="rewardQuatity" placeholder="Reward Quatity" type = "text" id = "t001"
value = "<?php if(isset($_GET['rewardID'])){ echo $rewardQuatity;}?>"></td></tr>


<tr><td colspan="2"><input type="submit" value="Add Reward" id = "t002"></td></tr>
</table>
                                                            
</form>