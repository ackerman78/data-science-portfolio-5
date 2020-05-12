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

$sql = "create table contact
(id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name varchar(50), email varchar(50), message varchar(10000))";

if($db->query($sql)===TRUE){
    echo "New table created successfully";
}else{
    echo "Error creating table: " .$db->error;
}

$db->close();
?>