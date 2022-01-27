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
//$conn->query($query);

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
?>


<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Lucky Draw</title>
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
<?php
$current_date = date("Y-m-d");
$expiry_date = "2022-01-31";
$left_day = ( strtotime($expiry_date) - strtotime($current_date) ) / 86400;
?>


<form method = "post">

<p>Lucky Draw&nbsp; 
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
    <caption>**Welcome To Lucky Draw Zone**</caption>
    <tr>
        <td colspan = "3">Winter Draw <?php echo $left_day;?> days left</td>
    </tr>
    <tr>
        <td align = "center" rowspan = "2">
        <img src = "Picture/lucky_draw_winter2021.png" alt = "Winter Draw" width = "480" height = "270">
        <br>
        Winter Draw 
        <br>
        Valid: 2021-11-01 To 2022-01-31
        </td>
        <td align = "center" colspan = "2">
            You still have <?php echo $user_draw_num; ?> chances to draw.
        </td>
    </tr>
    <tr>
        <td>
        Draw Content:
        <br>
        188 points<br>
        288 points<br>
        888 points<br>
        1888 points<br>
        Draw Ticket x 1<br>
        Thank You For Draw<br>
    <td>
        <input type = "submit" value = "Draw" id = "game_button1" name = "lucky_draw">
        <br>
<?php 
// Draw Coding:
$prize = array(
    1 => 20,
    2 => 10, 
    3 => 5, 
    4 => 2, 
    5 => 13,
    6 => 50
    );

$prizeList = array(
    1 => array('188 Points'), 
    2 => array('288 Points'), 
    3 => array('888 Points'), 
    4 => array('1888 Points'), 
    5 => array('Draw Ticket x 1'), 
    6 => array('Thank You For Draw')
);
    $times = 10;
    $max = 0;
    foreach ($prize as $k => $v){
        $max = $v * $times + $max;
        $row['v'] = $max;
        $row['k'] = $k;
        $prizeZone[] = $row;
    }
    $max--;
    $rand = mt_rand(0, $max);
    $zone = 1;
    foreach ($prizeZone as $k => $v){
        if ($rand >= $v['v']){
            if ($rand >= $prizeZone[$k + 1]['v']){
                continue;
        } else {
            $zone = $prizeZone[$k + 1]['k'];
            break;
            }
        }
    $zone = $v['k'];
    break;
    }
if (!empty($_POST["lucky_draw"])) {     
    $draw_show = $prizeList[$zone][0];
    //echo $draw_show;
    if ($user_draw_num <= 0){
        echo "<script>alert('You have not draw ticket, finish any mission get some draw ticket!')</script>";
    }

    if ($user_draw_num > 0){
        if ($draw_show == "Thank You For Draw"){
            $draw_num = $user_draw_num - 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            echo "<script>alert('You have not get any prize! Thank you for take part.')</script>";
            
        }

        if ($draw_show == "Draw Ticket x 1"){
            $draw_num = $user_draw_num + 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            echo "<script>alert('You have get 1 draw ticket prize!')</script>";
        }


        if ($draw_show == "188 Points"){
            $draw_num = $user_draw_num - 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 188;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('You have get 188 points prize!')</script>";
        }

        if ($draw_show == "288 Points"){
            $draw_num = $user_draw_num - 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 288;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('You have get 288 points prize!')</script>";
        }

        if ($draw_show == "888 Points"){
            $draw_num = $user_draw_num - 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 888;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('You have get 888 points prize!')</script>";
        }

        if ($draw_show == "1888 Points"){
            $draw_num = $user_draw_num - 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 1888;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('You have get 1888 points prize!')</script>";
        }
    }
}
?>
</td></tr>
</table>

<?php


?>

</form>
</body>
</html>