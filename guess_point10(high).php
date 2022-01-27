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

$query = "SELECT * FROM NYHCUser, NYHCGameMode";
$result = $conn->query($query);
$rows = $result->num_rows;
$conn->query($query);

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
    $userExp = $result->fetch_assoc()['userExp'];
	$result->data_seek($j);
    $userImg = $result->fetch_assoc()['userImg'];
	$result->data_seek($j);
    $userCard = $result->fetch_assoc()['userCard'];
	$result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
	$result->data_seek($j);
    $user_bit_num = $result->fetch_assoc()['user_bit_num'];
}

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $GMName = $result->fetch_assoc()['GMName'];
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
	<title>Playing</title>
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
<p>Game Mode Playing &nbsp; 
    <a href="game_menu.php"><input type="button" value="Back" id = "game_button1"></a>
</p>
<p>Your choose Guess Point (10 Cards)</p>
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
	<tr>
		<td colspan = "4">You Exp <?php echo $userExp; ?></td>
	</tr>
</table>

<p>More cards to guess (High Points Version):
	<br>
<input type = "submit" name = "card_5(High)" value = "5 Card" id = "game_button1">
<input type = "submit" name = "card_8(High)" value = "8 Card" id = "game_button1">
<input type = "submit" name = "card_12(High)" value = "12 Card" id = "game_button1">
<input type = "submit" name = "card_15(High)" value = "15 Card" id = "game_button1">
</p>

<p>Change the bet values: 
	<input type = "submit" name = "change_bet" value = "Turn" id = "game_button1">
</p>

</body>
</html>

<?php
if (!empty($_POST["card_5(High)"])) {
	echo "<script>alert('Welcome to 5 Cards Guess Point!')</script>";
	header("location: guess_point(high).php");
}

if (!empty($_POST["card_8(High)"])) {
	echo "<script>alert('Welcome to 8 Cards Guess Point!')</script>";
	header("location: guess_point8(High).php");
}

if (!empty($_POST["card_12(High)"])) {
	if ($userLevel > 7){
	echo "<script>alert('Welcome to 12 Cards Guess Point!')</script>";
	header("location: guess_point12(High).php");
	}else{
		echo "<script>alert('You Level is no enough, the target level is level 8!')</script>";
		$step = 0;
		$init = 0;
		$random_flag = 1;
		$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
		$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
		$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
		$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
		$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
		$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
		$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
		$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
		$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
		$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
		$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
		$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
		$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
		$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
		$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
		$c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
		$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
		$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
		$c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
		$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
		$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
		$c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
		$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
		$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
		$c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
		$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
		$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
		$c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
		$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
		$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;

		$cards = array (
			1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
			2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
			3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
			4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
			5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
			6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
			7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
			8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
			9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
			10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
		);
		$msg = "Choose The Point Area!";
	}
}

if (!empty($_POST["card_15(High)"])) {
	if ($userLevel > 9){
	echo "<script>alert('Welcome to 15 Cards Guess Point!')</script>";
	header("location: guess_point15(high).php");
	}else{
		echo "<script>alert('You Level is no enough, the target level is level 10!')</script>";
		$step = 0;
		$init = 0;
		$random_flag = 1;
		$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
		$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
		$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
		$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
		$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
		$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
		$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
		$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
		$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
		$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
		$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
		$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
		$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
		$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
		$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
		$c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
		$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
		$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
		$c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
		$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
		$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
		$c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
		$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
		$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
		$c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
		$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
		$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
		$c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
		$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
		$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;

		$cards = array (
			1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
			2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
			3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
			4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
			5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
			6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
			7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
			8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
			9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
			10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
		);
		$msg = "Choose The Point Area!";
	}
}
if (!empty($_POST["change_bet"])) {
	header("location: change_bet_cards_10.php");
}
?>

</body>
</html>

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

$query = "SELECT * FROM NYHCUser, NYHCGameMode";
$result = $conn->query($query);
$rows = $result->num_rows;
$conn->query($query);

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
    $userExp = $result->fetch_assoc()['userExp'];
    $result->data_seek($j);
    $userBackground = $result->fetch_assoc()['userBackground'];
	$result->data_seek($j);
    $userImg = $result->fetch_assoc()['userImg'];
	$result->data_seek($j);
    $userCard = $result->fetch_assoc()['userCard'];
	$result->data_seek($j);
    $user_bit_num = $result->fetch_assoc()['user_bit_num'];
}

for($j = 0, $noNumber = 1; $j < $rows; ++$j, $noNumber++){
    $result->data_seek($j);
    $GMName = $result->fetch_assoc()['GMName'];
}

$debug = 0;	
$test = 0; 
$init = 0;
$random_flag = 0;
$exp_plus = 0;

$d1 = "01";	
$d2 = "02";	
$d3 = "03";
$d4 = "04";	  
$c_ext = ".png";

$app_name = "NYHC - Guess Point (10 Cards)";
$init_exp = (empty($_COOKIE["pref_init_exp"]))	? $userExp : $_COOKIE["pref_init_exp"] ;
$init_bal = (empty($_COOKIE["pref_init_bal"]))	? $userPoint : $_COOKIE["pref_init_bal"] ;
$init_bet = (empty($_COOKIE["pref_init_bet"]))	? $user_bit_num : $_COOKIE["pref_init_bet"] ;

$card_size = (empty($_COOKIE["pref_card_size"])) ? 0 : $_COOKIE["pref_card_size"] ;
if ($card_size == 0) {
	$c_path = "./Picture/$userCard/";
	$c_size = "";
} else {
	$c_path = "./Picture/$userCard/";
	$c_size = "";
}

$page_css = (empty($_COOKIE["pref_page_css"])) 	? "./gameUI.css" : $_COOKIE["pref_page_css"] ;
$page_header = "
		<head>
			<title>NYHC Five King</title>
			<link rel=\"stylesheet\" href=\"./css/$page_css\" rel=\"stylesheet\" type=\"text/css\">		
		</head>";

$pack = array(
	 1 => array(1 => $c_path . $d1 ."-01" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-01" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-01" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-01" . $c_size . $c_ext ),
	 2 => array(1 => $c_path . $d1 ."-02" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-02" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-02" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-02" . $c_size . $c_ext ),
	 3 => array(1 => $c_path . $d1 ."-03" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-03" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-03" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-03" . $c_size . $c_ext ),
	 4 => array(1 => $c_path . $d1 ."-04" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-04" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-04" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-04" . $c_size . $c_ext ),
	 5 => array(1 => $c_path . $d1 ."-05" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-05" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-05" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-05" . $c_size . $c_ext ),
	 6 => array(1 => $c_path . $d1 ."-06" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-06" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-06" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-06" . $c_size . $c_ext ),
	 7 => array(1 => $c_path . $d1 ."-07" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-07" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-07" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-07" . $c_size . $c_ext ),
	 8 => array(1 => $c_path . $d1 ."-08" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-08" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-08" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-08" . $c_size . $c_ext ),
	 9 => array(1 => $c_path . $d1 ."-09" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-09" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-09" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-09" . $c_size . $c_ext ),
	 10 => array(1 => $c_path . $d1 ."-10" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-10" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-10" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-10" . $c_size . $c_ext ),
	 11 => array(1 => $c_path . $d1 ."-11" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-11" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-11" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-11" . $c_size . $c_ext ),
	 12 => array(1 => $c_path . $d1 ."-12" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-12" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-12" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-12" . $c_size . $c_ext )
	); 
    
if (empty($_POST["step"])) { 
	$step = 0;
	$random_flag = 1;
	$init = 0;
	$balance = $init_bal ;
	$bet= $init_bet ;
	$exp_plus = $init_exp;
	$msg = "Welcome to NYHC Game!<br>";
	$record_point = "";
} else {
	if (!empty($_POST["btn_pref_save"])) {
		setcookie("pref_player", 	$_POST["pref_player"]);
		setcookie("pref_init_bal", 	$_POST["pref_init_bal"]);
		setcookie("pref_init_exp", 	$_POST["pref_init_exp"]);
		setcookie("pref_init_bet", 	$_POST["pref_init_bet"]);
		setcookie("pref_bet_up",   	$_POST["pref_bet_up"]);
		setcookie("pref_bet_down", 	$_POST["pref_bet_down"]);
		setcookie("pref_card_size", $_POST["pref_card_size"]);
		setcookie("pref_card_style",$_POST["pref_card_style"]);
		setcookie("pref_card_color",$_POST["pref_card_color"]);
		setcookie("pref_page_css",	$_POST["pref_page_css"]);

		$msg = "Preferences saved.<br>Some preferences may reflect in next step.<br>";
		$step = 0;
		$random_flag = 1;

	} elseif (!empty($_POST["btn_pref_cancel"])) {
		$msg = "Preferences not saved.<br>";
		$step = 0;
		$random_flag = 1;
	}		

	$step = $_POST["step"];
	$init = $_POST["init"];
	$balance = $_POST["balance"];
	$exp_plus = $_POST["exp_plus"];
	$bet = $_POST["bet"];

	$query1 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
	$result = $conn->query($query1);
	$conn->query($query1);

	$query2 = "UPDATE NYHCUser SET userExp = $exp_plus WHERE userID = $userID";
	$result = $conn->query($query2);
	$conn->query($query2);

    if (!empty ($_POST["point18_28"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 8: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 120); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point29_40"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 7: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 100); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point41_52"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 6: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 80); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point53_64"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 5: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 60); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point65_76"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 4: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 60); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point77_88"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 3: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 80); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point89_100"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 2: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 100); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    if (!empty ($_POST["point101_112"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),  
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result2 = get_result();
				switch ($result2) {
					case 1: 
                        $msg = "You Win! <br> Total point is $total_point!";
                        $balance += ($bet * 120); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is $total_point";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
							
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
							//$record_point = $total_point;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

	if (!empty ($_POST["point_odd"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
                    5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)           
				);
				
				$result3 = get_result2();
				switch ($result3) {
					case 6: 
                        $msg = "You Win! <br> Total point is odd point ($total_point)!";
                        $balance += ($bet * 2); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is even point ($total_point)!";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

	if (!empty ($_POST["point_even"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
				$c1c = (empty($_POST["cb_card"][1])) ? SelectCard() :$_POST["c1c"] ;
				$c1d = (empty($_POST["cb_card"][1])) ? SelectDeck() :$_POST["c1d"] ;
				$c1f = (empty($_POST["cb_card"][1])) ? 0 :1 ;
				$c2c = (empty($_POST["cb_card"][2])) ? SelectCard() :$_POST["c2c"] ;
				$c2d = (empty($_POST["cb_card"][2])) ? SelectDeck() :$_POST["c2d"] ;
				$c2f = (empty($_POST["cb_card"][2])) ? 0 :1 ;
				$c3c = (empty($_POST["cb_card"][3])) ? SelectCard() :$_POST["c3c"] ;
				$c3d = (empty($_POST["cb_card"][3])) ? SelectDeck() :$_POST["c3d"] ;
				$c3f = (empty($_POST["cb_card"][3])) ? 0 :1 ;
				$c4c = (empty($_POST["cb_card"][4])) ? SelectCard() :$_POST["c4c"] ;
				$c4d = (empty($_POST["cb_card"][4])) ? SelectDeck() :$_POST["c4d"] ;
				$c4f = (empty($_POST["cb_card"][4])) ? 0 :1 ;
				$c5c = (empty($_POST["cb_card"][5])) ? SelectCard() :$_POST["c5c"] ;
				$c5d = (empty($_POST["cb_card"][5])) ? SelectDeck() :$_POST["c5d"] ;
				$c5f = (empty($_POST["cb_card"][5])) ? 0 :1 ;
                $c6c = (empty($_POST["cb_card"][6])) ? SelectCard() :$_POST["c6c"] ;
				$c6d = (empty($_POST["cb_card"][6])) ? SelectDeck() :$_POST["c6d"] ;
				$c6f = (empty($_POST["cb_card"][6])) ? 0 :1 ;
                $c7c = (empty($_POST["cb_card"][7])) ? SelectCard() :$_POST["c7c"] ;
				$c7d = (empty($_POST["cb_card"][7])) ? SelectDeck() :$_POST["c7d"] ;
				$c7f = (empty($_POST["cb_card"][7])) ? 0 :1 ;
                $c8c = (empty($_POST["cb_card"][8])) ? SelectCard() :$_POST["c8c"] ;
				$c8d = (empty($_POST["cb_card"][8])) ? SelectDeck() :$_POST["c8d"] ;
				$c8f = (empty($_POST["cb_card"][8])) ? 0 :1 ;
                $c9c = (empty($_POST["cb_card"][9])) ? SelectCard() :$_POST["c9c"] ;
				$c9d = (empty($_POST["cb_card"][9])) ? SelectDeck() :$_POST["c9d"] ;
				$c9f = (empty($_POST["cb_card"][9])) ? 0 :1 ;
                $c10c = (empty($_POST["cb_card"][10])) ? SelectCard() :$_POST["c10c"] ;
				$c10d = (empty($_POST["cb_card"][10])) ? SelectDeck() :$_POST["c10d"] ;
				$c10f = (empty($_POST["cb_card"][10])) ? 0 :1 ;
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
                    5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0),
					7 => array( 1 => $c7c, 2 => $c7d, 3 => $c7f, 4 => 0),
					8 => array( 1 => $c8c, 2 => $c8d, 3 => $c8f, 4 => 0),
                    9 => array( 1 => $c9c, 2 => $c9d, 3 => $c9f, 4 => 0),
					10 => array( 1 => $c10c, 2 => $c10d, 3 => $c10f, 4 => 0)        
				);
				
				$result3 = get_result2();
				switch ($result3) {
					case 7: 
                        $msg = "You Win! <br> Total point is even point ($total_point)!";
                        $balance += ($bet * 2); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> Total point is odd point ($total_point)!";
						if ($balance < $bet) {
							$bet = $balance;
							$balance = 0;
							$msg .= "<br>Balance is Zero.";
						} else {
							$balance = $balance - $bet;
							$userPoint = $balance;
							$exp_plus = ($bet * 0.01) + $userExp;
							$userExp = $exp_plus;
						}
				}
				$random_flag = 0;
			} else {			
				$random_flag = 1;
				$step = 0;
			}
		}
	} 

    elseif (!empty($_POST["btn_plus"])) {
		$step = 0; 
		$random_flag = 1;

		if ($balance > $bet_up) {
			$bet = $bet + $bet_up;
			$balance = $balance - $bet_up;
		} else {
			$bet = $bet + $balance ;
			$balance = 0;
		}
	} 
    elseif (!empty($_POST["btn_minus"])) {
		$step = 0;
		$random_flag = 1;

		if ($bet > $bet_down) {
			$bet = $bet - $bet_down;
			$balance = $balance + $bet_down;
		} else {
		}
	} 
    elseif (!empty($_POST["btn_new"])) {
		$balance = $init_bal; 
		//$bet = $init_bet;		
		$step = 0;
		$init = 0;
		$random_flag = 1;
		$userPoint = $balance;
		$userExp = $exp_plus;
	} 

    elseif (!empty($_POST["btn_about"])) {
		$step = 4;
		$random_flag = 1;
	} 
}


if ($random_flag) {
	$msg = "Choose The Point Area!";

	$cards = array (
				1 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				2 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				3 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				4 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				5 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),    
                6 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				7 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				8 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),  
                9 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				10 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				);
}

switch ($step) {
case 0:
	$card_1 = card_img($cards[1][1],$cards[1][2]);
	$card_2 = card_img($cards[2][1],$cards[2][2]);
	$card_3 = card_img($cards[3][1],$cards[3][2]);
	$card_4 = card_img($cards[4][1],$cards[4][2]);
	$card_5 = card_img($cards[5][1],$cards[5][2]);
    $card_6 = card_img($cards[6][1],$cards[6][2]);
	$card_7 = card_img($cards[7][1],$cards[7][2]);
	$card_8 = card_img($cards[8][1],$cards[8][2]);
    $card_9 = card_img($cards[9][1],$cards[9][2]);
	$card_10 = card_img($cards[10][1],$cards[10][2]);

	echo " $page_header
		<body>
		<form name=\"post\" action=\"$_SERVER[PHP_SELF]\" method=\"POST\">
		<table border=1 cellspacing=1 cellpadding=1 align=center id = 'game_table'>
			<tr><td colspan = 10 align=center><b>$app_name</i></td></tr>
			<tr ALIGN=CENTER >
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
                <td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
                <td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160></tr>
			<tr><td colspan = 8 align=center >$msg</td>
				<td><input type=\"submit\" name= \"btn_new\" value=\"New\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"btn_about\" value=\"About\" id = 'game_button1'></td>  
            </tr>
			<tr align = center>
     			<td><input type=\"submit\" name= \"point18_28\" value=\"18-28\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"point29_40\" value=\"29-40\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"point41_52\" value=\"41-52\" id = 'game_button1'></td>
    			<td><input type=\"submit\" name= \"point53_64\" value=\"53-64\" id = 'game_button1'></td>
			    <td><input type=\"submit\" name= \"point65_76\" value=\"65-76\" id = 'game_button1'></td>
                <td><input type=\"submit\" name= \"point77_88\" value=\"77-88\" id = 'game_button1'></td>
                <td colspan = 4 align = center>You Point: " . number_format($balance,0,'.',',') . "</td>
				

			<tr align = center>
               <td><input type=\"submit\" name= \"point89_100\" value=\"89-100\" id = 'game_button1'></td>
               <td></td>
               <td><input type=\"submit\" name= \"point101_112\" value=\"101-112\" id = 'game_button1'></td>
			   <td><input type=\"submit\" name= \"point_odd\" value=\"Odd\" id = 'game_button1'></td>
			   <td></td>
			   <td><input type=\"submit\" name= \"point_even\" value=\"Even\" id = 'game_button1'></td>
               <td colspan = 3 align = center>You Bet: ". number_format($bet , 0 , '.' , '.') ."</td>
               <td><input type=\"submit\" name= \"btn_plus\" value=\" + \" id = 'game_button11'>
               <input type=\"submit\" name= \"btn_minus\" value=\" - \" id = 'game_button11'></td>

				<input type=\"hidden\" name=\"step\" value=1>		
				<input type=\"hidden\" name=\"init\" value=0>		
				<input type=\"hidden\" name=\"balance\" value=$balance>		
				<input type=\"hidden\" name=\"bet\" value=$bet>	
				<input type=\"hidden\" name=\"exp_plus\" value=$exp_plus>	
				<input type=\"hidden\" name=\"c1c\" value= " . $cards[1][1] . ">		
				<input type=\"hidden\" name=\"c1d\" value= " . $cards[1][2] . ">		
				<input type=\"hidden\" name=\"c2c\" value= " . $cards[2][1] . ">		
				<input type=\"hidden\" name=\"c2d\" value= " . $cards[2][2] . ">		
				<input type=\"hidden\" name=\"c3c\" value= " . $cards[3][1] . ">		
				<input type=\"hidden\" name=\"c3d\" value= " . $cards[3][2] . ">		
				<input type=\"hidden\" name=\"c4c\" value= " . $cards[4][1] . ">		
				<input type=\"hidden\" name=\"c4d\" value= " . $cards[4][2] . ">		
				<input type=\"hidden\" name=\"c5c\" value= " . $cards[5][1] . ">		
				<input type=\"hidden\" name=\"c5d\" value= " . $cards[5][2] . ">
                <input type=\"hidden\" name=\"c6c\" value= " . $cards[6][1] . ">		
				<input type=\"hidden\" name=\"c6d\" value= " . $cards[6][2] . ">		
				<input type=\"hidden\" name=\"c7c\" value= " . $cards[7][1] . ">		
				<input type=\"hidden\" name=\"c7d\" value= " . $cards[7][2] . ">		
				<input type=\"hidden\" name=\"c8c\" value= " . $cards[8][1] . ">		
				<input type=\"hidden\" name=\"c8d\" value= " . $cards[8][2] . ">
                <input type=\"hidden\" name=\"c9c\" value= " . $cards[9][1] . ">		
				<input type=\"hidden\" name=\"c9d\" value= " . $cards[9][2] . ">		
				<input type=\"hidden\" name=\"c10c\" value= " . $cards[10][1] . ">		
				<input type=\"hidden\" name=\"c10d\" value= " . $cards[10][2] . ">   </tr>
		</table>
		</form>
		</body>";
	break;

case 1: // Deal Zodiac
	$card_1 = card_img($cards[1][1],$cards[1][2]);
	$card_2 = card_img($cards[2][1],$cards[2][2]);
	$card_3 = card_img($cards[3][1],$cards[3][2]);
	$card_4 = card_img($cards[4][1],$cards[4][2]);
	$card_5 = card_img($cards[5][1],$cards[5][2]);
    $card_6 = card_img($cards[6][1],$cards[6][2]);
	$card_7 = card_img($cards[7][1],$cards[7][2]);
	$card_8 = card_img($cards[8][1],$cards[8][2]);
    $card_9 = card_img($cards[9][1],$cards[9][2]);
	$card_10 = card_img($cards[10][1],$cards[10][2]);

	if ($balance == 0 and $bet == 0) {
		$msg 		.= "<br>Balance and Bet is exhausted. <br>You can continue to play...for nothing.";
	}
	echo "$page_header
		<body>
		<form name=\"post\" action=\"$_SERVER[PHP_SELF]\" method=\"POST\">

		<table border=1 cellspacing=1 cellpadding=1 align=center>
		<tr><td colspan = 10 align=center><b>$app_name</i></td></tr>
			<tr ALIGN=CENTER >
				<td> <IMG SRC=" . $card_1 .  " ALT=Card1 width = 90 height = 160>
				<td> <IMG SRC=" . $card_2 .  " ALT=Card2 width = 90 height = 160>
				<td> <IMG SRC=" . $card_3 .  " ALT=Card3 width = 90 height = 160>
				<td> <IMG SRC=" . $card_4 .  " ALT=Card4 width = 90 height = 160>
				<td> <IMG SRC=" . $card_5 .  " ALT=Card5 width = 90 height = 160>
                <td> <IMG SRC=" . $card_6 .  " ALT=Card3 width = 90 height = 160>
				<td> <IMG SRC=" . $card_7 .  " ALT=Card4 width = 90 height = 160>
				<td> <IMG SRC=" . $card_8 .  " ALT=Card5 width = 90 height = 160>
                <td> <IMG SRC=" . $card_9 .  " ALT=Card4 width = 90 height = 160>
				<td> <IMG SRC=" . $card_10 .  " ALT=Card5 width = 90 height = 160></tr>
			</tr>
            <tr><td colspan = 8 align=center >$msg</td>
            <td><input type=\"submit\" name= \"btn_new\" value=\"New\" id = 'game_button1'></td>
            <td><input type=\"submit\" name= \"btn_about\" value=\"About\" id = 'game_button1'></td>  
        </tr>
        <tr align = center>
             <td><input type=\"submit\" name= \"point18_28\" value=\"18-28\" id = 'game_button1'></td>
            <td><input type=\"submit\" name= \"point29_40\" value=\"29-40\" id = 'game_button1'></td>
            <td><input type=\"submit\" name= \"point41_52\" value=\"41-52\" id = 'game_button1'></td>
            <td><input type=\"submit\" name= \"point53_64\" value=\"53-64\" id = 'game_button1'></td>
            <td><input type=\"submit\" name= \"point65_76\" value=\"65-76\" id = 'game_button1'></td>
            <td><input type=\"submit\" name= \"point77_88\" value=\"77-88\" id = 'game_button1'></td>
            <td colspan = 4 align = center>You Point: " . number_format($balance,0,'.',',') . "</td>
            

        <tr align = center>
           <td><input type=\"submit\" name= \"point89_100\" value=\"89-100\" id = 'game_button1'></td>
           <td></td>
           <td><input type=\"submit\" name= \"point101_112\" value=\"101-112\" id = 'game_button1'></td>
           <td><input type=\"submit\" name= \"point_odd\" value=\"Odd\" id = 'game_button1'></td>
           <td></td>
           <td><input type=\"submit\" name= \"point_even\" value=\"Even\" id = 'game_button1'></td>
           <td colspan = 3 align = center>You Bet: ". number_format($bet , 0 , '.' , '.') ."</td>
           <td><input type=\"submit\" name= \"btn_plus\" value=\" + \" id = 'game_button11'>
           <input type=\"submit\" name= \"btn_minus\" value=\" - \" id = 'game_button11'></td>

            <input type=\"hidden\" name=\"step\" value=1>		
            <input type=\"hidden\" name=\"init\" value=0>		
            <input type=\"hidden\" name=\"balance\" value=$balance>		
            <input type=\"hidden\" name=\"bet\" value=$bet>
			<input type=\"hidden\" name=\"exp_plus\" value=$exp_plus>		
            <input type=\"hidden\" name=\"c1c\" value= " . $cards[1][1] . ">		
            <input type=\"hidden\" name=\"c1d\" value= " . $cards[1][2] . ">		
            <input type=\"hidden\" name=\"c2c\" value= " . $cards[2][1] . ">		
            <input type=\"hidden\" name=\"c2d\" value= " . $cards[2][2] . ">		
            <input type=\"hidden\" name=\"c3c\" value= " . $cards[3][1] . ">		
            <input type=\"hidden\" name=\"c3d\" value= " . $cards[3][2] . ">		
            <input type=\"hidden\" name=\"c4c\" value= " . $cards[4][1] . ">		
            <input type=\"hidden\" name=\"c4d\" value= " . $cards[4][2] . ">		
            <input type=\"hidden\" name=\"c5c\" value= " . $cards[5][1] . ">		
            <input type=\"hidden\" name=\"c5d\" value= " . $cards[5][2] . ">
            <input type=\"hidden\" name=\"c6c\" value= " . $cards[6][1] . ">		
            <input type=\"hidden\" name=\"c6d\" value= " . $cards[6][2] . ">		
            <input type=\"hidden\" name=\"c7c\" value= " . $cards[7][1] . ">		
            <input type=\"hidden\" name=\"c7d\" value= " . $cards[7][2] . ">		
            <input type=\"hidden\" name=\"c8c\" value= " . $cards[8][1] . ">		
            <input type=\"hidden\" name=\"c8d\" value= " . $cards[8][2] . ">
            <input type=\"hidden\" name=\"c9c\" value= " . $cards[9][1] . ">		
            <input type=\"hidden\" name=\"c9d\" value= " . $cards[9][2] . ">		
            <input type=\"hidden\" name=\"c10c\" value= " . $cards[10][1] . ">		
            <input type=\"hidden\" name=\"c10d\" value= " . $cards[10][2] . ">   </tr>
		</table>
		</form>
		</body>
	";
	break;
case 4:
 	// 	About page
	echo "$page_header
		<body>
		<table border=1 cellspacing=1 cellpadding=1 align=center>
			<tr><td align = center colspan = 6><b>$app_name</b></td></tr>
			<tr><td align = center colspan = 6><b>About Guess Point (10 Cards)</b></td></tr>

			<tr><td align = center colspan = 5>
			<table>
			<tr><td align = center><b>**Winning Reward**</b></td></tr>
			<tr><td>Between Point</td><td align = right>Point</td></tr>
			<tr><td>101-112</td><td align = right>120</td></tr>
			<tr><td>18-28</td><td align = right>120</td></tr>
			<tr><td>89-100</td><td align = right>100</td></tr>
			<tr><td>29-40</td><td align = right>100</td></tr>
			<tr><td>77-88</td><td align = right>80</td></tr>
            <tr><td>41-52</td><td align = right>80</td></tr>
			<tr><td>65-76</td><td align = right>60</td></tr>
			<tr><td>53-64</td><td align = right>60</td></tr>
            <tr><td>Odd</td><td align = right>2</td></tr>
			<tr><td>Even</td><td align = right>2</td></tr>

			</table>

			</td></tr>
			<tr><td align=center colspan=5><a href=$_SERVER[PHP_SELF]>Back</a></td></tr>
		</table>
		</body>	";
	break;
}


/*=============================================================================
	Functions 
=============================================================================*/
function get_result() {
	global $cards;
    global $total_point;
	
	for ($i = 1; $i <= 10; $i++ ) {	
		if 		($cards[$i][1] == 1) {$total_point = $total_point + 1;}
		elseif 	($cards[$i][1] == 2) {$total_point = $total_point + 2;}
		elseif 	($cards[$i][1] == 3) {$total_point = $total_point + 3;}
		elseif 	($cards[$i][1] == 4) {$total_point = $total_point + 4;}
		elseif 	($cards[$i][1] == 5) {$total_point = $total_point + 5;}
		elseif 	($cards[$i][1] == 6) {$total_point = $total_point + 6;}
		elseif 	($cards[$i][1] == 7) {$total_point = $total_point + 7;}
		elseif 	($cards[$i][1] == 8) {$total_point = $total_point + 8;}
		elseif 	($cards[$i][1] == 9) {$total_point = $total_point + 9;}
		elseif 	($cards[$i][1] == 10) {$total_point = $total_point + 10;}
		elseif 	($cards[$i][1] == 11) {$total_point = $total_point + 11;}
		elseif 	($cards[$i][1] == 12) {$total_point = $total_point + 12;}
	}
    
	$result2 = 0;

	if($result2 == 0){
        if(($total_point > 100) and ($total_point < 113)){
			$result2 = 1;
        }
    }
    
    if($result2 == 0){
        if(($total_point > 88) and ($total_point < 101)){
		    $result2 = 2;
        }
    }

    if($result2 == 0){
        if(($total_point > 76) and ($total_point < 89)){
		    $result2 = 3;
        }
    }

    if($result2 == 0){
        if(($total_point > 64) and ($total_point < 77)){
		    $result2 = 4;
        }
    }

    if($result2 == 0){
        if(($total_point > 52) and ($total_point < 65)){
		    $result2 = 5;
        }
    }

    if($result2 == 0){
        if(($total_point > 40) and ($total_point < 53)){
		    $result2 = 6;
        }
    }

    if($result2 == 0){
        if(($total_point > 28) and ($total_point < 41)){
		    $result2 = 7;
        }
    }

    if($result2 == 0){
        if(($total_point > 17) and ($total_point < 29)){
		    $result2 = 8;
        }
    }

	return $result2;
}

function get_result2() {
	global $cards;
    global $total_point;
	
	for ($i = 1; $i <= 10; $i++ ) {	
		if 		($cards[$i][1] == 1) {$total_point = $total_point + 1;}
		elseif 	($cards[$i][1] == 2) {$total_point = $total_point + 2;}
		elseif 	($cards[$i][1] == 3) {$total_point = $total_point + 3;}
		elseif 	($cards[$i][1] == 4) {$total_point = $total_point + 4;}
		elseif 	($cards[$i][1] == 5) {$total_point = $total_point + 5;}
		elseif 	($cards[$i][1] == 6) {$total_point = $total_point + 6;}
		elseif 	($cards[$i][1] == 7) {$total_point = $total_point + 7;}
		elseif 	($cards[$i][1] == 8) {$total_point = $total_point + 8;}
		elseif 	($cards[$i][1] == 9) {$total_point = $total_point + 9;}
		elseif 	($cards[$i][1] == 10) {$total_point = $total_point + 10;}
		elseif 	($cards[$i][1] == 11) {$total_point = $total_point + 11;}
		elseif 	($cards[$i][1] == 12) {$total_point = $total_point + 12;}
		elseif 	($cards[$i][1] == 13) {$total_point = $total_point + 13;}
	}

	$result3 = 0;

    if($result3 == 0){
        if(($total_point == 13) or ($total_point == 15) or ($total_point == 17) or ($total_point == 19) or
		   ($total_point == 21) or ($total_point == 23) or ($total_point == 25) or ($total_point == 27) or
		   ($total_point == 29) or ($total_point == 31) or ($total_point == 33) or ($total_point == 35) or
		   ($total_point == 37) or ($total_point == 39) or ($total_point == 41) or ($total_point == 43) or
		   ($total_point == 45) or ($total_point == 47) or ($total_point == 49) or ($total_point == 51) or
		   ($total_point == 53) or ($total_point == 55) or ($total_point == 57) or ($total_point == 59) or
           ($total_point == 61) or ($total_point == 63) or ($total_point == 65) or ($total_point == 67) or
		   ($total_point == 69) or ($total_point == 71) or ($total_point == 73) or ($total_point == 75) or
		   ($total_point == 77) or ($total_point == 79) or ($total_point == 81) or ($total_point == 83) or
		   ($total_point == 85) or ($total_point == 87) or ($total_point == 89) or ($total_point == 91) or
           ($total_point == 93) or ($total_point == 95) or ($total_point == 97) or ($total_point == 99) or
           ($total_point == 101) or ($total_point == 103) or ($total_point == 105) or ($total_point == 107) or
		   ($total_point == 109) or ($total_point == 111)){
		    $result3 = 6;
        }
    }

    if($result3 == 0){
        if(($total_point == 4) or ($total_point == 6) or ($total_point == 8) or ($total_point == 10) or
		   ($total_point == 12) or ($total_point == 14) or ($total_point == 16) or ($total_point == 18) or
		   ($total_point == 20) or ($total_point == 22) or ($total_point == 24) or ($total_point == 26) or
		   ($total_point == 28) or ($total_point == 30) or ($total_point == 32) or ($total_point == 34) or
		   ($total_point == 36) or ($total_point == 38) or ($total_point == 40) or ($total_point == 42) or
		   ($total_point == 44) or ($total_point == 46) or ($total_point == 48) or ($total_point == 50) or
		   ($total_point == 52) or ($total_point == 54) or ($total_point == 56) or ($total_point == 58) or
           ($total_point == 60) or ($total_point == 62) or ($total_point == 64) or ($total_point == 66) or
		   ($total_point == 68) or ($total_point == 70) or ($total_point == 72) or ($total_point == 74) or
		   ($total_point == 76) or ($total_point == 78) or ($total_point == 80) or ($total_point == 82) or
		   ($total_point == 84) or ($total_point == 86) or ($total_point == 88) or ($total_point == 90) or
           ($total_point == 92) or ($total_point == 94) or ($total_point == 96) or ($total_point == 98) or
           ($total_point == 100) or ($total_point == 102) or ($total_point == 104) or ($total_point == 106) or
		   ($total_point == 108) or ($total_point == 110) or ($total_point == 112)){
		    $result3 = 7;
        }
    }

	return $result3;
	
}


function SelectCard(){
	srand();
	$random = (rand()%12)+1;
	return $random;
}

function SelectDeck(){
	srand();
	$random = (rand()%4)+1;
	return $random;
}

function random_card_img(){
	global $pack;
	$j = SelectCard();
	$k = SelectDeck();
	return $pack[$j][$k];
}

function card_img($j, $k){
	global $pack;
	return $pack[$j][$k];
}

function display_all_cards() {
	global $c_path, $c_color, $c_size, $c_style , $c_ext ;
	echo "<table border=1 align=center>";
	for ($j = 1; $j <= 13; $j++) {
		echo "<tr><td> <IMG SRC=" . $c_path . $c_color . $c_size . "-" . $c_style .  $c_ext . " ALT=card > </td> ";

		for ($k = 1; $k <=4; $k++) {
			echo "<td>";
			echo "<IMG SRC=" . card_img($j, $k) .  " ALT=\"card\" >";
			echo "</td>";
		}
		echo "<td> <IMG SRC=" . $c_path . $c_color . $c_size . "-" . $c_style .  $c_ext . " ALT=card > </td></tr> ";
	}
	echo "</table>";

}

function debug($msg) {
	global $debug;
	if ($debug) {echo "<br>DEBUG: $msg";}
	return 0;
	}
?>