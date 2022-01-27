<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query21 = "SELECT * FROM NYHCReward";
$result9 = $conn->query($query21);
$rows2 = $result9->num_rows;

for($j = 0, $noNumber = 1; $j < $rows2; ++$j, $noNumber++){
    $result9->data_seek($j);
    $rewardID = $result9->fetch_assoc()['rewardID'];
    $result9->data_seek($j);
    $rewardName = $result9->fetch_assoc()['rewardName'];
    $result9->data_seek($j);
    $rewardStartDate = $result9->fetch_assoc()['rewardStartDate'];
    $result9->data_seek($j);
    $rewardLastDate = $result9->fetch_assoc()['rewardLastDate'];
    $result9->data_seek($j);
    $rewardCondition = $result9->fetch_assoc()['rewardCondition'];
    $result9->data_seek($j);
    $rewardQuatity = $result9->fetch_assoc()['rewardQuatity'];
    $result9->data_seek($j);
    $rewardStatus = $result9->fetch_assoc()['rewardStatus'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Edit Reward</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Edit Reward &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_edit_reward.php" method = "POST">
<center>
<table border="1" id = "css001">
<tr>
    <td>Reward ID: </td>
    <td><input name="rewardID2" placeholder="Start From 2001" type="text" id = "t001"
value="<?php if(isset($_GET['rewardID'])){ echo $rewardID;}?>"></td></tr>

<tr>
    <td>Reward Name: </td>
    <td><input name="rewardName2" placeholder="Reward Name" type="text" id = "t001"
value="<?php if(isset($_GET['rewardID'])){ echo $rewardName;}?>"></td></tr>

<tr>
    <td>Reward Start Date: </td>
    <td><input name="rewardStartDate2" placeholder="Start Date" type="date" id = "t001"
    value = <?php echo date("Y-m-d");?>></td></tr>

<tr>
    <td>Reward Last Date: </td>
    <td><input name="rewardLastDate2" placeholder="Last Date" type="date" id = "t001"
value="<?php if(isset($_GET['rewardID'])){ echo $rewardLastDate;}?>"></td></tr>

<tr>
    <td>Condition: </td>
    <td><select name="rewardCondition2" id = "t001">
        <option value = "1">No Condition</option>
        <option value = "2">Play A Game Mode</option>
        <option value = "3">Earn or Use Point</option>
        <option value = "4">Improve Level</option>
    </select></td></tr>

    <tr>
    <td>Reward Type: </td>
    <td><select name="rewardStatus2" id = "t001">
        <option value = "1">Points</option>
        <option value = "2">Draw Ticket</option>
    </select></td></tr>

<tr>
    <td>Reward Quatity: </td>
    <td><input name="rewardQuatity2" placeholder="Reward Quatity" type = "text" id = "t001"
value = "<?php if(isset($_GET['rewardID'])){ echo $rewardQuatity;}?>"></td></tr>


<tr><td colspan="2"><input type="submit" name = "edit_reward" value= "Edit Reward" id = "t002"></td></tr>
</table>
<?php

if (!empty($_POST["edit_reward"])) {
    //$query1 = "UPDATE NYHCReward SET rewardID = '{$_POST[rewardID2]}' WHERE rewardID = $rewardID";
    $query2 = "UPDATE NYHCReward SET rewardName = '{$_POST['rewardName2']}' WHERE rewardID = '{$_POST['rewardID2']}'";
    $query3 = "UPDATE NYHCReward SET rewardStartDate = '{$_POST['rewardStartDate2']}' WHERE rewardID = '{$_POST['rewardID2']}'";
    $query4 = "UPDATE NYHCReward SET rewardLastDate = '{$_POST['rewardLastDate2']}' WHERE rewardID = '{$_POST['rewardID2']}'";
    $query5 = "UPDATE NYHCReward SET rewardCondition = '{$_POST['rewardCondition2']}' WHERE rewardID = '{$_POST['rewardID2']}'";
    $query6 = "UPDATE NYHCReward SET rewardQuatity = '{$_POST['rewardQuatity2']}' WHERE rewardID = '{$_POST['rewardID2']}'";
    $query7 = "UPDATE NYHCReward SET rewardStatus = '{$_POST['rewardStatus2']}' WHERE rewardID = '{$_POST['rewardID2']}'";

    //$result = $conn->query($query1);
    $result = $conn->query($query2);
    $result = $conn->query($query3);
    $result = $conn->query($query4);
    $result = $conn->query($query5);
    $result = $conn->query($query6);
    $result = $conn->query($query7);
    echo "<script>alert('You have edit reward successfully!')</script>";
}

?>
                                                            
</form>