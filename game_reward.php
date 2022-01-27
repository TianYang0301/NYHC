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
	<title>NYHC | Reward</title>
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

<p>Reward Zone&nbsp; 
    <a href="NYHC_Game.php"><input type="button" value="Back" id = "game_button1"></a>
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
</form>

<br>
**Lucky Draw Zone**

<table border = "1" id = "game_table">
    <tr>
    <td align = "center" valign = "middle" class = "mySlides">
        <button class="pictureSlide_Left" onclick="plusDivs(-1)" id = "game_button11">&#10094;</button>
        <a href = "lucky_draw.php"><img src = "Picture/lucky_draw_winter2021.png" width = "480" height = "270"></a>
        <button class="pictureSlide_Right" onclick="plusDivs(+1)" id = "game_button11">&#10095;</button>
        <br>Valid Date: 2021-11-01 To 2022-01-31
    </td>

    <td align = "center" valign = "middle" class = "mySlides">
        <button class="pictureSlide_Left" onclick="plusDivs(-1)" id = "game_button11">&#10094;</button>
        <a href = "lucky_draw_2022_spring.php"><img src = "Picture/lucky_draw_spring2022.png"  width = "480" height = "270"></a> 
        <button class="pictureSlide_Right" onclick="plusDivs(+1)" id = "game_button11">&#10095;</button>
        <br>Valid Date: 2022-01-01 To 2022-02-06  
    </td>

    <td align = "center" valign = "middle" class = "mySlides">
        <button class="pictureSlide_Left" onclick="plusDivs(-1)" id = "game_button11">&#10094;</button>
        <a href = "lucky_draw_2022_spring_en.php"><img src = "Picture/draw_spring2022_en.png"  width = "480" height = "270"></a> 
        <button class="pictureSlide_Right" onclick="plusDivs(+1)" id = "game_button11">&#10095;</button>
        <br>Valid Date: 2022-01-01 To 2022-02-06    
    </td>

    </tr>
</table>

<form method = "post">
<br>
<table border = "1" id = "game_table">

<tr>
<th>No.</th>
<th>Name</th>
<th>Start Date</th>
<th>Last Date</th>
<th>Condition</th>
<th>Quality</th>
<th>Claim</th>
</tr>

<?php
    for($j = 0, $noNumber = 1; $j < $rows9; ++$j, $noNumber++){
        $result9->data_seek($j);
        $rewardID = $result9->fetch_assoc()['rewardID'];
        $result9->data_seek($j);
        $rewardName = $result9->fetch_assoc()['rewardName'];
        $result9->data_seek($j);
        $rewardStartDate = $result9->fetch_assoc()['rewardStartDate'];
        $result9->data_seek($j);
        $rewardLastDate = $result9->fetch_assoc()['rewardLastDate'];
        $result9->data_seek($j);
        $rewardCondition = $result9->fetch_assoc()['rewardCondition'];
        $result9->data_seek($j);
        $rewardQuatity = $result9->fetch_assoc()['rewardQuatity'];
        $result9->data_seek($j);
        $rewardStatus = $result9->fetch_assoc()['rewardStatus'];

        if ($rewardCondition == 1){
            $condition_display = 'No Condition';
        }

        if ($rewardCondition == 2){
            $condition_display = 'Play A Game Mode';
        }

        if ($rewardCondition == 3){
            $condition_display = 'Earn/Use Point';
        }

        if ($rewardCondition == 4){
            $condition_display = 'Improve Level';
        }

        if ($rewardStatus == 1){
            $type_display = 'Points';
        }

        if ($rewardStatus == 2){
            $type_display = 'Draw Ticket';
        }

        echo "<tr><td align = 'center'>$noNumber</td>";
        //echo "<td align = 'center'>$rewardID</td>";
        echo "<td align = 'center'>$rewardName</td>";
        echo "<td align = 'center'>$rewardStartDate</td>";
        echo "<td align = 'center'>$rewardLastDate</td>";
        echo "<td align = 'center'>$condition_display</td>";
        echo "<td align = 'center'>$rewardQuatity $type_display</td>";
        echo "<td align = 'center'><input type = 'submit' class = $rewardID name = $rewardQuatity value = 'Claim' id = 't001'></td></tr>";
        
        $current_date = date("Y-m-d");
            if (!empty($_POST["$rewardQuatity"])) {
                if ($rewardStatus == 1){
                    if (strtotime($rewardLastDate) > strtotime($current_date) && strtotime($rewardStartDate) < strtotime($current_date)) {
                        //if ($userID == $userID_rc && $rewardID_rc == $rewardID && $num_of_claim < 5){
                            $balance = $userPoint + $rewardQuatity;
                            //$total_num_claim = $num_of_claim + 1;
                            $query1 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
                            //$query21 = "UPDATE reward_claim SET num_of_claim = $total_num_claim WHERE userID_rc = $userID AND reward_rc = $rewardID";
                            $result = $conn->query($query1);
                            //$result = $conn->query($query21);
                            echo "<script>alert('You have claim $rewardQuatity points!')</script>";
                        //}
                    } 
                    if (strtotime($rewardLastDate) < strtotime($current_date)) {
                        echo "<script>alert('This reward has expired.')</script>";
                    }
                    if (strtotime($rewardStartDate) > strtotime($current_date)) {
                        echo "<script>alert('This reward has not yet started.')</script>";
                    }
                }
            }
            
            if (!empty($_POST["$rewardQuatity"])) {
                if ($rewardStatus == 2){
                    if (strtotime($rewardLastDate) > strtotime($current_date) && strtotime($rewardStartDate) < strtotime($current_date)) {
                        $balance = $userPoint + $rewardQuatity;
                        $query1 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
                        $result = $conn->query($query1);
                        echo "<script>alert('You have claim $rewardQuatity points!')</script>";
                    }
                    if (strtotime($rewardLastDate) < strtotime($current_date)) {
                    echo "<script>alert('This reward has expired.')</script>";
                    }
                    if (strtotime($rewardStartDate) > strtotime($current_date)) {
                        echo "<script>alert('This reward has not yet started.')</script>";
                    }
                }   
            }
            




    }
?>
<tr>
    <td colspan = "7">Improve Level Reward: <a href = "level_reward.php"><input type = "button" value = "View" id = "t001"></a></td>
</tr>
</table>

</form>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display = "block"; 
  setTimeout(carousel, 5000); // Change image every 5 seconds
}
</script>

</body>
</html>