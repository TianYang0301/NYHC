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

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userID = $result->fetch_assoc()['userID'];
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
    $result->data_seek($j);
    $userEmail = $result->fetch_assoc()['userEmail'];
    $result->data_seek($j);
    $userSex = $result->fetch_assoc()['userSex'];
    $result->data_seek($j);
    $userPassword = $result->fetch_assoc()['userPassword'];
    $result->data_seek($j);
    $userRegisterDate = $result->fetch_assoc()['userRegisterDate'];
    $result->data_seek($j);
    $userLevel = $result->fetch_assoc()['userLevel'];
    $result->data_seek($j);
    $userPoint = $result->fetch_assoc()['userPoint'];
    $result->data_seek($j);
    $userExp = $result->fetch_assoc()['userExp'];
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
$current_date = date("Y-m-d");
$acc_day = ( strtotime($current_date) - strtotime($userRegisterDate) ) / 86400;


?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | User Profile</title>
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

<form action = "" method = "POST">
<p>View <?php echo $userName; ?> Profile &nbsp;<a href="NYHC_Game.php"><input type="button" value="Back->" id = "game_button1"></a></p>
<center>
<table border="1" id = "game_table">

<tr>
<td id = "t001" align = "center">You Img: </td>
<td align = "center"><a href = "user_img_change.php"><img src = "Picture/user_image/<?php echo $userImg;?>" width = 100 height = 100></td></a>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You User ID is <?php echo $userID; ?></td>
</tr>

<tr>
<td id = "t001">You Name: </td>
<td><input type = "text" name = "new_userName" id = "t001" value = '<?php echo $userName; ?>'></td>
</tr>

<tr>
<td id = "t001">You Email: </td>
<td><input type = "email" name = "new_userEmail" id = "t001" value = <?php echo $userEmail; ?>></td>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You is a <?php echo $userSex; ?> User.</tr>

<tr>
<td id = "t001">Password: </td>
<td><input type = "text" name = "new_userPassword" id = "t001" value = <?php echo $userPassword ;?>></td>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You first date come from <?php echo $userRegisterDate;?>.</td>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You have accumulated <?php echo $acc_day;?> days in NHYC Games.</td>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You Current Point is <?php echo $userPoint?>.</td>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You Level is <?php echo $userLevel?>. <input type = "submit" name = "update_level" value = "Update Current Level" id = "t001"></td>
</tr>

<tr>
<td colspan = 2 id = "t001" align = "center">You Exp is <?php echo $userExp?>. <a href = "user_level.php"><input type = "button" value = "View Level Detail" id = "t001"></a></td>
</tr>

<tr><td colspan = "2" align = "center"><input type = "submit" name = "edit_profile" value = "Save You Profile" id = "t001"></td></tr>
</table>

<?php
if (!empty($_POST["update_level"])) {
    if ($userExp < 5000){
        $query1 = "UPDATE NYHCUser SET userLevel = 1 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 1!')</script>";
    }
    if ($userExp > 4999 and $userExp < 15000){
        $query1 = "UPDATE NYHCUser SET userLevel = 2 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 2!')</script>";
    }

    if ($userExp > 14999 and $userExp < 40000){
        $query1 = "UPDATE NYHCUser SET userLevel = 3 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 3!')</script>";
    }

    if ($userExp > 39999 and $userExp < 60000){
        $query1 = "UPDATE NYHCUser SET userLevel = 4 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 4!')</script>";
    }

    if ($userExp > 59999 and $userExp < 90000){
        $query1 = "UPDATE NYHCUser SET userLevel = 5 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 5!')</script>";
    }

    if ($userExp > 89999 and $userExp < 130000){
        $query1 = "UPDATE NYHCUser SET userLevel = 6 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 6!')</script>";
    }
    if ($userExp > 129999 and $userExp < 180000){
        $query1 = "UPDATE NYHCUser SET userLevel = 7 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 7!')</script>";
    }

    if ($userExp > 179999 and $userExp < 240000){
        $query1 = "UPDATE NYHCUser SET userLevel = 8 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 8!')</script>";
    }

    if ($userExp > 239999 and $userExp < 310000){
        $query1 = "UPDATE NYHCUser SET userLevel = 9 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 9!')</script>";
    }

    if ($userExp > 309999 and $userExp < 390000){
        $query1 = "UPDATE NYHCUser SET userLevel = 10 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 10!')</script>";
    }

    if ($userExp > 389999 and $userExp < 480000){
        $query1 = "UPDATE NYHCUser SET userLevel = 11 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 11!')</script>";
    }
    if ($userExp > 479999 and $userExp < 580000){
        $query1 = "UPDATE NYHCUser SET userLevel = 12 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 12!')</script>";
    }

    if ($userExp > 579999 and $userExp < 690000){
        $query1 = "UPDATE NYHCUser SET userLevel = 13 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 13!')</script>";
    }

    if ($userExp > 689999 and $userExp < 810000){
        $query1 = "UPDATE NYHCUser SET userLevel = 14 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 14!')</script>";
    }

    if ($userExp > 809999 and $userExp < 940000){
        $query1 = "UPDATE NYHCUser SET userLevel = 15 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 15!')</script>";
    }

    if ($userExp > 939999 and $userExp < 1080000){
        $query1 = "UPDATE NYHCUser SET userLevel = 16 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 16!')</script>";
    }

    if ($userExp > 1079999 and $userExp < 1230000){
        $query1 = "UPDATE NYHCUser SET userLevel = 17 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 17!')</script>";
    }

    if ($userExp > 1229999 and $userExp < 1390000){
        $query1 = "UPDATE NYHCUser SET userLevel = 18 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 18!')</script>";
    }

    if ($userExp > 1389999 and $userExp < 1560000){
        $query1 = "UPDATE NYHCUser SET userLevel = 19 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 19!')</script>";
    }

    if ($userExp > 1559999 and $userExp < 1740000){
        $query1 = "UPDATE NYHCUser SET userLevel = 20 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 20!')</script>";
    }

    if ($userExp > 1739999 and $userExp < 1930000){
        $query1 = "UPDATE NYHCUser SET userLevel = 21 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 21!')</script>";
    }
    if ($userExp > 1929999 and $userExp < 2130000){
        $query1 = "UPDATE NYHCUser SET userLevel = 22 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 22!')</script>";
    }

    if ($userExp > 2129999 and $userExp < 2340000){
        $query1 = "UPDATE NYHCUser SET userLevel = 23 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 23!')</script>";
    }

    if ($userExp > 2339999 and $userExp < 2560000){
        $query1 = "UPDATE NYHCUser SET userLevel = 24 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 24!')</script>";
    }

    if ($userExp > 2559999 and $userExp < 2790000){
        $query1 = "UPDATE NYHCUser SET userLevel = 25 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 25!')</script>";
    }

    if ($userExp > 2789999 and $userExp < 3130000){
        $query1 = "UPDATE NYHCUser SET userLevel = 26 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 26!')</script>";
    }

    if ($userExp > 3129999 and $userExp < 3380000){
        $query1 = "UPDATE NYHCUser SET userLevel = 27 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 27!')</script>";
    }

    if ($userExp > 3379999 and $userExp < 3640000){
        $query1 = "UPDATE NYHCUser SET userLevel = 28 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 28!')</script>";
    }

    if ($userExp > 3639999 and $userExp < 3910000){
        $query1 = "UPDATE NYHCUser SET userLevel = 29 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 29!')</script>";
    }

    if ($userExp > 3909999){
        $query1 = "UPDATE NYHCUser SET userLevel = 30 WHERE userID = $userID";
        $result = $conn->query($query1);
        echo "<script>alert('You level is Level 30!')</script>";
    }

}


if (!empty($_POST["edit_profile"])) {
    $query1 = "UPDATE NYHCUser SET userName = '{$_POST[new_userName]}' WHERE userID = $userID";
    $query2 = "UPDATE NYHCUser SET userEmail = '{$_POST[new_userEmail]}' WHERE userID = $userID";
    $query3 = "UPDATE NYHCUser SET userPassword = '{$_POST[new_userPassword]}' WHERE userID = $userID";
    $result = $conn->query($query1);
    $result = $conn->query($query2);
    $result = $conn->query($query3);
    echo "<script>alert('You have edit profile successfully!')</script>";
}

?>
</form>