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

$sql = "insert into predict(age,sex,cp,trestbps,chol,fbps,restecg,thalach,exang,oldpeak,slope,ca,thai)
values ('".$_POST['age']."','".$_POST['sex']."','".$_POST['cp']."','".$_POST['trestbps']."','".$_POST['chol']."','".$_POST['fbps']."','".$_POST['restecg']."','".$_POST['thalach']."','".$_POST['exang']."','".$_POST['oldpeak']."','".$_POST['slope']."','".$_POST['ca']."','".$_POST['thai']."')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("location:http://localhost/FYP/Cardisys/examples/Cardisys.html#Predictor");
?>
