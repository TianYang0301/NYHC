<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['pointID'])) {
    $pointID = $_GET['pointID'];
    $pointName = $_GET['pointName'];
    $pointStartDate = $_GET['pointStartDate'];
    $pointLastDate = $_GET['pointLastDate'];
    $pointCondition = $_GET['pointCondition'];
    $unlockType = $_GET['unlockType'];
    $pointQuatity = $_GET['pointQuatity'];
    $pointLink = $_GET['pointLink'];

    $query = "INSERT INTO NYHCPointRedemption
     (pointID, pointName, pointStartDate, pointLastDate, pointCondition, unlockType, pointQuatity, pointLink) 
    VALUES ('$pointID', '$pointName', '$pointStartDate', '$pointLastDate', '$pointCondition', '$unlockType', '$pointQuatity', '$pointLink')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Add Point Redemption</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Add Point Redemption &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_add_point.php" method = "GET">
<center>
<table border="1" id = "css001">
<tr>
    <td>Point Redemption ID: </td>
    <td><input name="pointID" placeholder="Start From 3001" type="text" id = "t001"
value="<?php if(isset($_GET['pointID'])){ echo $pointID;}?>"></td></tr>

<tr>
    <td>Point Redemption Name: </td>
    <td><input name="pointName" placeholder="Point Redemption Name" type="text" id = "t001"
value="<?php if(isset($_GET['pointID'])){ echo $pointName;}?>"></td></tr>

<tr>
    <td>Point Redemption Start Date: </td>
    <td><input name="pointStartDate" type="date" id = "t001" value = <?php echo date("Y-m-d");?>></td></tr>

<tr>
    <td>Point Redemption Last Date: </td>
    <td><input name="pointLastDate" type="date" id = "t001"></td></tr>

<tr>
    <td>Condition: </td>
    <td><select name="pointCondition" id = "t001">
        <option value = "1">No Level Limit</option>
        <option value = "2">Level 5 and above</option>
        <option value = "3">Level 10 and above</option>
        <option value = "4">Level 20 and above</option>
    </select></td></tr>

<tr>
    <td>Unlock Type: </td>
    <td><select name="unlockType" id = "t001">
        <option value = "1">Game Mode</option>
        <option value = "2">Background</option>
        <option value = "3">Card Style</option>
        <option value = "4">Draw Ticket</option>
    </select></td></tr>

<tr>
    <td>Point Quatity: </td>
    <td><input name="pointQuatity" placeholder="Quatity" type="text" id = "t001"
value="<?php if(isset($_GET['pointID'])){ echo $pointQuatity;}?>"></td></tr>

<tr>
    <td>Link: </td>
    <td><input name="pointLink" placeholder="point_redemption.php" type = "text" id = "t001"
value = "<?php if(isset($_GET['pointID'])){ echo $pointLink;}?>"></td></tr>


<tr><td colspan="2"><input type="submit" value="Add Point Redemption" id = "t002"></td></tr>
</table>
                                                            
</form>