<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'cardisys';

$conn = new PDO('mysql:host=localhost; dbname=cardisys;charset=utf8',$user ,$pass);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connection successfull";
}
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];

$sql = "insert into contact(name,email,message) values ('".$_POST['name']."','".$_POST['email']."','".$_POST['message']."')";
$stmt=$conn->prepare($sql);
$stmt->execute(array('Name' => $name ,'Email' => $email,'Message' => $message ));
$conn=null;
header("location:http://localhost/FYP/Cardisys/examples/Cardisys.html#Contact");
?>