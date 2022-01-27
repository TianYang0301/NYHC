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
/*
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    $query = "select * from NYHCUser where userID = '$userID'";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while($rows = $result->fetch_assoc()){
                        $userID = $rows['userID'];
                        $userPoint = $rows['userPoint'];
                    }
                }
}

if (isset($_POST['edit'])){
    $userID = $_POST['userID'];
    $userPoint = $_POST['userPoint'];
    
    $query1 = "update NYHCUser set userID = '$userID' where userID = '$userID'";

    $result = $conn->query($query1);
    echo "<script>alert('Edit successfully')
    location='game_play.php'</script>";
    }
*/
$query = "SELECT * FROM NYHCUser, NYHCGameMode";
$result = $conn->query($query);
$rows = $result->num_rows;
$conn->query($query);

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
    $result->data_seek($j);
    $userLevel = $result->fetch_assoc()['userLevel'];
    $result->data_seek($j);
    $userPoint = $result->fetch_assoc()['userPoint'];
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

// Update Bit Point
if(isset($_GET['userID'])){
$query2 = "SELECT * FROM NYHCUser WHERE userID =" .$_GET['userID'];
    $result = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result);
}

//Update Information
if(isset($_POST['btn-update'])){
    $userID = $_POST['userID'];
    $userPoint = $_POST['userPoint'];
    $bit_point = $_POST['bit_point'];

$update = "UPDATE NYHCUser SET userID ='$userID', userPoint = '$userPoint' WHERE userID =". $_GET['userID'];
$up = mysqli_query($conn, $update);
if(!isset($query2)){
    die ("Error $query2" .mysqli_connect_error());
}
else{
header("location: game_play.php");
}
   }

/*
$query1 = "UPDATE NYHCUser SET userPoint = '$userPoint' - '$bit_point' WHERE userID = '$userID'";
$result = $conn->query($query1);
$conn->query($query1);

//$userPoint = ['userPoint'];
//$bit_point = ['bit_Point'];

if ($conn->query($query1) === TRUE && $userPoint > $bit_point) {
echo "Bit successfully!";
//header("location: game_play.php");
}
if ($conn->query($query1) === TRUE && $userPoint < $bit_point) {
echo "The point have not enough!";
}

}
*/
?>



<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>Game Mode Index</title>
    <link rel = "stylesheet" href = "gameUI.css">
</head>

<body>
<form method = "post">
<p>Game Mode Index &nbsp; 
    <a href="game_menu.php"><input type="button" value="Back" id = "game_button1"></a>
</p>
<p>Your choose <?php echo $GMName; ?></p>
<p><img src = "Picture/default_photo.png" width = 80 height = 80> <?php echo $userName; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Point</p>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Lv <?php echo $userLevel; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $userPoint; ?></p>

<table border="1" id = "game_table">
<tr>
    <td>No. of Player</td>
    <td><select name = "no_of_player" id = "t001">
            <option value="player_1">1</option>
            <option value="player_2">2</option>
            <option value="player_3">3</option>
            <option value="player_4">4</option>
            <option value="player_5">5</option></select></td>
</tr>
<tr><td>Bit Point</td>
    <td><input type = "text" maxlength="10" name = "bit_point" id = "t001" value="<?php if(isset($_GET['userPoint'])){ echo $userPoint;}?>"></td>
</tr>
</table>

<br>
<input type = "submit" value = "Confirm" id = "game_button1">


</form>
</body>
</html>