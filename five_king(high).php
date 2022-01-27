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

<p>Change the bet values: 
	<input type = "submit" name = "change_bet" value = "Turn" id = "game_button1">
</p>

</body>
</html>

<?php
if (!empty($_POST["change_bet"])) {
	header("location: change_bet_cards(five_king).php");
}
?>
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

$app_name = "NYHC - Five King";
$init_exp = (empty($_COOKIE["pref_init_exp"]))	? $userExp : $_COOKIE["pref_init_exp"] ;
$init_bal = (empty($_COOKIE["pref_init_bal"]))	? $userPoint : $_COOKIE["pref_init_bal"] ;
$init_bet = (empty($_COOKIE["pref_init_bet"]))	? $user_bit_num : $_COOKIE["pref_init_bet"] ;
//$bet_up = (empty($_COOKIE["pref_bet_up"]))		? 10 : $_COOKIE["pref_bet_up"] ;
//$bet_down = (empty($_COOKIE["pref_bet_down"]))	? 10 : $_COOKIE["pref_bet_down"] ;

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
				4 => $c_path . $d4 ."-12" . $c_size . $c_ext ),
	 13 => array(1 => $c_path . $d1 ."-13" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-13" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-13" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-13" . $c_size . $c_ext ),
	 14 => array(1 => $c_path . $d1 ."-14" . $c_size . $c_ext , 
				2 => $c_path . $d2 ."-14" . $c_size . $c_ext , 
				3 => $c_path . $d3 ."-14" . $c_size . $c_ext , 
				4 => $c_path . $d4 ."-14" . $c_size . $c_ext )
	); 

if (empty($_POST["step"])) { 
	$step = 0;
	$random_flag = 1;
	$init = 0;
	$balance = $init_bal ;
	$exp_plus = $init_exp;
	$bet= $init_bet ;
	$msg = "Welcome to NYHC Game!<br>";
} else {
	if (!empty($_POST["btn_pref_save"])) {
		setcookie("pref_player", 	$_POST["pref_player"]);
		setcookie("pref_init_bal", 	$_POST["pref_init_bal"]);
		setcookie("pref_init_bet", 	$_POST["pref_init_bet"]);
		setcookie("pref_init_exp", 	$_POST["pref_init_exp"]);
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

	//$query12 = "UPDATE NYHCUser SET user_bit_num = $bet WHERE userID = $userID";
	//$result12 = $conn->query($query12);
	//$conn->query($query12);

	if (!empty($_POST["btn_deal"])) {
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
	
				$cards = array (
					1 => array( 1 => $c1c, 2 => $c1d, 3 => $c1f, 4 => 0),
					2 => array( 1 => $c2c, 2 => $c2d, 3 => $c2f, 4 => 0),
					3 => array( 1 => $c3c, 2 => $c3d, 3 => $c3f, 4 => 0),
					4 => array( 1 => $c4c, 2 => $c4d, 3 => $c4f, 4 => 0),
					5 => array( 1 => $c5c, 2 => $c5d, 3 => $c5f, 4 => 0),
                    6 => array( 1 => $c6c, 2 => $c6d, 3 => $c6f, 4 => 0)            
				);
				$d = 0;
				$d = mark_duplicate();	
				debug("Check after Deal.");	
				debug("Duplicates Before Replacement: $d");
				while ($d > 1):
					replace_duplicate();
					$d = 0;
					$d = mark_duplicate();		
					debug("Duplicates After Replacement: $d");
				endwhile;
				$d = 0;
				$d = mark_duplicate();		
				debug("Duplicates After Loop: $d");
				
				$result = get_result();
				switch ($result) {
					case 1:
						$msg = "Hao Ji Jackpot";
						$balance += ($bet * 88.8); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 2:
						$msg = "Five Zodiac";
						$balance += ($bet * 10); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 3:
						$msg = "Same Colour Staight!!";
						$balance += ($bet * 8); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 4:
						$msg = "Four Zodiac!!";
						$balance += ($bet * 6);
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 5:
						$msg = "Airplane!!";
						$balance += ($bet * 5.8);
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 6:
						$msg = "Train!!";
						$balance += ($bet * 5);
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 7:
						$msg = "Gourd";
						$balance += ($bet * 3); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 8:
						$msg = "Same Colour";
						$balance += ($bet * 2); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 9:
						$msg = "Staight";
						$balance += ($bet * 1);
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 10:
						$msg = "Three Zodiac";
						$balance += ($bet * 0.5); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 11:
						$msg = "Double Pair Zodiac";
						$balance += ($bet * 0.4); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					case 12:
						$msg =  "One Pair Zodiac";
						$balance += ($bet * 0.2); 
						$userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
						break;
					default:
						$msg = "Lost Deal";
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
    /*elseif (!empty($_POST["btn_plus"])) {
		$step = 0; 
		$random_flag = 1;

		if ($balance > $bet_up) {
			$bet = $bet + $bet_up;
			$balance = $balance - $bet_up;
		} else {
			$bet = $bet +$balance ;
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
	} */
    elseif (!empty($_POST["btn_new"])) {
		$balance = $init_bal; 
		//$bet = $init_bet;		
		$step = 0;
		$init = 0;
		$random_flag = 1;
		$userPoint = $balance;
		$userExp = $exp_plus;
	} 
	elseif (!empty($_POST["btn_bet"])) {	
		$step = 0;
		$random_flag = 1;
		//$bet = "{$_POST['bet_num']}";
		$query12 = "UPDATE NYHCUser SET user_bit_num = '{$_POST['bet_num']}' WHERE userID = $userID";
		$result12 = $conn->query($query12);

	} 

    elseif (!empty($_POST["btn_about"])) {
		$step = 4;
		$random_flag = 1;
	} 
}


if ($random_flag) {
	$msg = "Pick Your Cards";

	$cards = array (
				1 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				2 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				3 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				4 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				5 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
                6 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0)      
				);

	$d = 0;
	$d 	= mark_duplicate();		
	debug("Check during New Hand.");
	debug("Duplicates Before Replacement: $d");
	while ($d > 1):
		replace_duplicate();
		$d = 0;
		$d 	= mark_duplicate();		
		debug("Duplicates After Replacement: $d");
	endwhile;
	$d = 0;
	$d 	= mark_duplicate();		
	debug("Duplicates After Loop: $d");
}

switch ($step) {
case 0:
	$card_1 = card_img($cards[1][1],$cards[1][2]);
	$card_2 = card_img($cards[2][1],$cards[2][2]);
	$card_3 = card_img($cards[3][1],$cards[3][2]);
	$card_4 = card_img($cards[4][1],$cards[4][2]);
	$card_5 = card_img($cards[5][1],$cards[5][2]);
    $card_6 = card_img($cards[6][1],$cards[6][2]);
	$cb_1 = "<br><input type='checkbox' name='cb_card[1]' value=$card_1  style='width:50px;height:50px;'></td>";
	$cb_2 = "<br><input type='checkbox' name='cb_card[2]' value=$card_2  style='width:50px;height:50px;'></td>";
	$cb_3 = "<br><input type='checkbox' name='cb_card[3]' value=$card_3  style='width:50px;height:50px;'></td>";
	$cb_4 = "<br><input type='checkbox' name='cb_card[4]' value=$card_4  style='width:50px;height:50px;'></td>";
	$cb_5 = "<br><input type='checkbox' name='cb_card[5]' value=$card_5  style='width:50px;height:50px;'></td>";
	$cb_6 = "<br><input type='checkbox' name='cb_card[6]' value=$card_6  style='width:50px;height:50px;'></td>";

	echo " $page_header
		<body>
		<form name=\"post\" action=\"$_SERVER[PHP_SELF]\" method=\"POST\">
		<table border=1 cellspacing=1 cellpadding=1 align=center id = 'game_table'>
			<tr><td colspan=6 align=center><b>$app_name</i></td></tr>
			<tr ALIGN=CENTER >
				<td> <IMG SRC=" . $card_1 .  " ALT=Card1 width = 90 height = 160>  $cb_1 
				<td> <IMG SRC=" . $card_2 .  " ALT=Card2 width = 90 height = 160>  $cb_2
				<td> <IMG SRC=" . $card_3 .  " ALT=Card3 width = 90 height = 160>  $cb_3
				<td> <IMG SRC=" . $card_4 .  " ALT=Card4 width = 90 height = 160>  $cb_4
				<td> <IMG SRC=" . $card_5 .  " ALT=Card5 width = 90 height = 160>  $cb_5
                <td> <IMG SRC=" . $card_6 .  " ALT=Card6 width = 90 height = 160>  $cb_6 </tr>
			<tr><td colspan=6 align=center >$msg</td></tr>
			<tr><td colspan=6 align=center><b><i>Status</i></b></td></tr>

			<tr>
				<td colspan = 6 align = center>You Point: " . number_format($balance,0,'.',',') . "<br>
				You Bet: ". number_format($bet , 0 , '.' , '.') ."
				</td></tr>
			<tr colspan = 6 align = center>
			    <td></td>
				<td><input type=\"submit\" name= \"btn_deal\" value=\"Deal\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"btn_new\" value=\"New\" id = 'game_button1'></td>
				<td></td>
				<td><input type=\"submit\" name= \"btn_about\" value=\"About\" id = 'game_button1'></td>
                <td></td>

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
				<input type=\"hidden\" name=\"c6d\" value= " . $cards[6][2] . ">  </tr>
		</table>
		</form>
		</body>";
	break;

case 1: // Deal Zodiac
	$card_1 		= card_img($cards[1][1],$cards[1][2]);
	$card_2 		= card_img($cards[2][1],$cards[2][2]);
	$card_3 		= card_img($cards[3][1],$cards[3][2]);
	$card_4 		= card_img($cards[4][1],$cards[4][2]);
	$card_5 		= card_img($cards[5][1],$cards[5][2]);
	$card_6 		= card_img($cards[6][1],$cards[6][2]);

	$c1_tag 		= ($cards[1][3]) ? "<IMG SRC=./about/cb_yes.png ALT=Picked style='width:50px;height:50px;'>" : "<IMG SRC=./about/cb_repl.png ALT=Replaced style='width:50px;height:50px;'>";
	$c2_tag 		= ($cards[2][3]) ? "<IMG SRC=./about/cb_yes.png ALT=Picked style='width:50px;height:50px;'>" : "<IMG SRC=./about/cb_repl.png ALT=Replaced style='width:50px;height:50px;'>";
	$c3_tag 		= ($cards[3][3]) ? "<IMG SRC=./about/cb_yes.png ALT=Picked style='width:50px;height:50px;'>" : "<IMG SRC=./about/cb_repl.png ALT=Replaced style='width:50px;height:50px;'>";
	$c4_tag 		= ($cards[4][3]) ? "<IMG SRC=./about/cb_yes.png ALT=Picked style='width:50px;height:50px;'>" : "<IMG SRC=./about/cb_repl.png ALT=Replaced style='width:50px;height:50px;'>";
	$c5_tag 		= ($cards[5][3]) ? "<IMG SRC=./about/cb_yes.png ALT=Picked style='width:50px;height:50px;'>" : "<IMG SRC=./about/cb_repl.png ALT=Replaced style='width:50px;height:50px;'>";
    $c6_tag 		= ($cards[6][3]) ? "<IMG SRC=./about/cb_yes.png ALT=Picked style='width:50px;height:50px;'>" : "<IMG SRC=./about/cb_repl.png ALT=Replaced style='width:50px;height:50px;'>";

	$cb_1 			= "<br>" . $c1_tag .   "</td>";
	$cb_2 			= "<br>" . $c2_tag .   "</td>";
	$cb_3 			= "<br>" . $c3_tag .   "</td>";
	$cb_4 			= "<br>" . $c4_tag .   "</td>";
	$cb_5 			= "<br>" . $c5_tag .   "</td>";
    $cb_6 			= "<br>" . $c6_tag .   "</td>";
	if ($balance == 0 and $bet == 0) {
		$msg 		.= "<br>Balance and Bet is exhausted. <br>You can continue to play...for nothing.";
	}
	echo "$page_header
		<body>
		<form name=\"post\" action=\"$_SERVER[PHP_SELF]\" method=\"POST\">

		<table border=1 cellspacing=1 cellpadding=1 align=center>
		<tr><td colspan=6 align=center><b>$app_name</i></td></tr>
			<tr ALIGN=CENTER >
				<td> <IMG SRC=" . $card_1 .  " ALT=Card1 width = 90 height = 160>  $cb_1 
				<td> <IMG SRC=" . $card_2 .  " ALT=Card2 width = 90 height = 160>  $cb_2
				<td> <IMG SRC=" . $card_3 .  " ALT=Card3 width = 90 height = 160>  $cb_3
				<td> <IMG SRC=" . $card_4 .  " ALT=Card4 width = 90 height = 160>  $cb_4
				<td> <IMG SRC=" . $card_5 .  " ALT=Card5 width = 90 height = 160>  $cb_5
                <td> <IMG SRC=" . $card_6 .  " ALT=Card5 width = 90 height = 160>  $cb_6
			</tr>
			<tr><td colspan = 6 align=center>$msg</td></tr>
			<tr><td colspan = 6 align=center><b><i>Status</i></b></td></tr>

			<tr>
			<td colspan = 6 align = center>You Point: " . number_format($balance,0,'.',',') . "<br>
			You Bet: ". number_format($bet , 0 , '.' , '.') ."
			</td></tr> 
			<tr colspan = 6 align = center>
			    <td></td>
				<td><input type=\"submit\" name= \"btn_deal\" value=\"Deal\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"btn_new\" value=\"New\" id = 'game_button1'></td>
				<td></td>
				<td><input type=\"submit\" name= \"btn_about\" value=\"About\" id = 'game_button1'></td>
                <td></td>

				<input type=\"hidden\" name=\"step\" value=1>		
				<input type=\"hidden\" name=\"init\" value=1>		
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
                <input type=\"hidden\" name=\"c5c\" value= " . $cards[6][1] . ">		
				<input type=\"hidden\" name=\"c5d\" value= " . $cards[6][2] . ">	
			</tr>
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
			<tr><td  align=center colspan=6><b>$app_name</b></td></tr>
			<tr><td  align=center colspan=6><b>About Five Zodiac King</b></td></tr>

			<tr><td  align=center colspan=5>
			<IMG SRC=./Picture/five_king_about.png ALT=hands >
			<table>
			<tr><td align=center><b>**Winning Reward**</b></td></tr>
			<tr><td>Hao Ji Jackpot</td><td align = right>888</td></tr>
			<tr><td>Five Zodiac</td><td align = right>100</td></tr>
			<tr><td>Same Colour Straight</td><td align=right>80</td></tr>
			<tr><td>Four Zodiac</td><td align=right>60</td></tr>
			<tr><td>Airplane</td><td align=right>58</td></tr>
			<tr><td>Train</td><td align=right>50</td></tr>
			<tr><td>Gourd</td><td align=right>30</td></tr>
			<tr><td>Same Colour</td><td align=right>20</td></tr>
			<tr><td>Straight</td><td align=right>10</td></tr>
			<tr><td>Three Zodiac</td><td align=right>5</td></tr>
			<tr><td>Two Pair Zodiac</td><td align=right>4</td></tr>
			<tr><td>One Pair Zodiac</td><td align=right>2</td></tr>

			<tr><td align=center><b>********************</b></td></tr>
			<tr><td align=center><b>**Card Detail Show**</b></td></tr>
			<tr><td align=center><b>Hao Ji Jackpot</b></td></tr>
			<tr><td><img src='Picture/card/01-13.png' width = 90 height = 160>
			<img src='Picture/card/02-13.png' width = 90 height = 160>
			<img src='Picture/card/03-13.png' width = 90 height = 160>
			<img src='Picture/card/01-14.png' width = 90 height = 160>
			<img src='Picture/card/02-14.png' width = 90 height = 160>
			<img src='Picture/card/01-00.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Five Zodiac</b></td></tr>
			<tr><td><img src='Picture/card/01-12.png' width = 90 height = 160>
			<img src='Picture/card/02-12.png' width = 90 height = 160>
			<img src='Picture/card/03-12.png' width = 90 height = 160>
			<img src='Picture/card/04-12.png' width = 90 height = 160>
			<img src='Picture/card/01-14.png' width = 90 height = 160>
			<img src='Picture/card/01-00.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Same Colour Straight</b></td></tr>
			<tr><td><img src='Picture/card/04-12.png' width = 90 height = 160>
			<img src='Picture/card/04-11.png' width = 90 height = 160>
			<img src='Picture/card/04-10.png' width = 90 height = 160>
			<img src='Picture/card/04-09.png' width = 90 height = 160>
			<img src='Picture/card/04-08.png' width = 90 height = 160>
			<img src='Picture/card/04-07.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Four Zodiac</b></td></tr>
			<tr><td><img src='Picture/card/01-12.png' width = 90 height = 160>
			<img src='Picture/card/02-12.png' width = 90 height = 160>
			<img src='Picture/card/03-12.png' width = 90 height = 160>
			<img src='Picture/card/04-12.png' width = 90 height = 160>
			<img src='Picture/card/04-08.png' width = 90 height = 160>
			<img src='Picture/card/03-06.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Airplane</b></td></tr>
			<tr><td><img src='Picture/card/01-12.png' width = 90 height = 160>
			<img src='Picture/card/02-12.png' width = 90 height = 160>
			<img src='Picture/card/03-12.png' width = 90 height = 160>
			<img src='Picture/card/04-11.png' width = 90 height = 160>
			<img src='Picture/card/03-11.png' width = 90 height = 160>
			<img src='Picture/card/02-11.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Train</b></td></tr>
			<tr><td><img src='Picture/card/01-12.png' width = 90 height = 160>
			<img src='Picture/card/02-12.png' width = 90 height = 160>
			<img src='Picture/card/03-07.png' width = 90 height = 160>
			<img src='Picture/card/01-07.png' width = 90 height = 160>
			<img src='Picture/card/02-05.png' width = 90 height = 160>
			<img src='Picture/card/03-05.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Gourd</b></td></tr>
			<tr><td><img src='Picture/card/01-12.png' width = 90 height = 160>
			<img src='Picture/card/02-12.png' width = 90 height = 160>
			<img src='Picture/card/03-12.png' width = 90 height = 160>
			<img src='Picture/card/02-08.png' width = 90 height = 160>
			<img src='Picture/card/03-08.png' width = 90 height = 160>
			<img src='Picture/card/03-06.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Same Colour</b></td></tr>
			<tr><td><img src='Picture/card/01-03.png' width = 90 height = 160>
			<img src='Picture/card/01-06.png' width = 90 height = 160>
			<img src='Picture/card/01-08.png' width = 90 height = 160>
			<img src='Picture/card/01-10.png' width = 90 height = 160>
			<img src='Picture/card/01-12.png' width = 90 height = 160>
			<img src='Picture/card/01-04.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Straight</b></td></tr>
			<tr><td><img src='Picture/card/01-02.png' width = 90 height = 160>
			<img src='Picture/card/01-03.png' width = 90 height = 160>
			<img src='Picture/card/03-04.png' width = 90 height = 160>
			<img src='Picture/card/04-05.png' width = 90 height = 160>
			<img src='Picture/card/04-06.png' width = 90 height = 160>
			<img src='Picture/card/02-07.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Three Zodiac</b></td></tr>
			<tr><td><img src='Picture/card/01-02.png' width = 90 height = 160>
			<img src='Picture/card/02-02.png' width = 90 height = 160>
			<img src='Picture/card/03-02.png' width = 90 height = 160>
			<img src='Picture/card/04-05.png' width = 90 height = 160>
			<img src='Picture/card/04-08.png' width = 90 height = 160>
			<img src='Picture/card/02-07.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>Two Pair Zodiac</b></td></tr>
			<tr><td><img src='Picture/card/01-02.png' width = 90 height = 160>
			<img src='Picture/card/02-02.png' width = 90 height = 160>
			<img src='Picture/card/04-07.png' width = 90 height = 160>
			<img src='Picture/card/03-07.png' width = 90 height = 160>
			<img src='Picture/card/04-11.png' width = 90 height = 160>
			<img src='Picture/card/02-03.png' width = 90 height = 160>
			</td></tr>
			<tr><td align=center><b>One Pair Zodiac</b></td></tr>
			<tr><td><img src='Picture/card/01-01.png' width = 90 height = 160>
			<img src='Picture/card/03-01.png' width = 90 height = 160>
			<img src='Picture/card/04-07.png' width = 90 height = 160>
			<img src='Picture/card/03-04.png' width = 90 height = 160>
			<img src='Picture/card/04-11.png' width = 90 height = 160>
			<img src='Picture/card/02-03.png' width = 90 height = 160>
			</td></tr>
			</table>

			</td></tr>
			<tr><td align=center colspan=5><a href=$_SERVER[PHP_SELF]>Back</a></td></tr>
		</table>
		</body>	";
	//	Display_all_cards();
	break;
}


/*=============================================================================
	Functions 
=============================================================================*/
function mark_duplicate() {
	global $cards;
	if 	(($cards[1][1] == $cards[2][1]) and ($cards[1][2] == $cards[2][2])) { $cards[1][4] = 1; $cards[2][4] = 1; }
	if 	(($cards[1][1] == $cards[3][1]) and ($cards[1][2] == $cards[3][2])) { $cards[1][4] = 1; $cards[3][4] = 1; }
	if 	(($cards[1][1] == $cards[4][1]) and ($cards[1][2] == $cards[4][2])) { $cards[1][4] = 1; $cards[4][4] = 1; }
	if 	(($cards[1][1] == $cards[5][1]) and ($cards[1][2] == $cards[5][2])) { $cards[1][4] = 1; $cards[5][4] = 1; }
	if 	(($cards[1][1] == $cards[6][1]) and ($cards[1][2] == $cards[6][2])) { $cards[1][4] = 1; $cards[6][4] = 1; }

	if 	(($cards[2][1] == $cards[3][1]) and ($cards[2][2] == $cards[3][2])) { $cards[2][4] = 1; $cards[3][4] = 1; }
	if 	(($cards[2][1] == $cards[4][1]) and ($cards[2][2] == $cards[4][2])) { $cards[2][4] = 1; $cards[4][4] = 1; }
	if 	(($cards[2][1] == $cards[5][1]) and ($cards[2][2] == $cards[5][2])) { $cards[2][4] = 1; $cards[5][4] = 1; }
	if 	(($cards[2][1] == $cards[6][1]) and ($cards[2][2] == $cards[6][2])) { $cards[2][4] = 1; $cards[6][4] = 1; }

	if 	(($cards[3][1] == $cards[4][1]) and ($cards[3][2] == $cards[4][2])) { $cards[3][4] = 1; $cards[4][4] = 1; }
	if 	(($cards[3][1] == $cards[5][1]) and ($cards[3][2] == $cards[5][2])) { $cards[3][4] = 1; $cards[5][4] = 1; }
	if 	(($cards[3][1] == $cards[6][1]) and ($cards[3][2] == $cards[6][2])) { $cards[3][4] = 1; $cards[6][4] = 1; }

	if 	(($cards[4][1] == $cards[5][1]) and ($cards[4][2] == $cards[5][2])) { $cards[4][4] = 1; $cards[5][4] = 1; }
	if 	(($cards[4][1] == $cards[6][1]) and ($cards[4][2] == $cards[6][2])) { $cards[4][4] = 1; $cards[6][4] = 1; }

	if 	(($cards[5][1] == $cards[6][1]) and ($cards[5][2] == $cards[6][2])) { $cards[5][4] = 1; $cards[6][4] = 1; }

	$d = 0;
	for ($i = 1; $i <= 6; $i++ ) {
		$d += $cards[$i][4];
	}
	return $d;
}

function replace_duplicate() { 
	global $cards;
	if (($cards[1][3] == 0) and ($cards[1][4] == 1 )) {
		$cards[1][1] 	= SelectCard();
		$cards[1][2] 	= SelectDeck();
		$cards[1][4] 	= 0; 
	}
	if (($cards[2][3] == 0) and ($cards[2][4] == 1 )) {
		$cards[2][1] 	= SelectCard();
		$cards[2][2] 	= SelectDeck();
		$cards[2][4] 	= 0; 
	}
	if (($cards[3][3] == 0) and ($cards[3][4] == 1 )) {
		$cards[3][1] 	= SelectCard();
		$cards[3][2] 	= SelectDeck();
		$cards[3][4] 	= 0; 
	}
	if (($cards[4][3] == 0) and ($cards[4][4] == 1 )) {
		$cards[4][1] 	= SelectCard();
		$cards[4][2] 	= SelectDeck();
		$cards[4][4] 	= 0; 
	}
	if (($cards[5][3] == 0) and ($cards[5][4] == 1 )) {
		$cards[5][1] 	= SelectCard();
		$cards[5][2] 	= SelectDeck();
		$cards[5][4] 	= 0; 
	}
    if (($cards[6][3] == 0) and ($cards[6][4] == 1 )) {
		$cards[6][1] 	= SelectCard();
		$cards[6][2] 	= SelectDeck();
		$cards[6][4] 	= 0; 
	}
	return 1;
}

function get_result() {
	global $cards, $test;
	if ($test) {
		test_winning_hand(1);
	}
	
	$count_of_01 = 0;
	$count_of_02 = 0;
	$count_of_03 = 0;
	$count_of_04 = 0;
	$count_of_05 = 0;
	$count_of_06 = 0;
	$count_of_07 = 0;
	$count_of_08 = 0;
	$count_of_09 = 0;
	$count_of_10 = 0;
	$count_of_11 = 0;
	$count_of_12 = 0;
	$count_of_13 = 0;
	$count_of_14 = 0;
	
	for ($i=1; $i<=6; $i++ ) {	
		if 		($cards[$i][1] == 1) { $count_of_01++; }
		elseif 	($cards[$i][1] == 2) { $count_of_02++; }
		elseif 	($cards[$i][1] == 3) { $count_of_03++; }
		elseif 	($cards[$i][1] == 4 ) { $count_of_04++; }
		elseif 	($cards[$i][1] == 5 ) { $count_of_05++; }
		elseif 	($cards[$i][1] == 6 ) { $count_of_06++; }
		elseif 	($cards[$i][1] == 7 ) { $count_of_07++; }
		elseif 	($cards[$i][1] == 8 ) { $count_of_08++; }
		elseif 	($cards[$i][1] == 9 ) { $count_of_09++; }
		elseif 	($cards[$i][1] == 10 ) { $count_of_10++; }
		elseif 	($cards[$i][1] == 11 ) { $count_of_11++; }
		elseif 	($cards[$i][1] == 12 ) { $count_of_12++; }
		elseif 	($cards[$i][1] == 13) { $count_of_13++;}
		elseif 	($cards[$i][1] == 14) { $count_of_14++;}
	}

	$count_of_d1 = 0;
	$count_of_d2 = 0;
	$count_of_d3 = 0;
	$count_of_d4 = 0;
	
	for ($i=1; $i<=6; $i++ ) {	
		if 		($cards[$i][2] == 1) { $count_of_d1++; }
		elseif 	($cards[$i][2] == 2) { $count_of_d2++; }
		elseif 	($cards[$i][2] == 3) { $count_of_d3++; }
		elseif 	($cards[$i][2] == 4) { $count_of_d4++; }
	}

	$cards_copy = array( 1 => $cards[1][1], 2 => $cards[2][1], 3 => $cards[3][1], 
                         4 => $cards[4][1], 5 => $cards[5][1], 6 => $cards[6][1]);
	array_multisort($cards_copy, SORT_ASC);
	
	$result = 0;
	// 1 Hao Ji Jackpot
	if($result == 0){
	    if (($count_of_13 == 3) and ($count_of_14 == 2)) {
		    $result = 1;
	   }
	} 
    
    // 2 Five Zodiac
	if ($result == 0) {
		if (($count_of_01 == 4) and ($count_of_14 == 1) or ($count_of_02 == 4) and ($count_of_14 == 1) or 
		    ($count_of_03 == 4) and ($count_of_14 == 1) or ($count_of_04 == 4) and ($count_of_14 == 1) or
			($count_of_05 == 4) and ($count_of_14 == 1) or ($count_of_06 == 4) and ($count_of_14 == 1) or 
			($count_of_07 == 4) and ($count_of_14 == 1) or ($count_of_08 == 4) and ($count_of_14 == 1) or
			($count_of_09 == 4) and ($count_of_14 == 1) or ($count_of_10 == 4) and ($count_of_14 == 1) or
			($count_of_11 == 4) and ($count_of_14 == 1) or ($count_of_12 == 4) and ($count_of_14 == 1)){
			$result = 2;
		}  
	}

    // 3 Same Colour Straight
	if ( $result == 0 ) {
		if (($cards_copy[0]+1 == $cards_copy[1]) and 
			($cards_copy[1]+1 == $cards_copy[2]) and 
			($cards_copy[2]+1 == $cards_copy[3]) and 
			($cards_copy[3]+1 == $cards_copy[4]) ) {
			if (($count_of_d1 == 5) or 
				($count_of_d2 == 5) or
				($count_of_d3 == 5) or
				($count_of_d4 == 5)) {
				$result = 3;
				} 
			} 
	} 

    // 4 Four Zodiac 
	if ($result == 0) {
		if (($count_of_01 == 4) or ($count_of_02 == 4) or ($count_of_03 == 4) or ($count_of_04 == 4)	or
			($count_of_05 == 4) or ($count_of_06 == 4) or ($count_of_07 == 4) or ($count_of_08 == 4)	or
			($count_of_09 == 4) or ($count_of_10 == 4) or ($count_of_11 == 4) or ($count_of_12 == 4)) {
			$result = 4;
		}  
	}

    // 5 Airplane
	if ($result == 0) {
		if ($count_of_01 == 3) {
			if (($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_02 == 3) {
			if (($count_of_01 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_03 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_04 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_05 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_06 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_07 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
			    ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_08 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_09 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_10 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_11 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_11 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_12 == 3) 
				) {
				$result = 5;
				}
		}
		if ($count_of_12 == 3) {
			if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or
				($count_of_04 == 3) or ($count_of_05 == 3) or ($count_of_06 == 3) or
				($count_of_07 == 3) or ($count_of_08 == 3) or ($count_of_09 == 3) or
				($count_of_10 == 3) or ($count_of_11 == 3) 
				) {
				$result = 5;
				}
		}

	}

	// 6 Train
	if ($result == 0) {
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_03 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_04 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_05 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_02 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_04 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_05 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_03 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_05 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_06 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_06 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_06 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_06 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_06 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_06 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_07 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_07 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_07 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_07 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_07 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_01 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_04 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_05 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_03 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_05 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_04 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_05 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_06 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_06 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_06 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_06 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_06 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_06 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_07 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_07 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_07 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_07 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_07 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_02 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_05 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_04 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_05 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_06 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_06 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_06 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_06 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_06 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_06 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_07 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_07 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_07 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_07 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_07 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_03 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_06 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_05 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_06 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_06 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_06 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_06 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_06 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_06 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_07 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_07 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_07 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_07 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_07 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_04 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_06 == 2) and ($count_of_07 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_06 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_06 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_06 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_06 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_06 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_07 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_07 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_07 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_07 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_07 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_05 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_07 == 2) and ($count_of_08 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_07 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_07 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_07 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_07 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_06 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_08 == 2) and ($count_of_09 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_08 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_08 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_08 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_07 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_08 == 2) and ($count_of_09 == 2) and ($count_of_10 == 2)){
			$result = 6;
		}
		if (($count_of_08 == 2) and ($count_of_09 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_08 == 2) and ($count_of_09 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_08 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_08 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_08 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_09 == 2) and ($count_of_10 == 2) and ($count_of_11 == 2)){
			$result = 6;
		}
		if (($count_of_09 == 2) and ($count_of_10 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_09 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
		if (($count_of_10 == 2) and ($count_of_11 == 2) and ($count_of_12 == 2)){
			$result = 6;
		}
	}

	// 7 Gourd
	if ($result == 0) {
		if ($count_of_01 == 3) {
			if (($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

		if ($count_of_02 == 3) {
			if (($count_of_01 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_03 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or 
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_04 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_05 == 2) or 
               ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_05 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_06 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_07 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or 
                ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_08 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

		if ($count_of_09 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

		if ($count_of_10 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
                ($count_of_11 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

		if ($count_of_11 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_12 == 2) 
				) {
				$result = 7;
				}
		}

        if ($count_of_12 == 3) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
				($count_of_04 == 2) or ($count_of_05 == 2) or ($count_of_06 == 2) or
				($count_of_07 == 2) or ($count_of_08 == 2) or ($count_of_09 == 2) or
				($count_of_10 == 2) or ($count_of_11 == 2)){
				$result = 7;
				}
		}
	}

	// 7 Same Colour 
	if ($result == 0) {
		if (($count_of_d1 == 5) or ($count_of_d2 == 5) or ($count_of_d3 == 5) or ($count_of_d4 == 5)){
			$result = 8;
		}  
	}

	// 9 Straight
	if ($result == 0){
		if (($cards_copy[0]+1 == $cards_copy[1]) and ($cards_copy[1]+1 == $cards_copy[2]) and 
            ($cards_copy[2]+1 == $cards_copy[3]) and ($cards_copy[3]+1 == $cards_copy[4])) {
				$result = 9;
		}
    }

	// 10 Three Zodiac
	if ($result == 0) {
		if (($count_of_01 == 3) or ($count_of_02 == 3) or ($count_of_03 == 3) or ($count_of_04 == 3) or
			($count_of_05 == 3) or ($count_of_06 == 3) or ($count_of_07 == 3) or ($count_of_08 == 3) or
			($count_of_09 == 3) or ($count_of_10 == 3) or ($count_of_11 == 3) or ($count_of_12 == 3)) {
			$result = 10;
		}  
	}

	// 11 Two Pair Zodiac
	if ($result == 0) {
		if ($count_of_01 == 2) {
			if (($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}
		if ($count_of_02 == 2) {
			if (($count_of_01 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}
        if ($count_of_03 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_04 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_05 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_06 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_07 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_08 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_09 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_10 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_11 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_12 == 2)){
				$result = 11;
				}
		}		
        if ($count_of_12 == 2) {
			if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
                ($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or 
                ($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2)){
				$result = 11;
				}
		} 
	}

	// 12 One Pair Zodiac
	if ($result == 0) {
		if (($count_of_01 == 2) or ($count_of_02 == 2) or ($count_of_03 == 2) or ($count_of_04 == 2) or
			($count_of_05 == 2) or ($count_of_06 == 2) or ($count_of_07 == 2) or ($count_of_08 == 2) or
			($count_of_09 == 2) or ($count_of_10 == 2) or ($count_of_11 == 2) or ($count_of_12 == 2)){
			$result = 12;
		} 
    }
	return $result;
}

function test_winning_hand($rank) {
	global $cards;
	switch ($rank) {
		case 1; //royal flush
			$cards[1][1] = 1;
			$cards[2][1] = 13;
			$cards[3][1] = 12;
			$cards[4][1] = 11;
			$cards[5][1] = 10;
			$cards[1][2] = 1;
			$cards[2][2] = 1;
			$cards[3][2] = 1;
			$cards[4][2] = 1;
			$cards[5][2] = 1;
			$result = 1;
			echo "<p>Evaluating Royal Flush...$result";
			break;
		case 2; //Straight Flush
			$cards[1][1] = 2;
			$cards[2][1] = 3;
			$cards[3][1] = 4;
			$cards[4][1] = 5;
			$cards[5][1] = 6;
			$cards[1][2] = 2;
			$cards[2][2] = 2;
			$cards[3][2] = 2;
			$cards[4][2] = 2;
			$cards[5][2] = 2;
			$result = 2;
			echo "<p>Evaluating Straight Flush...$result";
			break;
		case 3; //Four of a kind
			$cards[1][1] = 5;
			$cards[2][1] = 5;
			$cards[3][1] = 5;
			$cards[4][1] = 5;
			$cards[5][1] = 2;
			$cards[1][2] = 1;
			$cards[2][2] = 2;
			$cards[3][2] = 3;
			$cards[4][2] = 4;
			$cards[5][2] = 1;
			$result = 3;
			echo "<p>Evaluating Four of a kind...$result";
			break;
		case 4; //Full House
			$cards[1][1] = 13;
			$cards[2][1] = 12;
			$cards[3][1] = 13;
			$cards[4][1] = 12;
			$cards[5][1] = 13;
			$cards[1][2] = 1;
			$cards[2][2] = 2;
			$cards[3][2] = 3;
			$cards[4][2] = 4;
			$cards[5][2] = 2;
			$result = 4;
			echo "<p>Evaluating Full House...$result";
			break;
		case 5; //Flush
			$cards[1][1] = 2;
			$cards[2][1] = 3;
			$cards[3][1] = 9;
			$cards[4][1] = 12;
			$cards[5][1] = 7;
			$cards[1][2] = 4;
			$cards[2][2] = 4;
			$cards[3][2] = 4;
			$cards[4][2] = 4;
			$cards[5][2] = 4;
			$result = 5;
			echo "<p>Evaluating Flush...$result";
			break;
		case 6; //Straight
			$cards[1][1] = 2;
			$cards[2][1] = 3;
			$cards[3][1] = 4;
			$cards[4][1] = 5;
			$cards[5][1] = 6;
			$cards[1][2] = 1;
			$cards[2][2] = 2;
			$cards[3][2] = 3;
			$cards[4][2] = 4;
			$cards[5][2] = 4;
			$result = 6;
			echo "<p>Evaluating Straight...$result";
			break;
		case 7; //Three of a kind
			$cards[1][1] = 2;
			$cards[2][1] = 2;
			$cards[3][1] = 2;
			$cards[4][1] = 5;
			$cards[5][1] = 6;
			$cards[1][2] = 1;
			$cards[2][2] = 2;
			$cards[3][2] = 3;
			$cards[4][2] = 4;
			$cards[5][2] = 4;
			$result = 7;
			echo "<p>Evaluating Three of a kind...$result";
			break;
		case 8; //Two Pairs
			$cards[1][1] = 2;
			$cards[2][1] = 2;
			$cards[3][1] = 9;
			$cards[4][1] = 9;
			$cards[5][1] = 12;
			$cards[1][2] = 1;
			$cards[2][2] = 2;
			$cards[3][2] = 3;
			$cards[4][2] = 4;
			$cards[5][2] = 4;
			$result = 8;
			echo "<p>Evaluating Two Pairs...$result";
			break;
		case 9; //Pair
			$cards[1][1] = 12;
			$cards[2][1] = 12;
			$cards[3][1] = 5;
			$cards[4][1] = 9;
			$cards[5][1] = 2;
			$cards[1][2] = 1;
			$cards[2][2] = 2;
			$cards[3][2] = 3;
			$cards[4][2] = 4;
			$cards[5][2] = 4;
			$result = 9;
			echo "<p>Evaluating Pair...$result";
			break;
		
	}
	return $result;
}


function SelectCard(){
	// Return a number between 1 and 13 for card  
	srand();
	$random = (rand()%14)+1;
	return $random;
}

function SelectDeck(){
	// Return a number between 1 and 4 for deck
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