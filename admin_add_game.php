<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['GMID'])) {
    $GMID = $_GET['GMID'];
    $GMName = $_GET['GMName'];
    $GMCardNo = $_GET['GMCardNo'];
    $GMLevel = $_GET['GMLevel'];
    $GMPlayer = $_GET['GMPlayer'];
    $GMPointLimit = $_GET['GMPointLimit'];
    $GMDescription = $_GET['GMDescription'];

    $query = "INSERT INTO NYHCGameMode (GMID, GMName, GMCardNo, GMLevel, GMPlayer, GMPointLimit, GMDescription) 
    VALUES ('$GMID', '$GMName', '$GMCardNo', '$GMLevel', '$GMPlayer', '$GMPointLimit', '$GMDescription')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Add Game Mode</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Add Game Mode &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_add_game.php" method = "GET">
<center>
<table border="1" id = "css001">
<tr>
    <td>Game Mode ID: </td>
    <td><input name="GMID" placeholder="Start From 1001" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMID;}?>"></td></tr>

<tr>
    <td>Game Mode Name: </td>
    <td><input name="GMName" placeholder="Game Mode Name" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMName;}?>"></td></tr>

<tr>
    <td>Card Number: </td>
    <td><select name="GMCardNo" id = "t001">
        <option value = "48">48</option>
        <option value = "52">52</option>
        <option value = "54">54</option>
    </select></td></tr>

<tr>
    <td>Level Limit: </td>
    <td><input name="GMLevel" placeholder="Level" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMLevel;}?>"></td></tr>

<tr>
    <td>Number of Player: </td>
    <td><select name="GMPlayer" id = "t001">
        <option value = "1">1</option>
        <option value = "2">2</option>
        <option value = "3">3</option>
        <option value = "4">4</option>
        <option value = "5">5</option>
    </select></td></tr>

<tr>
    <td>Point Limit: </td>
    <td><input name="GMPointLimit" placeholder="Point Limit" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMPointLimit;}?>"></td></tr>

<tr>
    <td>Link: </td>
    <td><input name="GMDescription" placeholder="game_mode.php" type = "text" id = "t001"
value = "<?php if(isset($_GET['GMID'])){ echo $GMDescription;}?>"></td></tr>


<tr><td colspan="2"><input type="submit" value="Add Game Mode" id = "t002"></td></tr>
</table>
                                                            
</form>