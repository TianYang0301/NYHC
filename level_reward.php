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
$query9 = "SELECT * FROM NYHCReward";
$result = $conn->query($query);
$result9 = $conn->query($query9);
$rows = $result->num_rows;
$rows9 = $result9->num_rows;
//$conn->query($query);

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
	$result->data_seek($j);
    $userID = $result->fetch_assoc()['userID'];
    $result->data_seek($j);
    $userLevel = $result->fetch_assoc()['userLevel'];
    $result->data_seek($j);
    $userExp = $result->fetch_assoc()['userExp'];
    $result->data_seek($j);
    $userPoint = $result->fetch_assoc()['userPoint'];
    $result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
    $result->data_seek($j);
    $userImg = $result->fetch_assoc()['userImg'];
    $result->data_seek($j);
    $user_draw_num = $result->fetch_assoc()['user_draw_num'];
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

$query_reward = "SELECT * FROM reward_claim";
$result_reward = $conn->query($query_reward);
$rows_reward = $result_reward->num_rows;

for($j = 0, $noNumber = 1; $j < $rows3; ++$j, $noNumber++){
  $result_reward->data_seek($j);
  $userID_rc = $result_reward->fetch_assoc()['userID_rc'];
  $result_reward->data_seek($j);
  $rewardID_rc = $result_reward->fetch_assoc()['rewardID_rc'];
  $result_reward->data_seek($j);
  $claim_date = $result_reward->fetch_assoc()['claim_date'];
  $result_reward->data_seek($j);
  $num_of_claim = $result_reward->fetch_assoc()['num_of_claim'];
}
?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Level Reward</title>
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

<p>Level Reward Zone&nbsp; 
    <a href="game_reward.php"><input type="button" value="Back" id = "game_button1"></a>
</p>
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

<table border = "1" id = "game_table">
    <caption>Improve Level Reward</caption>
    <tr>
        <td>Level</td>
        <td>Reward Detail</td>
        <td>Claim</td>
    </tr>
    <tr>
        <td>2</td>
        <td>2888 Points <br>
            2 Draw Ticket</td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_2"></td>
    </tr>

    <tr>
        <td>3</td>
        <td>3888 Points <br>
            3 Draw Ticket</td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_3"></td>
    </tr>

    <tr>
        <td>4</td>
        <td>4888 Points <br>
            4 Draw Ticket</td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_4"></td>
    </tr>

    <tr>
        <td>5</td>
        <td>5000 Points <br>
            10 Draw Ticket <br>
            100 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_5"></td>
    </tr>

    <tr>
        <td>6</td>
        <td>6666 Points <br>
            6 Draw Ticket <br>
            666 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_6"></td>
    </tr>

    <tr>
        <td>7</td>
        <td>7288 Points <br>
            8 Draw Ticket <br>
            728 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_7"></td>
    </tr>

    <tr>
        <td>8</td>
        <td>8888 Points <br>
            8 Draw Ticket <br>
            888 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_8"></td>
    </tr>

    <tr>
        <td>9</td>
        <td>9888 Points <br>
            9 Draw Ticket <br>
            988 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_9"></td>
    </tr>

    <tr>
        <td>10</td>
        <td>10000 Points <br>
            11 Draw Ticket <br>
            1088 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_10"></td>
    </tr>

    <tr>
        <td>15</td>
        <td>18888 Points <br>
            30 Draw Ticket <br>
            1888 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_15"></td>
    </tr>

    <tr>
        <td>20</td>
        <td>28888 Points <br>
            40 Draw Ticket <br>
            2888 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_20"></td>
    </tr>

    <tr>
        <td>25</td>
        <td>58888 Points <br>
            50 Draw Ticket <br>
            5888 Exp Reward </td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_25"></td>
    </tr>

    <tr>
        <td>30</td>
        <td>88888 Points <br>
            88 Draw Ticket <br></td>
        <td><input type = "submit" value = "Claim" id = "game_button1" name = "level_30"></td>
    </tr>

</table>

<?php
    if (!empty($_POST["level_2"])) {
        if ($userLevel > 1){
            $balance = $userPoint + 2888;
            $draw = $user_draw_num + 2;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            echo "<script>alert('You have get 2888 points and 2 draw ticket for level 2 reward!')</script>";
        }
        if ($userLevel < 2){
            echo "<script>alert('You Level have not reached Level 2!')</script>";
        }
    }

    if (!empty($_POST["level_3"])) {
        if ($userLevel > 2){
            $balance = $userPoint + 3888;
            $draw = $user_draw_num + 3;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            echo "<script>alert('You have get 3888 points and 3 draw ticket for level 3 reward!')</script>";
        }
        if ($userLevel < 3){
            echo "<script>alert('You Level have not reached Level 3!')</script>";
        }
    }

    if (!empty($_POST["level_4"])) {
        if ($userLevel > 3){
            $balance = $userPoint + 4888;
            $draw = $user_draw_num + 4;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            echo "<script>alert('You have get 4888 points and 4 draw ticket for level 4 reward!')</script>";
        }
        if ($userLevel < 4){
            echo "<script>alert('You Level have not reached Level 4!')</script>";
        }
    }

    if (!empty($_POST["level_5"])) {
        if ($userLevel > 4){
            $balance = $userPoint + 5000;
            $draw = $user_draw_num + 10;
            $new_exp = $userExp + 100;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 5000 points, 10 draw ticket and 100 exp for level 5 reward!')</script>";
        }
        if ($userLevel < 5){
            echo "<script>alert('You Level have not reached Level 5!')</script>";
        }
    }

    if (!empty($_POST["level_6"])) {
        if ($userLevel > 5){
            $balance = $userPoint + 6666;
            $draw = $user_draw_num + 6;
            $new_exp = $userExp + 666;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 6666 points, 6 draw ticket and 666 exp for level 6 reward!')</script>";
        }
        if ($userLevel < 6){
            echo "<script>alert('You Level have not reached Level 6!')</script>";
        }
    }

    if (!empty($_POST["level_7"])) {
        if ($userLevel > 6){
            $balance = $userPoint + 7288;
            $draw = $user_draw_num + 8;
            $new_exp = $userExp + 728;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 7288 points, 8 draw ticket and 728 exp for level 7 reward!')</script>";
        }
        if ($userLevel < 7){
            echo "<script>alert('You Level have not reached Level 7!')</script>";
        }
    }

    if (!empty($_POST["level_8"])) {
        if ($userLevel > 7){
            $balance = $userPoint + 8888;
            $draw = $user_draw_num + 8;
            $new_exp = $userExp + 888;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 8888 points, 8 draw ticket and 888 exp for level 8 reward!')</script>";
        }
        if ($userLevel < 8){
            echo "<script>alert('You Level have not reached Level 8!')</script>";
        }
    }

    if (!empty($_POST["level_9"])) {
        if ($userLevel > 8){
            $balance = $userPoint + 9888;
            $draw = $user_draw_num + 9;
            $new_exp = $userExp + 988;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 9888 points, 9 draw ticket and 988 exp for level 9 reward!')</script>";
        }
        if ($userLevel < 5){
            echo "<script>alert('You Level have not reached Level 9!')</script>";
        }
    }

    if (!empty($_POST["level_10"])) {
        if ($userLevel > 9){
            $balance = $userPoint + 10000;
            $draw = $user_draw_num + 11;
            $new_exp = $userExp + 1088;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 10000 points, 11 draw ticket and 1088 exp for level 10 reward!')</script>";
        }
        if ($userLevel < 10){
            echo "<script>alert('You Level have not reached Level 5!')</script>";
        }
    }

    if (!empty($_POST["level_15"])) {
        if ($userLevel > 14){
            $balance = $userPoint + 18888;
            $draw = $user_draw_num + 30;
            $new_exp = $userExp + 1888;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 18888 points, 30 draw ticket and 1888 exp for level 15 reward!')</script>";
        }
        if ($userLevel < 15){
            echo "<script>alert('You Level have not reached Level 15!')</script>";
        }
    }

    if (!empty($_POST["level_20"])) {
        if ($userLevel > 19){
            $balance = $userPoint + 28888;
            $draw = $user_draw_num + 40;
            $new_exp = $userExp + 2888;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 28888 points, 40 draw ticket and 2888 exp for level 20 reward!')</script>";
        }
        if ($userLevel < 20){
            echo "<script>alert('You Level have not reached Level 20!')</script>";
        }
    }

    if (!empty($_POST["level_25"])) {
        if ($userLevel > 24){
            $balance = $userPoint + 58888;
            $draw = $user_draw_num + 50;
            $new_exp = $userExp + 5888;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $query_exp = "UPDATE NYHCUser SET userExp = $new_exp WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            $result = $conn->query($query_exp);
            echo "<script>alert('You have get 58888 points, 50 draw ticket and 5888 exp for level 25 reward!')</script>";
        }
        if ($userLevel < 25){
            echo "<script>alert('You Level have not reached Level 25!')</script>";
        }
    }

    if (!empty($_POST["level_30"])) {
        if ($userLevel > 29){
            $balance = $userPoint + 88888;
            $draw = $user_draw_num + 88;
            $query_level = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $query_draw = "UPDATE NYHCUser SET user_draw_num = $draw WHERE userID = $userID";
            $result = $conn->query($query_level);
            $result = $conn->query($query_draw);
            echo "<script>alert('You have get 88888 points and 88 draw ticket for level 30 reward!')</script>";
        }
        if ($userLevel < 30){
            echo "<script>alert('You Level have not reached Level 30!')</script>";
        }
    }

?>

</form>
</body>
</html>