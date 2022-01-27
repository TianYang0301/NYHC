<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

require_once('login.php');

$query = "SELECT * FROM NYHCUser, NYHCGameMode";
$result = $conn->query($query);
$rows = $result->num_rows;
$conn->query($query);

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
	$result->data_seek($j);
    $userID = $result->fetch_assoc()['userID'];
    $result->data_seek($j);
    $userLevel = $result->fetch_assoc()['userLevel'];
    $result->data_seek($j);
    $userPoint = $result->fetch_assoc()['userPoint'];
	$result->data_seek($j);
    $userExp = $result->fetch_assoc()['userExp'];
	$result->data_seek($j);
    $userImg = $result->fetch_assoc()['userImg'];
	$result->data_seek($j);
    $userCard = $result->fetch_assoc()['userCard'];
	$result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
	$result->data_seek($j);
    $user_bit_num = $result->fetch_assoc()['user_bit_num'];
}

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $GMName = $result->fetch_assoc()['GMName'];
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
	<title>Playing</title>
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
<p>Game Mode Playing &nbsp; 
    <a href="guess_point10(high).php"><input type="button" value="Back" id = "game_button1"></a>
</p>
<p><img src = "Picture/user_image/<?php echo $userImg;?>" width = 80 height = 80> <?php echo $userName; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Point</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lv <?php echo $userLevel; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $userPoint; ?></p>
<p>You Exp <?php echo $userExp; ?> </p>

<table border = 1 cellspacing = 1 cellpadding = 1 align = center>
	<tr><td align = center colspan = 6><b>Change the Bet Values</b></td></tr>
	<tr>
		<td><input type = "text" name = "bet_num" value = <?php echo "$user_bit_num"; ?> id = "t001">
			<input type = "submit" name = "btn_bet" value = "Confirm" id = "game_button1"></td>
	</tr>
</table>

<?php
if (!empty($_POST["btn_bet"])) {
	$query12 = "UPDATE NYHCUser SET user_bit_num = '{$_POST['bet_num']}' WHERE userID = $userID";
	$result12 = $conn->query($query12);
    header("location: guess_point10(high).php");
}
?> 