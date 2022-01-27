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

$query2 = "SELECT * FROM NYHCBackground";
$result2 = $conn->query($query2);
$rows2 = $result2->num_rows;

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
	<title>Change Background</title>
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

<p>Change Background &nbsp; 
    <a href="game_settings.php"><input type="button" value="Back" id = "game_button1"></a>
</p>

<center>
<table border="1" id = "game_table">

<tr>
<th>No.</th>
<th>Image</th>
<th>ID</th>
<th>Name</th>
<th>Change</th>
</tr>

<?php
    for($j = 0, $noNumber = 1; $j < $rows2; ++$j, $noNumber++){
        $result2->data_seek($j);
        $backgroundID = $result2->fetch_assoc()['backgroundID'];
        $result2->data_seek($j);
        $backgroundName = $result2->fetch_assoc()['backgroundName'];
        $result2->data_seek($j);
        $backgroundPicture = $result2->fetch_assoc()['backgroundPicture'];

        echo "<tr><td align = 'center'>$noNumber</td>";
        echo "<td align = 'center'><img src = './Picture/background/$backgroundPicture' width = 50 height = 50></td>";
        echo "<td align = 'center'>$backgroundID</td>";
        echo "<td align = 'center'>$backgroundName</td>";
        echo "<td align = 'center'><input type = 'submit' name = $noNumber value = 'Change' id = 'game_button1'></td>";
        echo "<td><input type = 'hidden' name = $backgroundID id = 't001' value = $backgroundPicture></td>";

        if (!empty($_POST["$noNumber"])) {
            //$new_background = "$backgroundPicture";
            $query1 = "UPDATE NYHCUser SET userBackground = '{$_POST[$backgroundID]}' WHERE userID = $userID";
            $result1 = $conn->query($query1);
            header("location: display_background_page.php");
            echo "<script>alert('Background change successfully! Please refresh the page and generate new background.')</script>";
        }
    }
?>

<tr>
<td colspan = "5" align = 'center'><input type = 'submit' name = default_bg value = 'Clear Background' id = 'game_button2'></td></tr>
</table>
<?php
if (!empty($_POST["default_bg"])) {
    $query1 = "UPDATE NYHCUser SET userBackground = '000' WHERE userID = $userID";
    $result1 = $conn->query($query1);
    header("location: display_background_page.php");
    echo "<script>alert('You have removed background successfully! Please refresh the page and generate empty background.')</script>";
}
?>


</form>
</body>
</html>