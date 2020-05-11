<?php session_start();
if(!$_SESSION["user_id"]){
header("location:http://localhost/FYP/adminpanel/login.html");
}
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
                <li><a href="home.php">Predictions</a></li>
                <li><a href="contact.php">Contact</a></li>
                  <li class="active"><a href="changepassword.php">Change Password</a></li><br>
                  <li><a href="logout.php">Logout</a></li>
              </ul><br>
            </div>
            <div class="col-sm-9">
                <h2>Change Password</h2>
                  <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                      <input type="password" class="form-control" size="10" name="currentPassword" id="currentPassword" placeholder="Enter Current Password" required autofocus><br>
                      <input type="password" class="form-control" size="10" name="newPassword" id="newPassword" placeholder="Enter New Password" required><br>
                      <input type="password" class="form-control" size="10" name="confirmPassword" id="confirmPassword" placeholder="Re-enter New Password" required><br>
                      <button class="btn btn-lg btn-primary btn-block" type="submit" name="sub">Submit</button>
                </form>
            </div>
          </div>
        </div>
        <script>
        function validatePassword() {
        var currentPassword,newPassword,confirmPassword,output = true;

        currentPassword = document.frmChange.currentPassword;
        newPassword = document.frmChange.newPassword;
        confirmPassword = document.frmChange.confirmPassword;

        if(!currentPassword.value) {
            alert("Please fill in all fields");
        }
        else if(!newPassword.value) {
            alert("Please fill in all fields");
        }
        else if(!confirmPassword.value) {
            alert("Please fill in all fields");
        }
        if(newPassword.value != confirmPassword.value) {
            alert("Passwords doesn't match");
        } 	
        return output;
        }
        </script>
        <?php
        session_start();
        $_SESSION["user_id"];
        $conn = mysqli_connect("localhost", "root", "", "dps") or die("Connection Error: " . mysqli_error($conn));

        if (count($_POST) > 0) {
            $result = mysqli_query($conn, "SELECT *from admin WHERE email='" . $_SESSION["user_id"] . "'");
            $row = mysqli_fetch_array($result);
            if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
                if (md5($_POST["currentPassword"]) == $row["password"]) {
                    mysqli_query($conn, "UPDATE admin set password='" . md5($_POST["newPassword"]) . "' WHERE email='" . $_SESSION["user_id"] . "'");
                    echo '<script>';
                    echo 'alert("Password Changed Successfully")';
                    echo '</script>';
                } else {
                    echo '<script>';
                    echo 'alert("Current Password is not correct")';
                    echo '</script>';
                }
            } else {
                echo '<script>';
                echo 'alert("Mismatch Password")';
                echo '</script>';
            }
            }
        ?>
    </body>
</html>

