<?php
require('admin_view_item.php');
//include("auth.php");
$GMID = $_REQUEST['GMID'];
$query = "SELECT * from NYHCGameMode where GMID ='".$GMID."'"; 
$result = mysqli_query($conn, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <title>NYHC | Edit Game Mode</title>
        <link rel="stylesheet" href="accountPage.css" />
</head>

<body>
    <div class="form">
    <p><a href="dashboard.php">Dashboard</a> 
     | <a href="insert.php">Insert New Record</a> 
     | <a href="logout.php">Logout</a></p>
    <h1>Update Record</h1>

<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$GMID = $_REQUEST['GMID'];
$GMName = $_REQUEST['GMName'];
$GMCardNo = $_REQUEST['GMCardNo'];
$GMLevel = $_SESSION["GMLevel"];
$GMPlayer = $_REQUEST['GMPlayer'];
$GMDescription = $_SESSION["GMDescription"];

$update = "UPDATE NYHCGameMode SET 
GMName = '".$GMName."', GMCardNo = '".$GMCardNo."',
GMLevel = '".$GMLevel."', GMPlayer = '".$GMPlayer."', GMDescription = '".$GMDescription."' WHERE GMID ='".$GMID."'";

mysqli_query($conn, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br>
<a href='admin_view_item.php'>View Updated Record</a>";
}else {
?>
<div>
    <form name="form" method="post" action=""> 
        <input type="hidden" name="new" value="1" />
        <input name="id" type="hidden" required value="<?php echo $row['id'];?>" />
        <p>Game Mode ID: 
        <input name="GMID" placeholder="Start From 1001" type="text" id = "t001"
        required value="<?php if(isset($_GET['GMID'])){ echo $GMID;}?>"></p>

        <p>Game Mode Name:
        <input name="GMName" placeholder="Game Mode Name" type="text" id = "t001"
        required value="<?php if(isset($_GET['GMID'])){ echo $GMName;}?>"></p>

        <p>Card Number:
            <select name="GMCardNo" id = "t001">
            <option value = "48">48</option>
            <option value = "52">52</option>
            <option value = "54">54</option>
        </select></p>

        <p>Level Limit:
        <input name="GMLevel" placeholder="Level" type="text" id = "t001"
        required value="<?php if(isset($_GET['GMID'])){ echo $GMLevel;}?>"></p>

        <p>Number of Player:
            <select name="GMPlayer" id = "t001">
            <option value = "1">1</option>
            <option value = "2">2</option>
            <option value = "3">3</option>
            <option value = "4">4</option>
            <option value = "5">5</option>
    </select></p>

    <p>Point Limit:
    <input name="GMPointLimit" placeholder="Point Limit" type="text" id = "t001"
    required value="<?php if(isset($_GET['GMID'])){ echo $GMPointLimit;}?>"></td></tr></p>

    <p>Link:
    <input name="GMDescription" placeholder="game_mode.php" type = "text" id = "t001"
    required value = "<?php if(isset($_GET['GMID'])){ echo $GMDescription;}?>"></p>

        <p><input name="submit" type="submit" value="Update" /></p>
    </form>
<?php } ?>
</div>
</div>
</body>
</html>