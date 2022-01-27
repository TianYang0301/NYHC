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

$query2 = "SELECT * FROM NYHCPointRedemption";
$result2 = $conn->query($query2);
$rows2 = $result2->num_rows;

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
	<title>NYHC | Point Redemption</title>
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

<p>Point Redemption Zone&nbsp; 
    <a href="NYHC_Game.php"><input type="button" value="Back" id = "game_button1"></a>
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
</table>
<br>
<table border="1" id = "game_table">



<tr>
<th>No.</th>
<th>Name</th>
<th>Start Date</th>
<th>Last Date</th>
<th>Condition</th>
<th>Unlock Type</th>
<th>Quality</th>
<th>Claim</th>
</tr>

<?php
    for($j = 0, $noNumber = 1; $j < $rows2; ++$j, $noNumber++){
        $result2->data_seek($j);
        $pointID = $result2->fetch_assoc()['pointID'];
        $result2->data_seek($j);
        $pointName = $result2->fetch_assoc()['pointName'];
        $result2->data_seek($j);
        $pointStartDate = $result2->fetch_assoc()['pointStartDate'];
        $result2->data_seek($j);
        $pointLastDate = $result2->fetch_assoc()['pointLastDate'];
        $result2->data_seek($j);
        $pointCondition = $result2->fetch_assoc()['pointCondition'];
        $result2->data_seek($j);
        $unlockType = $result2->fetch_assoc()['unlockType'];
        $result2->data_seek($j);
        $pointQuatity = $result2->fetch_assoc()['pointQuatity'];
        $result2->data_seek($j);
        $pointLink = $result2->fetch_assoc()['pointLink'];

        if ($pointCondition == 1){
            $condition_display = 'No Level Limit';
        }

        if ($pointCondition == 2){
            $condition_display = 'Level must reach 5';
        }

        if ($pointCondition == 3){
            $condition_display = 'Level must reach 10';
        }

        if ($pointCondition == 4){
            $condition_display = 'Level must reach 20';
        }

        if ($unlockType == 1){
            $type_display = 'Game Mode';
        }

        if ($unlockType == 2){
            $type_display = 'Background';
        }

        if ($unlockType == 3){
            $type_display = 'Card Style';
        }

        if ($unlockType == 4){
            $type_display = 'Draw Ticket';
        }

        echo "<tr><td align = 'center'>$noNumber</td>";
        //echo "<td align = 'center'>$pointID</td>";
        echo "<td align = 'center'>$pointName</td>";
        echo "<td align = 'center'>$pointStartDate</td>";
        echo "<td align = 'center'>$pointLastDate</td>";
        echo "<td align = 'center'>$condition_display</td>";
        echo "<td align = 'center'>$type_display</td>";
        echo "<td align = 'center'>$pointQuatity</td>";
        echo "<td align = 'center'><input type = 'submit' class = $pointID name = $pointQuatity value = 'Claim' id = 't001'></td></tr>";
        
        $current_date = date("Y-m-d");
                
        if (!empty($_POST["$pointQuatity"])) {
            if ($userPoint > $pointQuatity){
                if (strtotime($pointLastDate) > strtotime($current_date) && strtotime($pointStartDate) < strtotime($current_date)) {
                    if ($pointCondition == 1){
                        $balance = $userPoint - $pointQuatity;
                        $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
                        $result2 = $conn->query($query2);
                        //echo "<script>alert('You have redemption $pointQuatity points!')</script>";
                        header("location: $pointLink");
                    }
                    if ($condition_display == 'Level must reach 5'){
                        if ($userLevel >= 5){
                            $balance = $userPoint - $pointQuatity;
                            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
                            $result2 = $conn->query($query2);
                            //echo "<script>alert('You have redemption $pointQuatity points!')</script>";
                            header("location: $pointLink");
                        }
                        if ($userLevel <= 4) {
                            echo "<script>alert('You level must reach level 5!')</script>";
                        }
                    }
                    if ($pointCondition == 3){
                        if ($userLevel >= 10){
                            $balance = $userPoint - $pointQuatity;
                            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
                            $result2 = $conn->query($query2);
                            //echo "<script>alert('You have redemption $pointQuatity points!')</script>";
                            header("location: $pointLink");
                        }
                        if ($userLevel < 10){
                            echo "<script>alert('You level must reach level 10!')</script>";
                        }
                    }
                    if ($pointCondition == 4){
                        if ($userLevel >= 20){
                            $balance = $userPoint - $pointQuatity;
                            $query2 = "UPDATE NYHCUser SET userPoint = $balance WHERE userID = $userID";
                            $result2 = $conn->query($query2);
                            //echo "<script>alert('You have redemption $pointQuatity points!')</script>";
                            header("location: $pointLink");                    
                        }
                        if ($userLevel < 20){
                            echo "<script>alert('You level must reach level 20!')</script>";
                        }
                    }
                    
                }

                if (strtotime($pointLastDate) < strtotime($current_date)) {
                    echo "<script>alert('This reward has expired.')</script>";
                }
                if (strtotime($pointStartDate) > strtotime($current_date)) {
                    echo "<script>alert('This redemption has not yet started.')</script>";
                }
            }
            if ($userPoint < $pointQuatity) {
                echo "<script>alert('You Point is enough! You need have $pointQuatity minimum point.')</script>";
            }
        }
    }
?>


</form>
</body>
</html>