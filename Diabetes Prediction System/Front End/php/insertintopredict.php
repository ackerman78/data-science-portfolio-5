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

$sql = "insert into predict(pregnancies,glucose,bloodpressure,skinthickness,insulin,bmi,diabetespedigreefunction,age)
values ('".$_POST['pregnancies']."','".$_POST['glucose']."','".$_POST['bloodpressure']."','".$_POST['skinthickness']."','".$_POST['insulin']."','".$_POST['bmi']."','".$_POST['diabetespedigreefunction']."','".$_POST['age']."')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("location:http://localhost/FYP/DPS/DPS.html#predictor");
?>
