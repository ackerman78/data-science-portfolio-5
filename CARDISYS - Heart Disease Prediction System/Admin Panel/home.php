<?php
error_reporting(0);
?>
<?php session_start();
if(!$_SESSION["user_id"]){
header("location:http://localhost/FYP/adminpanel/login.html");
}
?>
<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'cardisys';

$conn = mysqli_connect($servername,$user,$pass,$db);

$sql = "SELECT * FROM predict";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
        .row.content {height: 1500px}
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }
        @media screen and (max-width: 767px) {
        .sidenav {
        height: auto;
        padding: 15px;
        }
        .row.content {height: auto;} 
        }
        </style>
    </head>
    <body>
        <div class="container-fluid">
          <div class="row content">
            <div class="col-sm-3 sidenav">
              <h4>Admin Panel</h4>
                <p><?php echo $_SESSION["user_id"]; ?></p>
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="home.php">Predictions</a></li>
                <li><a href="contact.php">Contact</a></li>
                  <li><a href="changepassword.php">Change Password</a></li>
                  <li><a href="logout.php">Logout</a></li>
              </ul><br>
            </div>
            <div class="col-sm-9">
                <h2>Predictions</h2>
                  <p>Users inputted data.</p>            
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Cp</th>
                        <th>Trestbps</th>
                          <th>Chol</th>
                          <th>Fbps</th>
                          <th>Restecg</th>
                          <th>Thalach</th>
                          <th>Exang</th>
                          <th>Oldpeak</th>
                          <th>Slope</th>
                          <th>Ca</th>
                          <th>Thai</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($signup=$result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".$signup['id']."</td>";
                            echo "<td>".$signup['age']."</td>";
                            echo "<td>".$signup['sex']."</td>";
                            echo "<td>".$signup['cp']."</td>";
                            echo "<td>".$signup['trestbps']."</td>";
                            echo "<td>".$signup['chol']."</td>";
                            echo "<td>".$signup['fbps']."</td>";
                            echo "<td>".$signup['restecg']."</td>";
                            echo "<td>".$signup['thalach']."</td>";
                            echo "<td>".$signup['exang']."</td>";
                            echo "<td>".$signup['oldpeak']."</td>";
                            echo "<td>".$signup['slope']."</td>";
                            echo "<td>".$signup['ca']."</td>";
                            echo "<td>".$signup['thai']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
    </body>
</html>

