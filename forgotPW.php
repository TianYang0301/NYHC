<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "NYHC";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userEmail = mysqli_real_escape_string($conn,$_POST['userEmail']);
    $userPassword = mysqli_real_escape_string($conn,$_POST['userPassword']); 
    
    $sql = "SELECT userEmail FROM NYHCUser WHERE userEmail = '$userEmail' and userPassword = '$userPassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);
      
    if($count == 1) {
       header("location: NYHC_Game.php");
    }else {
       echo "<script>alert('Your User Email or Password is invalid')</script>";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NYHC | User Sign In</title>
    <link rel="stylesheet" href="accountPage.css">
</head>
<body>

<form method = "post">
<center><img src="Picture/NYHC_logo.png" width = "960" height = "270">
<p>** User Sign In by Email**
<a href="landing_page.php"><input type="button" value="Back ->" id = "backButton"></a></p>
<table border="1" style="text-align: left;" id="css001">

<tr>
<td>User Email: </td>
<td><input type = "email" name = "userEmail" id = "t001"></td>
</tr>

<tr>
<td>Password: </td>
<td><input type = "password" name = "userPassword" id = "t001"></td>
</tr>

<tr><td colspan = "4"><input type = "submit" value = "Sign In" id = "t002"></td></tr>

</table>
</form>

<p><a href="signin.php" data-toggle="modal" data-dismiss="modal">Forgot Your Email?</a></p>

<p class="userRegister">Have Not Account??
<a href="register.php" data-toggle="modal" data-dismiss="modal">Click Me</a></p>

<p class= "adminlogin">Admin Login??
<a href="adminLogin.php" data-toggle="modal" data-dismiss="modal">Click Me</a></p>

</body>
</html>

<?php
date_default_timezone_set("Asia/Shanghai");
echo date("Y-m-d") ,"&nbsp";
echo date("H:i:s");
?>