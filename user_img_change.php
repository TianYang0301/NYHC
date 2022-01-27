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
$result = $conn->query($query);
$rows = $result->num_rows;

$query2 = "SELECT * FROM NYHCUserImg";
$result2 = $conn->query($query2);
$rows2 = $result2->num_rows;

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
	<title>Change Your Image</title>
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
            #game_button2{
                color: <?php echo $GameRGB;?>;
                font-family: <?php echo $GameFont;?>;
            }
</style>
<body>

<form method = "post">

<p>Change Your Image &nbsp; 
    <a href="user_profile.php"><input type="button" value="Back" id = "game_button1"></a>
</p>

<center>
<table border="1" id = "game_table">

<tr>
<th>Image</th>
<th>Name</th>
<th>Change</th>
</tr>

<?php
    for($j = 0, $noNumber = 1; $j < $rows2; ++$j, $noNumber++){
        $result2->data_seek($j);
        $userImgID = $result2->fetch_assoc()['userImgID'];
        $result2->data_seek($j);
        $userImgName = $result2->fetch_assoc()['userImgName'];
        $result2->data_seek($j);
        $userImgPicture = $result2->fetch_assoc()['userImgPicture'];

        echo "<tr><td align = 'center'><img src = './Picture/user_image/$userImgPicture' width = 100 height = 100></td>";
        echo "<td align = 'center'>$userImgName</td>";
        echo "<td align = 'center'><input type = 'submit' name = $noNumber value = 'Change' id = 'game_button1'></td>";
        echo "<td align = 'center'><input type = 'hidden' name = $userImgID id = 't001' value = $userImgPicture></td>";

        if (!empty($_POST["$noNumber"])) {
            $query1 = "UPDATE NYHCUser SET userImg = '{$_POST[$userImgID]}' WHERE userID = $userID";
            $result1 = $conn->query($query1);
        }
    }
?>

<tr>
    <td colspan = "3" align = 'center'><a href="add_user_img.php"><input type="button" value="Add You Image" id = "game_button2"></a></td>
</tr>
</table>



</form>
</body>
</html>