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
    
    $adminID = mysqli_real_escape_string($conn,$_POST['adminID']);
    $adminPassword = mysqli_real_escape_string($conn,$_POST['adminPassword']); 
    
    $sql = "SELECT adminID FROM NYHCAdmin WHERE adminID = '$adminID' and adminPassword = '$adminPassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    
    $count = mysqli_num_rows($result);
      
    if($count > 0) {
       $_SESSION['adminID'] = $adminID;
       header("location: admin_Page.php");
    }else {
       echo "<script>alert('Your Admin ID or Password is invalid')</script>";
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NYHC | Admin Login</title>
    <link rel="stylesheet" href="accountPage.css">
</head>
<body>

<form method = "post">
<center><img src="Picture/NYHC_logo.png" width = "960" height = "270">
<p>** Admin Sign In **
<a href="landing_page.php"><input type="button" value="Back ->" id = "backButton"></a> </p>
<table border="1" style="text-align: left;" id="css001">

<tr>
<td>Admin ID: </td>
<td><input type = "text" name = "adminID" id = "t001"></td>
</tr>

<tr>
<td>Password: </td>
<td><input type = "password" name = "adminPassword" id = "t001"></td>
</tr>

<tr><td colspan = "4"><input type = "submit" value = "Sign In" id = "t002"></td></tr>

</table>
</form>

<p class= "userlogin">User Login??
<a href="signin.php" data-toggle="modal" data-dismiss="modal">Click Me</a></p>

</body>
</html>

<?php
date_default_timezone_set("Asia/Shanghai");
echo date("Y-m-d") ,"&nbsp";
echo date("H:i:s");
?>