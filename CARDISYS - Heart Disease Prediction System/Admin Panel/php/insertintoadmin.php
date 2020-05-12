<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'cardisys';

$conn = mysqli_connect($servername,$user,$pass,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connection successfull";
}

$sql = "insert into admin(email,password)
values ('admin@cardisys.com',md5('cardisys'))";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("location:http://localhost/FYP/adminpanel/login.html");
?>
