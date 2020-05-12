<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'cardisys';

$db = new mysqli($servername,$user,$pass,$db);

if($db->connect_error){
    die ("Connection failed: " .$db->connect_error);
}else{
    echo "Connection successfull";
}

echo "Connection is created";
echo "<br>";

$sql = "create table predict
(id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, age int(5), sex int(5), cp int(5), trestbps int(5), chol int(5), fbps int(5), restecg int(5), thalach int(5), exang int(5), oldpeak float(5), slope int(5), ca int(5), thai int(5))";

if($db->query($sql)===TRUE){
    echo "New table created successfully";
}else{
    echo "Error creating table: " .$db->error;
}

$db->close();
?>