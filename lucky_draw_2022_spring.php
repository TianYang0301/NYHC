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
$expiry_date = "2022-02-06";
$left_day = ( strtotime($expiry_date) - strtotime($current_date) ) / 86400;
?>


<form method = "post">

<p>耀虎抽獎2022&nbsp; 
    <a href="game_reward.php"><input type="button" value="Back" id = "game_button1"></a>
</p>
<table align = "center" cellspacing = "10">
    <tr>
        <td rowspan = "2"><img src = "Picture/user_image/<?php echo $userImg;?>" width = 100 height = 100></td>
        <td><?php echo $userName; ?></td>
        <td></td>
        <td>積分</td>
        
    </tr>
    <tr>
        <td>Lv <?php echo $userLevel; ?></td>
        <td></td>
        <td><?php echo $userPoint; ?></td>
    </tr>
</table>
<table border = "1" id = "game_table">
    <caption>**歡迎來到耀虎抽獎2022**</caption>
    <tr>
        <td colspan = "3">耀虎抽獎還有<?php echo $left_day;?>天結束！</td>
    </tr>
    <tr>
        <td align = "center" rowspan = "2">
        <img src = "Picture/lucky_draw_spring2022.png" alt = "2022 Spring Draw" width = "480" height = "270">
        <br>
        耀虎抽獎2022 
        <br>
        活動時間：2022-01-01至2022-02-06
        </td>
        <td align = "center" colspan = "2">
            你還有 <?php echo $user_draw_num; ?> 次機會抽獎。
        </td>
    </tr>
    <tr>
        <td align = "left">
        本次抽獎的獎品內容如下：
        <br>
        大獎：888888積分<br>
        二獎：88888積分<br>
        三獎：8888積分<br>
        特別獎：88張抽獎券<br>
        其他獎品：<br>
         · 888積分<br>
         · 8張抽獎券<br>
         · 1張抽獎券
    <td>
        <input type = "submit" value = "抽獎" id = "game_button1" name = "lucky_draw">
        <br>
<?php 
$prize = array(
    1 => 3,
    2 => 7, 
    3 => 10, 
    4 => 25, 
    5 => 5,
    6 => 20,
    7 => 30
    );

$prizeList = array(
    1 => array('888888 Points'), 
    2 => array('88888 Points'), 
    3 => array('8888 Points'), 
    4 => array('888 Points'), 
    5 => array('Draw Ticket x 88'), 
    6 => array('Draw Ticket x 8'),
    7 => array('Draw Ticket x 1')
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
    if ($user_draw_num <= 1){
        echo "<script>alert('你的抽獎券不足於2張，去完成任務以領取更多的抽獎券！')</script>";
    }

    if ($user_draw_num > 1){
        if ($draw_show == "Draw Ticket x 1"){
            $draw_num = $user_draw_num - 1;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            echo "<script>alert('恭喜你獲得了1張抽獎券！')</script>";
        }
        if ($draw_show == "Draw Ticket x 8"){
            $draw_num = $user_draw_num + 6;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            echo "<script>alert('恭喜你獲得了8張抽獎券！')</script>";
        }

        if ($draw_show == "Draw Ticket x 88"){
            $draw_num = $user_draw_num + 86;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            echo "<script>alert('恭喜你獲得了88張抽獎券！')</script>";
        }

        if ($draw_show == "888 Points"){
            $draw_num = $user_draw_num - 2;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 888;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('恭喜你獲得了888積分!')</script>";
        }

        if ($draw_show == "8888 Points"){
            $draw_num = $user_draw_num - 2;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 8888;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('恭喜你獲得了三獎8888積分!')</script>";
        }

        if ($draw_show == "88888 Points"){
            $draw_num = $user_draw_num - 2;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 88888;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('恭喜你獲得了二獎88888積分!')</script>";
        }

        if ($draw_show == "888888 Points"){
            $draw_num = $user_draw_num - 2;
            $query1 = "UPDATE NYHCUser SET user_draw_num = $draw_num WHERE userID = $userID";
            $result = $conn->query($query1);
            $balance = $userPoint + 888888;
            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
            $result = $conn->query($query2);
            echo "<script>alert('恭喜你獲得了大獎888888積分!')</script>";
        }
    }
}
?>
</td></tr>
</table>
</form>
</body>
</html>