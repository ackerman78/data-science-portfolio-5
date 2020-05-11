<?php session_start();
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'dps';

$conn = mysqli_connect($servername,$user,$pass,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connection successfull";
}

$sql = "SELECT * FROM admin where email='".$_REQUEST['email']."' and password='". md5($_REQUEST['password'])."' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
$_SESSION["user_id"]  = $row["email"];
header("location:http://localhost/FYP/adminpanel/home.php");
    }
} 
else {
    echo "<script>";
    echo "alert('Invalid email or password');";
    echo "</script>";
    header("location:http://localhost/FYP/adminpanel/login.html");
}
?>