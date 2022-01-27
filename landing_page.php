<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<title>12 Zodiac Card Playing</title>
    <link rel="stylesheet" href="landing_page.css">
</head>

<body>

<img src="Picture/NYHC_logo.png" width = "960" height = "270">
<input type="text" placeholder="**  Main Menu -->>  **" id = "search001" readonly>

<a href="signin.php" data-toggle="modal" data-dismiss="modal">Login</a> | 
<a href="register.php" data-toggle="modal" data-dismiss="modal">Register</a> | 
<a href="adminLogin.php" data-toggle="modal" data-dismiss="modal">Admin</a> | 
<a href="userHelp.php" data-toggle="modal" data-dismiss="modal">Help</a>

<br><br>
<a href="lastest_new.php"><input type="button" value="Lastest News" id = "newsButton"></a>
<a href="novice_info.php"><input type="button" value="Novice Info" id = "newsButton"></a>

<br><br>
<table id = "lp_table">
<tr><td>
<button class="pictureSlide_Left" onclick="plusDivs(-1)" id = "ss002">&#10094;</button>
</td><td>
<img class="mySlides" src="Picture/news-001.png" id = "ss001">
<img class="mySlides" src="Picture/lucky_draw_winter2021.png" id = "ss001">
<img class="mySlides" src="Picture/draw_spring2022_en.png" id = "ss001">
</td><td>
<button class="pictureSlide_Right" onclick="plusDivs(+1)" id = "ss002">&#10095;</button>
</td></tr>
</table>


</body>


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

<?php
ignore_user_abort();
set_time_limit(0);

date_default_timezone_set("Asia/Shanghai");
echo date("Y-m-d") ,"&nbsp";
echo date("H:i:s");
?>