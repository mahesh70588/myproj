<?php
include ('connect.php'); // Make sure to include this file at the beginning

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<script>
                alert("User already exists!!!");
                window.location.href = "sign-up.php";
              </script>';
        exit(); // Stop further execution
    }

    // Check if passwords match
    if ($password != $cpassword) {
        echo '<script>
                alert("Passwords do not match!!!");
                window.location.href = "sign-up.php";
              </script>';
        exit(); // Stop further execution
    }

    // Hash the password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, phone_no, password) VALUES ('$username', '$phone_no', '$hash')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>
                alert("Registration successful!");
                window.location.href = "login.php"; // Redirect to login page
              </script>';
        exit(); // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    body{
    background-image:
    url('background.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
   }
   body{
    background: url('background.png');
    background-repeat: no-repeat;
    background-size: cover;
    width: 100vw;
    height: 100vh;
}

.navbar-brand{
    font-size: 35px;
}



#form{
    background-color: rgb(255, 255, 255);
    width:28%;
    border-radius: 6px;
    margin: 120px auto;
    padding: 40px;
    box-shadow: 10px 10px 5px rgb(80, 11, 77);
    margin-top: 25px;
}
h1{
    text-align: center;
}
input{
    width: 90%;
    border-radius: 4px;
    border: 3px solid #f6efef;
    padding: 5px;
}

#btn{
    width: 100%;
    color: rgb(255, 255, 255);
    background-color: rgb(108, 22, 190);
    padding: 10px;
    font-weight: 700;
    font-size: larger;
    border-radius: 10px;
}
form label{
    color:rgb(100, 100, 100);
    font-size: 18px;
    font-weight: 500;
}
@media screen and (max-width: 1350px){
    #form{
        width: 40%;
        margin-left: none;
        padding: 40px;
    }
}
@media screen and (max-width: 1100px){
    #form{
        width: 50%;
        margin-left: none;
        padding: 40px;
    }
}
@media screen and (max-width: 700px){
    #form{
        width: 80%;
        margin-left: none;
        padding: 40px;
    }
}
</style>
</head>
  <body>
    
  <?php
    //  include "navbar.php";
    ?>
    
    <div id="form">
         <h1>Sign-Up</h1>
         <form name="form" action="sign-up.php" method="POST">
            <label>Enter Username</label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Enter Phone No</label>
            <input type="tel" id="phone_no" name="phone_no" required><br><br>
            <label>Enter Password</label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Confirm Password</label>
            <input type="password" id="cpass" name="cpass" required><br><br>
            <input type="submit" id="btn" value=Sign-Up name="submit">
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>