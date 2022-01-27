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

$query = "SELECT * FROM NYHCUser";
$result = $conn->query($query);
$rows = $result->num_rows;

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
	  $result->data_seek($j);
    $userID = $result->fetch_assoc()['userID'];
    $result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
}

$query3 = "SELECT * FROM GAMESETTING";
$result3 = $conn->query($query3);
$rows3 = $result3->num_rows;

for($j = 0, $noNumber = 1; $j < $rows3; ++$j, $noNumber++){
  $result3->data_seek($j);
  $settingsID = $result3->fetch_assoc()['settingsID'];
  $result3->data_seek($j);
  $GameRGB = $result3->fetch_assoc()['GameRGB'];
  $result3->data_seek($j);
  $GameFont = $result3->fetch_assoc()['GameFont'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Add Game Mode</title>
    <link rel="stylesheet" href="gameUI.css">
</head>
<style>
    body {
                background-image: url('./Picture/background/<?php echo $userBackground;?>');
                color: <?php echo $GameRGB;?>;
                font-family: <?php echo $GameFont;?>;
            }
            p {
                color: <?php echo $GameRGB;?>;
                font-family: <?php echo $GameFont;?>;
            }
            #game_table{
                color: <?php echo $GameRGB;?>;
                font-family: <?php echo $GameFont;?>;
            }
            #t001{
                color: <?php echo $GameRGB;?>;
                font-family: <?php echo $GameFont;?>;
            }
            #game_button1{
                color: <?php echo $GameRGB;?>;
                font-family: <?php echo $GameFont;?>;
            }
</style>
<body>

<p>Add Background (Only One Time!)</p>

<form action = "redemption_background.php" method = "GET">

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

<tr><td colspan = "2" align = "center"><input type="submit" value="Add Background" id = "t001"></td></tr>
<tr><td colspan = "2" align = "center"><a href="game_point.php"><input type="button" value="Back" id = "game_button1"></a></td></tr>

</table>

</form>