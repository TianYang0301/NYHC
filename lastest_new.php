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
	<title>News | 12 Zodiac Card Playing</title>
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

<img src="Picture/NYHC_logo.png" width = "960" height = "270">
<input type="text" placeholder="**  Main Menu -->>  **" id = "search001" readonly>

<a href="signin.php" data-toggle="modal" data-dismiss="modal">Login</a> | 
<a href="register.php" data-toggle="modal" data-dismiss="modal">Register</a> | 
<a href="adminLogin.php" data-toggle="modal" data-dismiss="modal">Admin</a> | 
<a href="userHelp.php" data-toggle="modal" data-dismiss="modal">Help</a>

<br><br>
<p>12 Zodiac Card Playing System | Lastest News</p>

<br><br>

<ul>
  <li><a class = "w3-bar-item w3-button tablink w3-red w3-animate-bottom" onclick = "game_news(event, 'all_news')">Activity News</a></li>
  <li><a class = "w3-bar-item w3-button tablink w3-red w3-animate-top" onclick = "game_news(event, 'update_news')">Update News</a></li>
  <li><a href="landing_page.php">Back Menu</a></li>
</ul>


<div id="all_news" class="w3-container w3-border city">
<?php
$query = "SELECT * FROM News_Info ORDER BY newDate DESC";
$result = $conn->query($query);
$rows = $result->num_rows;
?>


<form action="lastest_new.php" method="GET">
<center>
<table border="1" style="text-align: left;">

<tr>
<th>Date</th>
<th>Title</th>
<th>Description</th>
</tr>

<?php
    for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
        $result->data_seek($j);
        $newDate = $result->fetch_assoc()['newDate'];
        $result->data_seek($j);
        $newTitle = $result->fetch_assoc()['newTitle'];
        $result->data_seek($j);
        $newDesc = $result->fetch_assoc()['newDesc'];
        
        echo "<tr><td>$newDate</td>";
        echo "<td>$newTitle</td>";
        echo "<td>$newDesc</td>";
    }
?>
</table>
</div>

<div id="update_news" class="w3-container w3-border city" style="display:none">
  <center><table border="1">
  <tr><td>Date</td>
      <td>Version</td>
      <td>Title</td>
      <td>Description</td></tr>

      <tr><td>2022-01-22</td>
      <td>2.0.0</td>
      <td>Finish FYP Project</td>
      <td>The system have completed!</td></tr>

      <tr><td>2022-01-21</td>
      <td>1.10.0</td>
      <td>New Game Mode - Guess Updown</td>
      <td>The third game has appeared.</td></tr>

      <tr><td>2021-12-22</td>
      <td>1.9.1</td>
      <td>Draw - 2022 Spring</td>
      <td>User can draw 2022 Spring Draw by use 2 draw ticket.</td></tr>

      <tr><td>2021-12-20</td>
      <td>1.9.0</td>
      <td>Game Mode can bet freedom.</td>
      <td>Game Mode can bet by any points when this game mode include "High" word.</td></tr>

      <tr><td>2021-12-16</td>
      <td>1.8.1</td>
      <td>Show Date Format</td>
      <td>Expiry date and future date will display to message.</td></tr>

      <tr><td>2021-12-13</td>
      <td>1.8.0</td>
      <td>Lucky Draw</td>
      <td>User can draw the lucky draw in reward zone by use draw ticket.</td></tr>

      <tr><td>2021-12-06</td>
      <td>1.7.0</td>
      <td>Change the font CSS</td>
      <td>User can change the font color and font style in settings.</td></tr>

      <tr><td>2021-11-08</td>
      <td>1.6.0</td>
      <td>User Profile Part 2</td>
      <td>User can see the level detail and accumulated exp.</td></tr>

      <tr><td>2021-09-20</td>
      <td>1.5.0</td>
      <td>Some message have added!</td>
      <td>Level limit, point limit have added.</td></tr>

  <tr><td>2021-09-07</td>
      <td>1.4.0</td>
      <td>User Profile Part 1</td>
      <td>User can edit you profile!</td></tr>

  <tr><td>2021-09-01</td>
      <td>1.3.0</td>
      <td>Guess Point</td>
      <td>The second game mode!</td></tr>

  <tr><td>2021-08-30</td>
      <td>1.2.0</td>
      <td>Admin Management</td>
      <td>Admin can add item, edit item, and view item</td></tr>

  <tr><td>2021-08-25</td>
      <td>1.1.0</td>
      <td>Five King</td>
      <td>First Game</td></tr>

  <tr><td>2021-07-01</td>
      <td>1.0.0</td>
      <td>Welcome to NYHC Game</td>
      <td>First Day Design Game</td></tr>

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

</body>
</html>
