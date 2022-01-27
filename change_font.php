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

$query2 = "SELECT * FROM NYHCBackground";
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
  $result3->data_seek($j);
  $red_color = $result3->fetch_assoc()['red_color'];
  $result3->data_seek($j);
  $green_color = $result3->fetch_assoc()['green_color'];
  $result3->data_seek($j);
  $blue_color = $result3->fetch_assoc()['blue_color'];
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>Change Font Size and Color</title>
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

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #00509A;
}

li {
  float: left;
}

li a {
  display: block;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #00FF88;
}

</style>
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

<body>

<form method = "post">

<p>Change Font Size and Color &nbsp; 
    <a href="game_settings.php"><input type="button" value="Back" id = "game_button1"></a>
</p>
<?php

function fromRGB($R, $G, $B){
  $R = dechex($R);
  if (strlen($R)<2)
  $R = '0'.$R;

  $G = dechex($G);
  if (strlen($G)<2)
  $G = '0'.$G;

  $B = dechex($B);
  if (strlen($B)<2)
  $B = '0'.$B;

  return '#' . $R . $G . $B;
  echo '#', $R, $G, $B;
  
}



?>


<ul>
  <li>Select The Change Font Type:</li>
  <li><a class = "w3-bar-item w3-button tablink w3-red w3-animate-bottom" onclick = "game_news(event, 'font_color')">Font Color</a></li>
  <li><a class = "w3-bar-item w3-button tablink w3-red w3-animate-top" onclick = "game_news(event, 'font_style')">Font Style</a></li>
</ul>

<div id = "font_color" class = "w3-container w3-border city" style="display:none">

<table border="1" id = "game_table">
<tr><td>Font Color Settings:</td></tr>
<tr><td>Now Font Color Hex: <?php echo $GameRGB; ?></td></tr>
<tr><td>Now Font Color: <input type = "color" id = "t001" name = "favcolor" value = <?php echo $GameRGB; ?>></td></tr>
<tr><td>Red: <input name = "red_color" type = "number" id = "t001" min = "0" max = "255" value = <?php echo $red_color; ?>></td></tr>
<tr><td>Green: <input name = "green_color" type = "number" id = "t001" min = "0" max = "255" value = <?php echo $green_color; ?>></td></tr>
<tr><td>Blue: <input name = "blue_color" type = "number" id = "t001" min = "0" max = "255" value = <?php echo $blue_color; ?>></td></tr>
<tr><td align = "center"><input type = "submit" id = "t001" name = "show_rgb" value = "Confirm the Font Color"></td></tr>
</table>
</div>

<div id = "font_style" class = "w3-container w3-border city" style="display:none">
<table border="1" id = "game_table">
<tr><td>Font Style Settings:</td></tr>
<tr><td>Now Font Style: <?php echo $GameFont; ?></td></tr>
<tr><td>Select: <select name = "GameFont2" id = "t001" value = <?php echo $GameFont; ?>>
    <option value = <?php echo $GameFont; ?>><?php echo $GameFont; ?></option>
    <option value = "Algerian">Algerian</option>
    <option value = "Arial">Arial</option>
    <option value = "Chiller">Chiller</option>
    <option value = "Comic Sans MS">Comic Sans MS</option>
    <option value = "DFKai-SB">DFKai-SB</option>
    <option value = "Gigi">Gigi</option>
    <option value = "Lucida Calligraphy">Lucida Calligraphy</option>
    <option value = "Script MT Bold">Script MT Bold</option>
    <option value = "Segoe Script">Segoe Script</option>
    <option value = "Sylfaen">Sylfaen</option>
    <option value = "Times New Roman">Times New Roman</option>
    <option value = "Vivaldi">Vivaldi</option>
    </select></td></tr>
    
<tr><td align = "center"><input type = "submit" id = "t001" name = "show_font" value = "Confirm the Font Style"></td></tr>
</table>
</div>

<?php
if (!empty($_POST["show_rgb"])) {
  $color_hex = fromRGB("{$_POST['red_color']}", "{$_POST['green_color']}", "{$_POST['blue_color']}");
  $query3 = "UPDATE GAMESETTING SET GameRGB = '$color_hex' WHERE settingsID = $settingsID";
  $query4 = "UPDATE GAMESETTING SET red_color = '{$_POST['red_color']}' WHERE settingsID = $settingsID";
  $query5 = "UPDATE GAMESETTING SET green_color = '{$_POST['green_color']}' WHERE settingsID = $settingsID";
  $query6 = "UPDATE GAMESETTING SET blue_color = '{$_POST['blue_color']}' WHERE settingsID = $settingsID";
  $result3 = $conn->query($query3);
  $result4 = $conn->query($query4);
  $result5 = $conn->query($query5);
  $result6 = $conn->query($query6);

  header("location: display_font_page.php");
  echo "<script>alert('The font color hex is $color_hex. Please refresh the page and generate the font color.')</script>";
  
}

if (!empty($_POST["show_font"])) {
    $query3 = "UPDATE GAMESETTING SET GameFont =  '{$_POST['GameFont2']}' WHERE settingsID = $settingsID";
    $font_xxx = "{$_POST['GameFont2']}";
    $result3 = $conn->query($query3);
    header("location: display_font_page.php");
    echo "<script>alert('The font style is $font_xxx. Please refresh the page and generate the font style.')</script>";
    
  }
?>



</form>
</body>
</html>