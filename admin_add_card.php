<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['cardID'])) {
    $cardID = $_GET['cardID'];
    $cardName = $_GET['cardName'];
    $cardPicture = $_GET['cardPicture'];

    $query = "INSERT INTO NYHCCard (cardID, cardName, cardPicture) VALUES ('$cardID', '$cardName', '$cardPicture')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Add Card Style</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Add Card Style &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_add_card.php" method = "GET">

<center>
<table border="1" id = "css001">
<tr>
    <td>Card ID: </td>
    <td><input name="cardID" placeholder="Start From 4001" type="text" id = "t001"
value="<?php if(isset($_GET['cardID'])){ echo $cardID;}?>"></td></tr>

<tr>
    <td>Card Name: </td>
    <td><input name="cardName" placeholder="Card Name" type="text" id = "t001"
value="<?php if(isset($_GET['cardID'])){ echo $cardName;}?>"></td></tr>

<tr>
    <td>Card Picture </td>
    <td><input type = "text" name = "cardPicture" id = "t001" placeholder = "Directory"
    value = "<?php if(isset($_GET['cardID'])){ echo $cardPicture;}?>"></td></tr>

<tr>
    <td>Find the Directory </td>
    <td><input type = "file" name = "cardDirectory" id = "t001"></td></tr>

<tr><td colspan="2"><input type="submit" value="Add Card Style" id = "t002"></td></tr>
</table>
                                                            
</form>