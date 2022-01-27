<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query_bg = "SELECT * FROM NYHCCard";
$result_bg = $conn->query($query_bg);
$rows_bg = $result_bg->num_rows;

for($j = 0, $noNumber = 1; $j < $rows_bg; ++$j, $noNumber++){
    $result_bg->data_seek($j);
    $cardID = $result_bg->fetch_assoc()['cardID'];
    $result_bg->data_seek($j);
    $cardName = $result_bg->fetch_assoc()['cardName'];
    $result_bg->data_seek($j);
    $cardPicture = $result_bg->fetch_assoc()['cardPicture'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Edit Card Style</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Edit Card Style &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_edit_card.php" method = "POST">

<center>
<table border="1" id = "css001">
<tr>
    <td>Card Style ID: </td>
    <td><input name="cardID2" placeholder="Start From 4001" type="text" id = "t001"
value="<?php if(isset($_GET['cardID'])){ echo $cardID;}?>"></td></tr>

<tr>
    <td>Card Style Name: </td>
    <td><input name="cardName2" placeholder="Card Style Name" type="text" id = "t001"
value="<?php if(isset($_GET['cardID'])){ echo $cardName;}?>"></td></tr>

<tr>
    <td>Card Style Picture </td>
    <td><input type = "text" name = "cardPicture2" id = "t001" placeholder = "Directory"
value = "<?php if(isset($_GET['cardID'])){ echo $cardPicture;}?>"></td></tr>

<tr><td colspan="2"><input type="submit" name = "edit_card" value="Edit Card Style" id = "t002"></td></tr>
</table>
      
<?php

if (!empty($_POST["edit_card"])) {
    $query2 = "UPDATE NYHCCard SET cardName = '{$_POST['cardName2']}' WHERE cardID = '{$_POST['cardID2']}'";
    $query3 = "UPDATE NYHCCard SET cardPicture = '{$_POST['cardPicture2']}' WHERE cardID = '{$_POST['cardID2']}'";

    //$result = $conn->query($query1);
    $result = $conn->query($query2);
    $result = $conn->query($query3);
    echo "<script>alert('You have edit card style successfully!')</script>";
}

?>

</form>