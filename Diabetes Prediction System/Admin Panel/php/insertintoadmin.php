<?php
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

$sql = "insert into admin(email,password)
values ('admin@dps.com',md5('dpsadmin'))";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("location:http://localhost/FYP/adminpanel/login.html");
?>
