<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query21 = "SELECT * FROM NYHCGameMode";
$result2 = $conn->query($query21);
$rows2 = $result2->num_rows;

for($j = 0, $noNumber = 1; $j < $rows2; ++$j, $noNumber++){
    $result2->data_seek($j);
    $GMID = $result2->fetch_assoc()['GMID'];
    $result2->data_seek($j);
    $GMName = $result2->fetch_assoc()['GMName'];
    $result2->data_seek($j);
    $GMCardNo = $result2->fetch_assoc()['GMCardNo'];
    $result2->data_seek($j);
    $GMLevel = $result2->fetch_assoc()['GMLevel'];
    $result2->data_seek($j);
    $GMPlayer = $result2->fetch_assoc()['GMPlayer'];
    $result2->data_seek($j);
    $GMPointLimit = $result2->fetch_assoc()['GMPointLimit'];
    $result2->data_seek($j);
    $GMDescription = $result2->fetch_assoc()['GMDescription'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Edit Game Mode</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Edit Game Mode &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_edit_game.php" method = "POST">
<center>
<table border="1" id = "css001">
<tr>
    <td>Game Mode ID: </td>
    <td><input name="GMID2" placeholder="Start From 1001" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMID;}?>"></td></tr>

<tr>
    <td>Game Mode Name: </td>
    <td><input name="GMName2" placeholder="Game Mode Name" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMName;}?>"></td></tr>

<tr>
    <td>Card Number: </td>
    <td><select name="GMCardNo2" id = "t001">
        <option value = "48">48</option>
        <option value = "52">52</option>
        <option value = "54">54</option>
    </select></td></tr>

<tr>
    <td>Level Limit: </td>
    <td><input name="GMLevel2" placeholder="Level" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMLevel;}?>"></td></tr>

<tr>
    <td>Number of Player: </td>
    <td><select name="GMPlayer2" id = "t001">
        <option value = "1">1</option>
        <option value = "2">2</option>
        <option value = "3">3</option>
        <option value = "4">4</option>
        <option value = "5">5</option>
    </select></td></tr>

<tr>
    <td>Point Limit: </td>
    <td><input name="GMPointLimit2" placeholder="Point Limit" type="text" id = "t001"
value="<?php if(isset($_GET['GMID'])){ echo $GMPointLimit;}?>"></td></tr>

<tr>
    <td>Link: </td>
    <td><input name="GMDescription2" placeholder="game_mode.php" type = "text" id = "t001"
value = "<?php if(isset($_GET['GMID'])){ echo $GMDescription;}?>"></td></tr>


<tr><td colspan="2"><input type="submit" name = "edit_game" value= "Edit Game Mode" id = "t002"></td></tr>
</table>
<?php

if (!empty($_POST["edit_game"])) {
    //$query1 = "UPDATE NYHCGameMode SET GMID = '{$_POST[GMID2]}' WHERE GMID = $GMID";
    $query2 = "UPDATE NYHCGameMode SET GMName = '{$_POST['GMName2']}' WHERE GMID = '{$_POST['GMID2']}'";
    $query3 = "UPDATE NYHCGameMode SET GMCardNo = '{$_POST['GMCardNo2']}' WHERE GMID = '{$_POST['GMID2']}'";
    $query4 = "UPDATE NYHCGameMode SET GMLevel = '{$_POST['GMLevel2']}' WHERE GMID = '{$_POST['GMID2']}'";
    $query5 = "UPDATE NYHCGameMode SET GMPlayer = '{$_POST['GMPlayer2']}' WHERE GMID = '{$_POST['GMID2']}'";
    $query6 = "UPDATE NYHCGameMode SET GMPointLimit = '{$_POST['GMPointLimit2']}' WHERE GMID = '{$_POST['GMID2']}'";
    $query7 = "UPDATE NYHCGameMode SET GMDescription = '{$_POST['GMDescription2']}' WHERE GMID = '{$_POST['GMID2']}'";

    //$result = $conn->query($query1);
    $result = $conn->query($query2);
    $result = $conn->query($query3);
    $result = $conn->query($query4);
    $result = $conn->query($query5);
    $result = $conn->query($query6);
    $result = $conn->query($query7);
    echo "<script>alert('You have edit game mode successfully!')</script>";
}

?>
                                                            
</form>