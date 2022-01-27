<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query_bg = "SELECT * FROM NYHCBackground";
$result_bg = $conn->query($query_bg);
$rows_bg = $result_bg->num_rows;

for($j = 0, $noNumber = 1; $j < $rows_bg; ++$j, $noNumber++){
    $result_bg->data_seek($j);
    $backgroundID = $result_bg->fetch_assoc()['backgroundID'];
    $result_bg->data_seek($j);
    $backgroundName = $result_bg->fetch_assoc()['backgroundName'];
    $result_bg->data_seek($j);
    $backgroundPicture = $result_bg->fetch_assoc()['backgroundPicture'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Edit Background</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>

<p>Edit Background &nbsp;<a href="admin_Page.php"><input type="button" value="Back->" id = "backButton"></a></p>

<form action = "admin_edit_background.php" method = "POST">

<center>
<table border="1" id = "css001">
<tr>
    <td>Background ID: </td>
    <td><input name="backgroundID2" placeholder="Start From 5001" type="text" id = "t001"
value="<?php if(isset($_GET['backgroundID'])){ echo $backgroundID;}?>"></td></tr>

<tr>
    <td>Background Name: </td>
    <td><input name="backgroundName2" placeholder="Background Name" type="text" id = "t001"
value="<?php if(isset($_GET['backgroundID'])){ echo $backgroundName;}?>"></td></tr>

<tr>
    <td>Background Picture </td>
    <td><input type = "file" name = "backgroundPicture2" id = "t001"></td></tr>

<tr><td colspan="2"><input type="submit" name = "edit_background" value="Edit Background" id = "t002"></td></tr>
</table>
      
<?php

if (!empty($_POST["edit_background"])) {
    //$query1 = "UPDATE NYHCBackground SET backgroundID = '{$_POST[backgroundID2]}' WHERE backgroundID = $backgroundID";
    $query2 = "UPDATE NYHCBackground SET backgroundName = '{$_POST['backgroundName2']}' WHERE backgroundID = '{$_POST['backgroundID2']}'";
    $query3 = "UPDATE NYHCBackground SET backgroundPicture = '{$_POST['backgroundPicture2']}' WHERE backgroundID = '{$_POST['backgroundID2']}'";

    //$result = $conn->query($query1);
    $result = $conn->query($query2);
    $result = $conn->query($query3);
    echo "<script>alert('You have edit background successfully!')</script>";
}

?>

</form>