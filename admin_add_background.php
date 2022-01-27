<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['backgroundID'])) {
    $backgroundID = $_GET['backgroundID'];
    $backgroundName = $_GET['backgroundName'];
    $backgroundPicture = $_GET['backgroundPicture'];

    $query = "INSERT INTO NYHCBackground (backgroundID, backgroundName, backgroundPicture) 
    VALUES ('$backgroundID', '$backgroundName', '$backgroundPicture')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Add Background</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Add Background &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_add_background.php" method = "GET">

<center>
<table border="1" id = "css001">
<tr>
    <td>Background ID: </td>
    <td><input name="backgroundID" placeholder="Start From 5001" type="text" id = "t001"
value="<?php if(isset($_GET['backgroundID'])){ echo $backgroundID;}?>"></td></tr>

<tr>
    <td>Background Name: </td>
    <td><input name="backgroundName" placeholder="Background Name" type="text" id = "t001"
value="<?php if(isset($_GET['backgroundID'])){ echo $backgroundName;}?>"></td></tr>

<tr>
    <td>Background Picture </td>
    <td><input type = "file" name = "backgroundPicture" id = "t001"></td></tr>

<tr><td colspan="2"><input type="submit" value="Add Background" id = "t002"></td></tr>
</table>
                                                            
</form>