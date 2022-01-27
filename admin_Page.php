<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['rewardID'])) {
    $rewardID = $_GET['rewardID'];
    $rewardName = $_GET['rewardName'];
    $rewardStartDate = $_GET['rewardStartDate'];
    $rewardLastDate = $_GET['rewardLastDate'];
    $rewardCondition = $_GET['rewardCondition'];
    $rewardQuatity = $_GET['rewardQuatity'];
    $rewardStatus = $_GET['rewardStatus'];

    $query = "INSERT INTO NYHCReward 
    (rewardID, rewardName, rewardStartDate, rewardLastDate, rewardCondition, rewardQuatity, rewardStatus) 
    VALUES ('$rewardID', '$rewardName', 
    '$rewardStartDate', '$rewardLastDate', '$rewardCondition', '$rewardQuatity', '$rewardStatus')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>NYHC | Admin Page</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #2196f3;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #4caf50;
}
</style>

<body>
<center><img src="Picture/NYHC_logo.png" width = "960" height = "270">
<form action = "admin_Page.php" method = "GET">

<ul>
  <li>Admin Page **</li>
  <li><a href = "admin_view_item.php">View Item</a></li>
  <li><a class = "w3-bar-item w3-button tablink w3-red w3-animate-bottom" onclick = "game_news(event, 'add_item')">Add Item</a></li>
  <li><a href="landing_page.php">Logout</a></li>
</ul>

<div id="add_item" class="w3-container w3-border city" style="display:none">
<center>
<table border="1" id = "css001">

<tr><td colspan="4">Add Item</td></tr>
<tr><td>Game Mode</td>
    <td><a href="admin_add_game.php"><input type="button" value = "Add" id = "t002"></a></td>
    <td>Reward</td>
    <td><a href="admin_add_reward.php"><input type="button" value="Add" id = "t002"></a></td>
  </tr>
<tr><td>Point Redemption</td>
    <td><a href="admin_add_point.php"><input type="button" value="Add" id = "t002"></a></td>
    <td>Card Style</td>
    <td><a href="admin_add_card.php"><input type="button" value="Add" id = "t002"></a></td>
</tr>
<tr><td>Background</td>
    <td><a href="admin_add_background.php"><input type="button" value="Add" id = "t002"></a></td>
    <td colspan = "2">
    <?php ignore_user_abort();
          set_time_limit(0);
          date_default_timezone_set("Asia/Shanghai");
          echo date("Y-m-d") ,"&nbsp";
          echo date("H:i:s");
    ?></td>
  
  </tr>
</table>
</div>

</table>
</div>


<script>
function game_news(evt, novice_function) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(novice_function).style.display = "block";
  evt.currentTarget.className += " w3-red";
}
</script>

</form>