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

$query = "SELECT * FROM NYHCUser";
$query2 = "SELECT * FROM NYHCGameMode";
$result = $conn->query($query);
$result2 = $conn->query($query2);
$rows = $result->num_rows;
$rows2 = $result2->num_rows;
?>

<?php
//$userName = ['userName'];
//$userLevel = ['userLevel'];
//$userPoint = ['userPoint'];

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
	<title>Game Mode Select</title>
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

<p>Game Mode Select &nbsp; 
    <a href="NYHC_Game.php"><input type="button" value="Back" id = "game_button1"></a></p>

<table align = "center" cellspacing = "10">
    <tr>
        <td rowspan = "2"><img src = "Picture/user_image/<?php echo $userImg;?>" width = 100 height = 100></td>
        <td><?php echo $userName; ?></td>
        <td></td>
        <td>Point</td>
        
    </tr>
    <tr>
        <td>Lv <?php echo $userLevel; ?></td>
        <td></td>
        <td><?php echo $userPoint; ?></td>
    </tr>
</table>
<table border="1" id = "game_table">


<tr>
<th>No.</th>
<th>Name</th>
<th>Card Number</th>
<th>Level</th>
<th>No. of Player</th>
<th>Point Limit</th>
<th>Select</th>
</tr>

<?php
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
        
        echo "<tr><td align = 'center'>$noNumber</td>";
        echo "<td align = 'center'>$GMName</td>";
        echo "<td align = 'center'>$GMCardNo</td>";
        echo "<td align = 'center'>$GMLevel</td>";
        echo "<td align = 'center'>$GMPlayer</td>";
        echo "<td align = 'center'>$GMPointLimit</td>";
        //echo "<td align = 'center'><a href = $GMDescription><input type = 'button' value = 'Select' id = 'game_button1'></td></a>";
        echo "<td align = 'center'><input type = 'submit' name = $GMID value = 'Select' id = 'game_button1'></td></tr>";
        
        if (!empty($_POST["$GMID"])) {
            if ($userLevel < $GMLevel and $userPoint >= $GMPointLimit){
                echo "<script>alert('You Level must reach Level $GMLevel!')</script>";
            }
            if ($userPoint < $GMPointLimit){
                echo "<script>alert('You Point must reach $GMPointLimit and above.')</script>";
            }
            if ($userLevel < $GMLevel and $userPoint < $GMPointLimit){
                echo "<script>alert('You Point and Level is not reach the target!')</script>";
            }
            if ($userLevel >= $GMLevel and $userPoint >= $GMPointLimit){
                header("location: $GMDescription");
            }

        }
    }
?>
</table>




</form>
</body>
</html>