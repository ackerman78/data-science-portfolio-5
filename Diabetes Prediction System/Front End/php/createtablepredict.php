<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'dps';

$db = new mysqli($servername,$user,$pass,$db);

if($db->connect_error){
    die ("Connection failed: " .$db->connect_error);
}else{
    echo "Connection successfull";
}

echo "Connection is created";
echo "<br>";

$sql = "create table predict
(id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, pregnancies int(5), glucose int(5), bloodpressure int(5), skinthickness int(5), insulin int(5), bmi float(5), diabetespedigreefunction float(5), age int(5))";

if($db->query($sql)===TRUE){
    echo "New table created successfully";
}else{
    echo "Error creating table: " .$db->error;
}

$db->close();
?>