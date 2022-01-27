<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['userImgID'])) {
    $userImgID = $_GET['userImgID'];
    $userImgName = $_GET['userImgName'];
    $userImgPicture = $_GET['userImgPicture'];

    $query = "INSERT INTO NYHCUserImg (userImgID, userImgName, userImgPicture) 
    VALUES ('$userImgID', '$userImgName', '$userImgPicture')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}

$query = "SELECT * FROM NYHCUser";
$query1 = "SELECT * FROM NYHCBackground";
$result = $conn->query($query);
$result2 = $conn->query($query1);
$rows = $result->num_rows;

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
	$result->data_seek($j);
    $userID = $result->fetch_assoc()['userID'];
    $result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
    $result->data_seek($j);
    $userImg = $result->fetch_assoc()['userImg'];
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
	<title>NYHC | Add User Image</title>
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

<p>Add User Image &nbsp;<a href="user_img_change.php"><input type="button" value="Back->" id = "game_button1"></a></p>

<form action = "add_user_img.php" method = "GET">

<center>
<table border="1" id = "game_table">
<tr>
    <td>User Image ID: </td>
    <td><input name="userImgID" placeholder="Start From 9001" type="text" id = "t001"
value="<?php if(isset($_GET['userImgID'])){ echo $userImgID;}?>"></td></tr>

<tr>
    <td>User Image Name: </td>
    <td><input name="userImgName" placeholder="User Image Name" type="text" id = "t001"
value="<?php if(isset($_GET['userImgID'])){ echo $userImgName;}?>"></td></tr>

<tr>
    <td>User Image Picture </td>
    <td><input type = "file" name = "userImgPicture" id = "t001"></td></tr>

<tr><td colspan="2" align = "center"><input type="submit" value="Add User Image" id = "t001"></td></tr>
</table>
                                                            
</form>