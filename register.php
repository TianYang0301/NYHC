<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];
    $userName = $_GET['userName'];
    $userEmail = $_GET['userEmail'];
    $userSex = $_GET['userSex'];
    $userPassword = $_GET['userPassword'];
    $userRegisterDate = $_GET['userRegisterDate'];
    $userPoint = $_GET['userPoint'];
    $userLevel = $_GET['userLevel'];
    $userExp = $_GET['userExp'];
    $userBackground = $_GET['userBackground'];
    $userImg = $_GET['userImg'];
    $userCard = $_GET['userCard'];
    $user_draw_num = $_GET['user_draw_num'];

    $query = "INSERT INTO NYHCUser 
    (userID, userName, userEmail, userSex, userPassword, userRegisterDate, userPoint, userLevel, userExp,
    userBackground, userImg, userCard, user_draw_num) 
    VALUES ('$userID', '$userName', '$userEmail', '$userSex', '$userPassword', '$userRegisterDate', 
    '$userPoint','$userLevel', '$userExp', '$userBackground', '$userImg', '$userCard', '$user_draw_num')";

    $result = $conn->query($query);
    if(!$result){
        die("Fatal Error");
    }else{
        echo "<script>alert('Your User ID is $userID')</script>";
    }
}

//$IDGenerate = str_pad(mt_rand(0, 99999999), 8, "0", STR_PAD_BOTH);
//echo 'Series No.';
//echo $userID; 
//echo '<br>'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NYHC | Register Account</title>
    <link rel="stylesheet" href="accountPage.css">
</head>

<body>
<center><img src="Picture/NYHC_logo.png" width = "960" height = "270">

<form action= "register.php" method = "GET">

<p>Register Account <a href="landing_page.php"><input type="button" value="Back->" id = "backButton"></a></p>
<table border="1" style="text-align: left;" id="css001">


<tr>
<td>User Name: </td>
<td><input type = "text" name = "userName" id = "t001"></td>
</tr>

<tr>
<td>Email: </td>
<td><input type = "email" name = "userEmail" id = "t001"></td>
</tr>

<tr>
<td>Sex: </td>
<td>
    <input type = "radio" name = "userSex" id = "t001" value = "Male">Male 
    <input type = "radio" name = "userSex" id = "t001" value = "Female">Female</td>
</tr>

<tr>
<td>Password: </td>
<td><input type = "password" name = "userPassword" id = "t001"></td>
</tr>

<tr>
<td>Register Date: </td>
<td><input type = "date" name = "userRegisterDate" id = "t001" readonly
value = <?php echo date("Y-m-d");?>></td>
</tr>

<input type = "hidden" name = "userID" id = "t001" readonly
value = <?php $IDGenerate = str_pad(mt_rand(0, 99999999), 8, "0", STR_PAD_BOTH); echo $IDGenerate;?>>
<input type = "hidden" name = "userPoint" id = "t001" value = "0"></td>
<input type = "hidden" name = "userLevel" id = "t001" value = "1"></td>
<input type = "hidden" name = "userExp" id = "t001" value = "0"></td>
<input type = "hidden" name = "userBackground" id = "t001" value = "0"></td>
<input type = "hidden" name = "userImg" id = "t001" value = "default_photo.png"></td>
<input type = "hidden" name = "userCard" id = "t001" value = "card"></td>
<input type = "hidden" name = "user_draw_num" id = "t001" value = "0"></td>
<input type = "hidden" name = "user_bit_num" id = "t001" value = "10"></td>

<tr><td colspan = "2"><input type = "submit" value = "Register Account" id = "t002"></td></tr>

</table>
</form>

<p class="userlogin">Have a Account??
<a href="signin.php" data-toggle="modal" data-dismiss="modal">Click Me</a></p>

<p class= "adminlogin">Admin Login??
<a href="adminLogin.php" data-toggle="modal" data-dismiss="modal">Click Me</a></p>

</body>
</html>

<?php
date_default_timezone_set("Asia/Shanghai");
echo date("Y-m-d") ,"&nbsp";
echo date("H:i:s");
?>