<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query_point = "SELECT * FROM NYHCPointRedemption";
$result_point = $conn->query($query_point);
$rows_point = $result_point->num_rows;

for($j = 0, $noNumber = 1; $j < $rows_point; ++$j, $noNumber++){
    $result_point->data_seek($j);
    $pointID = $result_point->fetch_assoc()['pointID'];
    $result_point->data_seek($j);
    $pointName = $result_point->fetch_assoc()['pointName'];
    $result_point->data_seek($j);
    $pointStartDate = $result_point->fetch_assoc()['pointStartDate'];
    $result_point->data_seek($j);
    $pointLastDate = $result_point->fetch_assoc()['pointLastDate'];
    $result_point->data_seek($j);
    $pointCondition = $result_point->fetch_assoc()['pointCondition'];
    $result_point->data_seek($j);
    $unlockType = $result_point->fetch_assoc()['unlockType'];
    $result_point->data_seek($j);
    $pointQuatity = $result_point->fetch_assoc()['pointQuatity'];
    $result_point->data_seek($j);
    $pointLink = $result_point->fetch_assoc()['pointLink'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Edit Point Redemption</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Edit Point Redemption &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_edit_point.php" method = "POST">
<center>
<table border="1" id = "css001">
<tr>
    <td>Point Rdemption ID: </td>
    <td><input name="pointID2" placeholder="Start From 3001" type="text" id = "t001"
value="<?php if(isset($_GET['pointID'])){ echo $pointID;}?>"></td></tr>

<tr>
    <td>Point Redemption Name: </td>
    <td><input name="pointName2" placeholder="Point Redemption Name" type="text" id = "t001"
value="<?php if(isset($_GET['pointID'])){ echo $pointName;}?>"></td></tr>

<tr>
    <td>Point Redemption Start Date: </td>
    <td><input name="pointStartDate2" type="date" id = "t001" value = <?php echo date("Y-m-d");?>></td></tr>

<tr>
    <td>Point Redemption Last Date: </td>
    <td><input name="pointLastDate2" type="date" id = "t001" 
    value="<?php if(isset($_GET['pointID'])){ echo $pointLastDate;}?>"></td></tr>

<tr>
    <td>Condition: </td>
    <td><select name="pointCondition2" id = "t001">
        <option value = "1">No Level Limit</option>
        <option value = "2">Level 5 to 9</option>
        <option value = "3">Level 10 to 19</option>
        <option value = "4">Level 20 above</option>
    </select></td></tr>

<tr>
    <td>Unlock Type: </td>
    <td><select name="unlockType2" id = "t001">
        <option value = "1">Game Mode</option>
        <option value = "2">Background</option>
        <option value = "3">Card Style</option>
        <option value = "4">Draw Ticket</option>
    </select></td></tr>

<tr>
    <td>Point Quatity: </td>
    <td><input name="pointQuatity2" placeholder="Quatity" type="text" id = "t001"
value="<?php if(isset($_GET['pointID'])){ echo $pointQuatity;}?>"></td></tr>

<tr>
    <td>Link: </td>
    <td><input name="pointLink2" placeholder="point_redemption.php" type = "text" id = "t001"
value = "<?php if(isset($_GET['pointID'])){ echo $pointLink;}?>"></td></tr>


<tr><td colspan="2"><input type="submit" name = "edit_point" value="Edit Point Redemption" id = "t002"></td></tr>
</table>
            
<?php

if (!empty($_POST["edit_point"])) {
    //$query1 = "UPDATE NYHCPointRedemption SET pointID = '{$_POST[pointID2]}' WHERE pointID = $pointID";
    $query2 = "UPDATE NYHCPointRedemption SET pointName = '{$_POST['pointName2']}' WHERE pointID = '{$_POST['pointID2']}'";
    $query3 = "UPDATE NYHCPointRedemption SET pointStartDate = '{$_POST['pointStartDate2']}' WHERE pointID = '{$_POST['pointID2']}'";
    $query4 = "UPDATE NYHCPointRedemption SET pointLastDate = '{$_POST['pointLastDate2']}' WHERE pointID = '{$_POST['pointID2']}'";
    $query5 = "UPDATE NYHCPointRedemption SET pointCondition = '{$_POST['pointCondition2']}' WHERE pointID = '{$_POST['pointID2']}'";
    $query6 = "UPDATE NYHCPointRedemption SET unlockType = '{$_POST['unlockType2']}' WHERE pointID = '{$_POST['pointID2']}'";
    $query7 = "UPDATE NYHCPointRedemption SET pointQuatity = '{$_POST['pointQuatity2']}' WHERE pointID = '{$_POST['pointID2']}'";
    $query8 = "UPDATE NYHCPointRedemption SET pointLink = '{$_POST['pointLink2']}' WHERE pointID = '{$_POST['pointID2']}'";

    //$result = $conn->query($query1);
    $result = $conn->query($query2);
    $result = $conn->query($query3);
    $result = $conn->query($query4);
    $result = $conn->query($query5);
    $result = $conn->query($query6);
    $result = $conn->query($query7);
    $result = $conn->query($query8);
    echo "<script>alert('You have edit point redemption successfully!')</script>";
}

?>

</form>