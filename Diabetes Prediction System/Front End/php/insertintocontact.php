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

$sql = "insert into contact(name,email,message)
values ('".$_POST['name']."','".$_POST['email']."','".$_POST['message']."')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("location:http://localhost/FYP/DPS/DPS.html#contact");
?>
