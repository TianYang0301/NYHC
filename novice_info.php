<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>Novice Info | 12 Zodiac Card Playing</title>
    <link rel="stylesheet" href="landing_page.css">
</head>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
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
  background-color: #111;
}
</style>

<body>
<img src="Picture/NYHC_logo.png" width = "960" height = "270">
<input type="text" placeholder="**  Main Menu -->>  **" id = "search001" readonly>

<a href="signin.php" data-toggle="modal" data-dismiss="modal">Login</a> | 
<a href="register.php" data-toggle="modal" data-dismiss="modal">Register</a> | 
<a href="adminLogin.php" data-toggle="modal" data-dismiss="modal">Admin</a> | 
<a href="userHelp.php" data-toggle="modal" data-dismiss="modal">Help</a>

<br><br>
<p>12 Zodiac Card Playing System | Novice Info</p>

<br><br>

<div class="w3-bar w3-black">
<ul>
  <li><a class = "w3-bar-item w3-button tablink w3-red" onclick = "novice(event, 'Home')">Home</a></li>
  <li><a class = "w3-bar-item w3-button tablink w3-red" onclick = "novice(event, 'game_mode_NYHC')">Game Mode NYHC</a></li>
  <li><a href="landing_page.php">Back Menu</a></li>
</ul>

<div id="Home" class="w3-container w3-border city">
<table border="1" style="text-align: center;">
<tr>Introduction Game History (NYHC)
<td>NYHC(年元紅春) is appear in January 2019 (豬吐洋氣). NYHC have 4 colour zodiac such as black, blue, red and grren.
    The cards have 4 extra cards (Year, Yuan, Red and Spring), but some special mode have a 2 more extra cards (Zodiac x2).
    Normal mode have 52 cards, but some mode have 54 cards or 48 cards.</td></tr>

<tr><td></td></tr>

<tr><td>Introduction Game History (Five Zodiac)</td></tr>
<tr><td>Start of The Sky of Yang, have develop a new colour (purple).
        The series have not Year, Yuan, Red, Spring and Zodiac cards. The series have 60 cards.</td></tr>
</table>
</div>

<div id="game_mode_NYHC" class="w3-container w3-border city" style="display:none">
Game Mode of NYHC
<table border="1" style="text-align: left;">

<tr><td>ID</td>
    <td>Name</td>
    <td>No. of Player</td>
    <td>Description</td>
</tr>

<tr><td>1</td>
    <td>Five King Zodiac</td>
    <td>1</td>
    <td>There are five cards in each game, 
        and cards can only be exchanged once in a game or not. 
        10 points is minimum point, this game contains Two "Zodiac" Cards. 
    <br>**Winning Reward**
		<br>Hao Ji Jackpot -- 888
		<br>Five Zodiac -- 100
		<br>Same Colour Straight -- 80
		<br>Four Zodiac -- 60
		<br>Airplane -- 58
		<br>Train -- 50
		<br>Gourd -- 30
		<br>Same Colour -- 20
		<br>Straight -- 10
		<br>Three Zodiac -- 5
		<br>Two Pair Zodiac -- 4
		<br>One Pair Zodiac -- 2
    <br>Only Four Cards (Year, Yuan, Red, Spring) cannot become as one part.</td>
</tr>

<tr><td>2</td>
    <td>Guess Point (5 Cards)</td>
    <td>1</td>
    <td>The game mode can guess the 5 cards's point is between in? 
    <br>Or you guess the odd & even points.
    <br>**The Winning Rewards**
    <br>49-60/5-15 Points -- 30
    <br>Odd/Even Points -- 20
    <br>38-48/16-26 Points -- 20
    <br>27-37 Points -- 10
    <br>The minimum point bets is 10 points.
    </td>
</tr>

<tr><td>3</td>
    <td>Guess Updown</td>
    <td>1</td>
    <td>The game mode only guess 1 cards value.
    <br>Bigger -- 20
    <br>Smaller -- 20
    <br>Equal -- 100
</td>
</tr>


</table>


  </div>


<script>
function novice(evt, novice_function) {
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

</body>
</html>