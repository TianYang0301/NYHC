<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require_once('login.php');

$query = "SELECT * FROM NYHCUser";
$result = $conn->query($query);
$rows = $result->num_rows;

?>

<?php

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
    $result->data_seek($j);
    $userLevel = $result->fetch_assoc()['userLevel'];
    $result->data_seek($j);
    $userPoint = $result->fetch_assoc()['userPoint'];
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
	<title>12 Zodiac Card Playing</title>
    <link rel = "stylesheet" href = "gameUI.css">
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

<form method = "post">
<img src="Picture/NYHC_logo.png" width = "960" height = "270">
<table align = "center" cellspacing = "10">
    <tr>
        <td rowspan = "2"><img src = "Picture/user_image/<?php echo $userImg;?>" width = 100 height = 100></td>
        <td><?php echo $userName; ?></td>
        <td></td>
        <td>Point</td>
        <td rowspan = "2"><a href="signin.php"><input type="button" value="Logout" id = "game_button1"></a></td>
    </tr>
    <tr>
        <td>Lv <?php echo $userLevel; ?></td>
        <td></td>
        <td><?php echo $userPoint; ?></td>
    </tr>
</table>

<table border="1" id = "game_table">
<tr>
    <td width = 300 height = 200><a href = "game_menu.php"><img src="Picture/game_button_game_mode_select.png" width = 350 height = 200></a></td>
    <td width = 300 height = 200><a href = "game_reward.php"><img src="Picture/game_button_reward.png" width = 350 height = 200></a></td>
    <td width = 300 height = 200><a href = "game_point.php"><img src="Picture/game_button_point_redemption.png" width = 350 height = 200></a></td>
</tr><tr>
    <td width = 300 height = 200><a href = "user_profile.php"><img src="Picture/game_button_user_profile.png" width = 350 height = 200></a></td>
    <td><center>
    <?php 
    date_default_timezone_set("Asia/Shanghai");
    date("N");
    if (date("N") == 1){ $week = "Monday"; }
    if (date("N") == 2){ $week = "Tuesday"; }
    if (date("N") == 3){ $week = "Wednesday"; }
    if (date("N") == 4){ $week = "Thrusday"; }
    if (date("N") == 5){ $week = "Friday"; }
    if (date("N") == 6){ $week = "Saturday"; }
    if (date("N") == 7){ $week = "Sunday"; }
        echo date("Y-m-d") ,"<br>";
        echo $week ,"<br>";
        echo date("H:i:s");
    ?></td>
    <td width = 300 height = 200><a href = "game_settings.php"><img src="Picture/game_button_settings.png" width = 350 height = 200></a></td>
</tr>
</table>

</form>
</body>
</html>