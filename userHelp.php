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
	<title>Help | 12 Zodiac Card Playing</title>
    <link rel="stylesheet" href="landing_page.css">
</head>

<img src="Picture/NYHC_logo.png" width = "960" height = "270">
<input type="text" placeholder="**  Main Menu -->>  **" id = "search001" readonly>

<a href="signin.php" data-toggle="modal" data-dismiss="modal">Login</a> | 
<a href="register.php" data-toggle="modal" data-dismiss="modal">Register</a> | 
<a href="adminLogin.php" data-toggle="modal" data-dismiss="modal">Admin</a> | 
<a href="landing_page.php" data-toggle="modal" data-dismiss="modal">Back</a>

<br><br>
<p>12 Zodiac Card Playing System | Help</p>

<table border="1" id = "lp_table">

<tr><td>Question</td></tr>

<tr><td>(a) Have to getting started?</td></tr>
<tr><td>The start-up page of the 12 Zodiac Card Playing System is landing page 
        include register page, sign in page, latest news, novice information, activity image and help. 
        You can view the latest news and novice information to know information 
        about the game history and introduction.
</td></tr>
<tr><td><img src = "./Picture/help/landing_page.png"></td></tr>
<tr><td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td></tr>

<tr><td>(b) User Registration</td></tr>
<tr><td>The page for user registration is above the landing page. 
        User must register user account to play the card game. 
        User must fill in user name, user email, user sex and user password. 
        If you register complete will show the user ID and the message "You register successfully". 
        You will promote to game menu page.
</td></tr>
<tr><td><img src = "./Picture/help/register.png"></td></tr>
<tr><td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td></tr>

<tr><td>(c) User Login</td></tr>
<tr><td>The login page of the system consists of two required fields: user ID and password. 
        If you forgot you ID, you can use you email to login. 
        After filling this form, click the “Sign In” button to submit your login data. 
        If your name and password do not match, or do not belong to the same user account, 
        the error message “Your user ID, email or password is wrong.” is shown. 
        You will promote to game menu page.
</td></tr>
<tr><td><img src = "./Picture/help/login.png"></td></tr>
<tr><td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td></tr>

<tr><td>(d) Game Menu Page</td></tr>
<tr><td>If you have login the game, you will promote to game menu page. 
        You can view some picture button such as game mode select, reward, point redemption, user profile and settings. 
        This page will show you photo, name, level and current point in this above page.
</td></tr>
<tr><td><img src = "./Picture/help/game_menu.png"></td></tr>
<tr><td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td></tr>

<tr><td>(e) Game Setings</td></tr>
<tr><td>If you change the background or card style can click this button.
</td></tr>
<tr><td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td></tr>

<tr><td>(f) User Profile Page</td></tr>
<tr><td>You can view the user profile and update the user profile. 
        The user photo, name, email and password can change only.
        You can direct edit new information in text field. 
        If you complete the user profile update, you must click the “Save you profile” to complete the profile update. 
        You can view you ID, name, email, password, sex, first date come from this game, current point, level and the level exp.
</td></tr>
<tr><td><img src = "./Picture/help/profile.png"></td></tr>
<tr><td>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</td></tr>

</body>
</html>
