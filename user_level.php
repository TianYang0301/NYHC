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

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $userID = $result->fetch_assoc()['userID'];
    $result->data_seek($j);
    $userName = $result->fetch_assoc()['userName'];
    $result->data_seek($j);
    $userEmail = $result->fetch_assoc()['userEmail'];
    $result->data_seek($j);
    $userSex = $result->fetch_assoc()['userSex'];
    $result->data_seek($j);
    $userPassword = $result->fetch_assoc()['userPassword'];
    $result->data_seek($j);
    $userRegisterDate = $result->fetch_assoc()['userRegisterDate'];
    $result->data_seek($j);
    $userLevel = $result->fetch_assoc()['userLevel'];
    $result->data_seek($j);
    $userPoint = $result->fetch_assoc()['userPoint'];
    $result->data_seek($j);
    $userExp = $result->fetch_assoc()['userExp'];
    $result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
    $result->data_seek($j);
    $userImg = $result->fetch_assoc()['userImg'];
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
	<title>NYHC | User Level</title>
    <link rel="stylesheet" href="gameUI.css">
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



<form action = "" method = "POST">
<p>View <?php echo $userName; ?> Level &nbsp;<a href="user_profile.php"><input type="button" value="Back->" id = "game_button1"></a></p>
<center>
<table border = "1" id = "game_table">

<tr>
    <td colspan = 3 id = "t001" align = "center">You Level is <?php echo $userLevel?>.</td>
</tr>

<tr>
    <td colspan = 3 id = "t001" align = "center">You Exp is <?php echo $userExp?>.</td>
</tr>

<tr>
    <td colspan = 3 id = "t001" align = "center">Next Level (Level <?php $next_level = $userLevel + 1;
    echo $next_level; ?>) need <?php 
    //Level 1
    if ($userExp < 5000){
        $next_exp = 5000 - $userExp;
    } // Level 2
    if ($userExp > 4999 and $userExp < 15000){
        $next_exp = 15000 - $userExp;
    } // Level 3
    if ($userExp > 14999 and $userExp < 35000){
        $next_exp = 35000 - $userExp;
    } // Level 4
    if ($userExp > 34999 and $userExp < 60000){
        $next_exp = 60000 - $userExp;
    } // Level 5
    if ($userExp > 59999 and $userExp < 90000){
        $next_exp = 90000 - $userExp;
    } // Level 6
    if ($userExp > 89999 and $userExp < 130000){
        $next_exp = 130000 - $userExp;
    } // Level 7
    if ($userExp > 129999 and $userExp < 180000){
        $next_exp = 180000 - $userExp;
    } // Level 8
    if ($userExp > 179999 and $userExp < 240000){
        $next_exp = 240000 - $userExp;
    } // Level 9
    if ($userExp > 239999 and $userExp < 310000){
        $next_exp = 310000 - $userExp;
    } // Level 10
    if ($userExp > 309999 and $userExp < 390000){
        $next_exp = 390000 - $userExp;
    } // Level 11
    if ($userExp > 389999 and $userExp < 480000){
        $next_exp = 480000 - $userExp;
    } // Level 12
    if ($userExp > 479999 and $userExp < 580000){
        $next_exp = 580000 - $userExp;
    } // Level 13
    if ($userExp > 579999 and $userExp < 690000){
        $next_exp = 690000 - $userExp;
    } // Level 14
    if ($userExp > 689999 and $userExp < 810000){
        $next_exp = 810000 - $userExp;
    } // Level 15
    if ($userExp > 809999 and $userExp < 940000){
        $next_exp = 940000 - $userExp;
    } // Level 16
    if ($userExp > 939999 and $userExp < 1080000){
        $next_exp = 1080000 - $userExp;
    } // Level 17
    if ($userExp > 1079999 and $userExp < 1230000){
        $next_exp = 1230000 - $userExp;
    } // Level 18
    if ($userExp > 1229999 and $userExp < 1390000){
        $next_exp = 1390000 - $userExp;
    } // Level 19
    if ($userExp > 1389999 and $userExp < 1560000){
        $next_exp = 1560000 - $userExp;
    } // Level 20
    if ($userExp > 1559999 and $userExp < 1740000){
        $next_exp = 1740000 - $userExp;
    } // Level 21
    if ($userExp > 1739999 and $userExp < 1930000){
        $next_exp = 1930000 - $userExp;
    } // Level 22
    if ($userExp > 1929999 and $userExp < 2130000){
        $next_exp = 2130000 - $userExp;
    } // Level 23
    if ($userExp > 2129999 and $userExp < 2340000){
        $next_exp = 2340000 - $userExp;
    } // Level 24
    if ($userExp > 2339999 and $userExp < 2560000){
        $next_exp = 2560000 - $userExp;
    } // Level 25
    if ($userExp > 2559999 and $userExp < 2790000){
        $next_exp = 2790000 - $userExp;
    } // Level 26
    if ($userExp > 2789999 and $userExp < 3130000){
        $next_exp = 3130000 - $userExp;
    } // Level 27
    if ($userExp > 3129999 and $userExp < 3380000){
        $next_exp = 3380000 - $userExp;
    } // Level 28
    if ($userExp > 3379999 and $userExp < 3640000){
        $next_exp = 3640000 - $userExp;
    } // Level 29
    if ($userExp > 3639999 and $userExp < 3910000){
        $next_exp = 3910000 - $userExp;
    } // Level 30
    if ($userExp > 3909999){
        $next_exp = 9999999 - $userExp;
    }

    echo $next_exp ?> exp. </td>
</tr>

<tr>
<td colspan = 3 id = "t001" align = "center">Hints: Bet 100 Points can get 1 exp.</td>
</tr>


<tr colspan = 3 id = "t001" align = "center">
    <td>Level</td>
    <td>Exp Area</td>
    <td>Remark</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>1</td>
    <td>0-4,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>2</td>
    <td>5,000-14,999</td>
    <td>Guess Point (8 cards) <br>
        High Point Bits</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>3</td>
    <td>15,000-34,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>4</td>
    <td>35,000-59,999</td>
    <td>Guess Point (10 cards) <br>
        High Bits for 8 Cards Guess Points</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>5</td>
    <td>60,000-89,999</td>
    <td>Guess Point (12 cards)</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>6</td>
    <td>90,000-129,999</td>
    <td>High Bits for 10 Cards Guess Points</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>7</td>
    <td>130,000-179,999</td>
    <td>Guess Point (15 cards)</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>8</td>
    <td>180,000-239,999</td>
    <td>High Bits for 12 Cards Guess Points</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>9</td>
    <td>240,000-309,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>10</td>
    <td>310,000-389,999</td>
    <td>High Bits for 15 Cards Guess Points</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>11</td>
    <td>390,000-479,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>12</td>
    <td>480,000-579,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>13</td>
    <td>580,000-689,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>14</td>
    <td>690,000-809,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>15</td>
    <td>810,000-939,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>16</td>
    <td>940,000-1,079,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>17</td>
    <td>1,080,000-1,229,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>18</td>
    <td>1,230,000-1,389,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>19</td>
    <td>1,390,000-1,559,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>20</td>
    <td>1,560,000-1,739,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>21</td>
    <td>1,740,000-1,929,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>22</td>
    <td>1,930,000-2,129,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>23</td>
    <td>2,130,000-2,339,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>24</td>
    <td>2,340,000-2,559,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>25</td>
    <td>2,560,000-2,789,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>26</td>
    <td>2,790,000-3,129,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>27</td>
    <td>3,130,000-3,379,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>28</td>
    <td>3,380,000-3,639,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>29</td>
    <td>3,640,000-3,909,999</td>
    <td>-</td>
</tr>

<tr colspan = 3 id = "t001" align = "center">
    <td>30</td>
    <td>3,910,000-9,999,999</td>
    <td>-</td>
</tr>

</table>

<?php

?>
</form>