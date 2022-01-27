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

$query2 = "SELECT * FROM NYHCCard";
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
	<title>Change Card Style</title>
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

<p>Change Card Style &nbsp; 
    <a href="game_settings.php"><input type="button" value="Back" id = "game_button1"></a>
</p>

<center>
<table border="1" id = "game_table">

<tr>
<th>No.</th>
<th colspan = 2>Image</th>
<th>ID</th>
<th>Name</th>
<th>Change</th>
</tr>

<?php
    for($j = 0, $noNumber = 1; $j < $rows2; ++$j, $noNumber++){
        $result2->data_seek($j);
        $cardID = $result2->fetch_assoc()['cardID'];
        $result2->data_seek($j);
        $cardName = $result2->fetch_assoc()['cardName'];
        $result2->data_seek($j);
        $cardPicture = $result2->fetch_assoc()['cardPicture'];

        echo "<tr><td align = 'center'>$noNumber</td>";
        echo "<td align = 'center'><img src = './Picture/$cardPicture/01-00.png' width = 90 height = 160></td>";
        echo "<td align = 'center'><img src = './Picture/$cardPicture/01-01.png' width = 90 height = 160></td>";
        echo "<td align = 'center'>$cardID</td>";
        echo "<td align = 'center'>$cardName</td>";
        echo "<td align = 'center'><input type = 'submit' name = $noNumber value = 'Change' id = 'game_button1'></td>";
        echo "<td><input type = 'hidden' name = $cardID id = 't001' value = $cardPicture></td>";

        if (!empty($_POST["$noNumber"])) {
            //$new_background = "$backgroundPicture";
            $query1 = "UPDATE NYHCUser SET userCard = '{$_POST[$cardID]}' WHERE userID = $userID";
            $result1 = $conn->query($query1);
            echo "<script>alert('Card Style change successfully!')</script>";
        }
    }
?>

</table>



</form>
</body>
</html>