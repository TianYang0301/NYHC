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
  $result3->data_seek($j);
  $user_bit_num = $result->fetch_assoc()['user_bit_num'];
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
<p>Your choose Guess Updown</p>
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
	header("location: change_bet_card(updown).php");
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

$app_name = "NYHC - Guess Updown";
$init_exp = (empty($_COOKIE["pref_init_exp"]))	? $userExp : $_COOKIE["pref_init_exp"] ;
$init_bal = (empty($_COOKIE["pref_init_bal"]))	? $userPoint : $_COOKIE["pref_init_bal"] ;
$init_bet = (empty($_COOKIE["pref_init_bet"]))	? $user_bit_num : $_COOKIE["pref_init_bet"] ;
$bet_up = (empty($_COOKIE["pref_bet_up"]))		? 10 : $_COOKIE["pref_bet_up"] ;
$bet_down = (empty($_COOKIE["pref_bet_down"]))	? 10 : $_COOKIE["pref_bet_down"] ;

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
	$balance = $init_bal;
	$exp_plus = $init_exp;
	$bet= $init_bet ;
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


	if (!empty ($_POST["bigger"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
                $cards = array (
                    1 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
                    2 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0)  
                    );
				
				$result2 = get_result();
				switch ($result2) {
					case 2: 
                        $msg = "You Win! <br> The second card bigger than first card.";
                        $balance += ($bet * 2); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> The second card is not bigger than first card.";
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

    if (!empty ($_POST["smaller"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
                $cards = array (
                    1 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
                    2 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0)  
                    );
				
				$result2 = get_result();
				switch ($result2) {
					case 1: 
                        $msg = "You Win! <br> The second card smaller than first card.";
                        $balance += ($bet * 2); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> The second card is not smaller than first card.";
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

    if (!empty ($_POST["same"])){
		if ($step == 0) {	
			$random_flag = 0;
		} else {	
			if ($init == 0) {	
                $cards = array (
                    1 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
                    2 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0)  
                    );
				
				$result2 = get_result();
				switch ($result2) {
					case 3: 
                        $msg = "You Win! <br> The second card equal to first card.";
                        $balance += ($bet * 10); 
                        $userPoint = $balance;
						$exp_plus = ($bet * 0.01) + $userExp;
						$userExp = $exp_plus;
                        break;

					default:
						$msg = "You Lose! <br> The second card is not equal to first card.";
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
	$msg = "Choose The Next Card Value!";

	$cards = array (
				1 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0),
				2 => array( 1 => SelectCard(), 2 => SelectDeck(), 3 => 0, 4 => 0)  
				);
}

switch ($step) {
case 0:
	$card_1 = card_img($cards[1][1],$cards[1][2]);
	$card_2 = card_img($cards[2][1],$cards[2][2]);

	echo " $page_header
		<body>
		<form name=\"post\" action=\"$_SERVER[PHP_SELF]\" method=\"POST\">
		<table border=1 cellspacing=1 cellpadding=1 align=center id = 'game_table'>
			<tr><td colspan = 3 align=center><b>$app_name</i></td></tr>
			<tr ALIGN=CENTER >
				<td> <IMG SRC=" . $card_1 .  " ALT=Card1 width = 90 height = 160>
				<td> <IMG SRC = './Picture/card/01-00.png' width = 90 height = 160>
                <td> <input type=\"submit\" name= \"bigger\" value=\"Bigger\" id = 'game_button1'>
                    <br>
				    <input type=\"submit\" name= \"same\" value=\"Equal\" id = 'game_button1'>
                    <br>
				    <input type=\"submit\" name= \"smaller\" value=\"Smaller\" id = 'game_button1'>
                </tr>
			<tr><td colspan = 3 align=center >$msg</td></tr>

			<tr>
				<td colspan = 3 align = center>You Point: " . number_format($balance,0,'.',',') . "<br>
				You Bet: ". number_format($bet , 0 , '.' , '.') ."
				</td></tr> 
			<tr align=center>
				<td><input type=\"submit\" name= \"btn_plus\" value=\" + \" id = 'game_button11'>
					<input type=\"submit\" name= \"btn_minus\" value=\" - \" id = 'game_button11'></td>
				<td><input type=\"submit\" name= \"btn_new\" value=\"New\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"btn_about\" value=\"About\" id = 'game_button1'></td>

				<input type=\"hidden\" name=\"step\" value=1>		
				<input type=\"hidden\" name=\"init\" value=0>		
				<input type=\"hidden\" name=\"balance\" value=$balance>		
				<input type=\"hidden\" name=\"bet\" value=$bet>	
				<input type=\"hidden\" name=\"exp_plus\" value=$exp_plus>			
				<input type=\"hidden\" name=\"c1c\" value= " . $cards[1][1] . ">		
				<input type=\"hidden\" name=\"c1d\" value= " . $cards[1][2] . ">		
				<input type=\"hidden\" name=\"c2c\" value= " . $cards[2][1] . ">		
				<input type=\"hidden\" name=\"c2d\" value= " . $cards[2][2] . ">	 </tr>
		</table>
		</form>
		</body>";
	break;

case 1: // Deal Zodiac
	$card_1 = card_img($cards[1][1],$cards[1][2]);
	$card_2 = card_img($cards[2][1],$cards[2][2]);

	if ($balance == 0 and $bet == 0) {
		$msg 		.= "<br>Balance and Bet is exhausted. <br>You can continue to play...for nothing.";
	}
	echo "$page_header
		<body>
		<form name=\"post\" action=\"$_SERVER[PHP_SELF]\" method=\"POST\">
		<table border=1 cellspacing=1 cellpadding=1 align=center id = 'game_table'>
			<tr><td colspan = 4 align=center><b>$app_name</i></td></tr>
			<tr ALIGN=CENTER >
				<td> <IMG SRC=" . $card_1 .  " ALT=Card1 width = 90 height = 160>
				<td> <IMG SRC=" . $card_2 .  " ALT=Card1 width = 90 height = 160>
                </tr>
			<tr><td colspan = 4 align=center >$msg</td></tr>

			<tr>
				<td colspan = 4 align = center>You Point: " . number_format($balance,0,'.',',') . "<br>
				You Bet: ". number_format($bet , 0 , '.' , '.') ."
				</td></tr> 
			<tr align=center>
				<td><input type=\"submit\" name= \"btn_plus\" value=\" + \" id = 'game_button11'>
					<input type=\"submit\" name= \"btn_minus\" value=\" - \" id = 'game_button11'></td>
				<td><input type=\"submit\" name= \"btn_new\" value=\"New\" id = 'game_button1'></td>
				<td><input type=\"submit\" name= \"btn_about\" value=\"About\" id = 'game_button1'></td>

				<input type=\"hidden\" name=\"step\" value=1>		
				<input type=\"hidden\" name=\"init\" value=0>		
				<input type=\"hidden\" name=\"balance\" value=$balance>		
				<input type=\"hidden\" name=\"bet\" value=$bet>	
				<input type=\"hidden\" name=\"exp_plus\" value=$exp_plus>			
				<input type=\"hidden\" name=\"c1c\" value= " . $cards[1][1] . ">		
				<input type=\"hidden\" name=\"c1d\" value= " . $cards[1][2] . ">		
				<input type=\"hidden\" name=\"c2c\" value= " . $cards[2][1] . ">		
				<input type=\"hidden\" name=\"c2d\" value= " . $cards[2][2] . ">	 </tr>
		</table>
		</form>
		</body>";
	break;
case 4:
 	// 	About page
	echo "$page_header
		<body>
		<table border=1 cellspacing=1 cellpadding=1 align=center>
			<tr><td align = center colspan = 6><b>$app_name</b></td></tr>
			<tr><td align = center colspan = 6><b>About Guess Updown</b></td></tr>

			<tr><td align = center colspan = 5>
			<table>
			<tr><td align = center><b>**Winning Reward**</b></td></tr>
			<tr><td>Guess Next Cards</td><td align = right>Point</td></tr>
			<tr><td>Equal to First Card</td><td align = right>100</td></tr>
            <tr><td>Bigger to First Card</td><td align = right>20</td></tr>
			<tr><td>Smaller to First Cards</td><td align = right>20</td></tr>
			

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
	
	$result2 = 0;

	if($result2 == 0){
        if(($cards[1][1] > $cards[2][1])){
			$result2 = 1;
        }
    }

    if($result2 == 0){
        if(($cards[1][1] < $cards[2][1])){
			$result2 = 2;
        }
    }

    if($result2 == 0){
        if(($cards[1][1] == $cards[2][1])){
			$result2 = 3;
        }
    }
	return $result2;
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