<html >
<head>
    <title>Patient Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
    <div class="login-box">
        <h2>Patient Login</h2>
        <b>Username:</b><br> <input type="text"  name="username" required><br>
        <b>Email:</b><br><input type="email"  name="email" required><br>
        <b>Password:</b><br><input type="password" name="password" required><br>
            <button type="submit"><b>Login</b></button><br>
             <a href="changep.php"><b>Change password</b></a>
</form> 
</body>
</html>
<?php
 $conn = mysqli_connect("localhost", "root", "", "camp");
  if (!$conn) {
    die("Connection failed");
  }
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name =$_POST['username'];
    $email =$_POST['email'];
    $password = $_POST['password'];
    session_start();
    $cid=$_SESSION['cid'];
    $sql = "SELECT * FROM patient WHERE name = '$name' AND email='$email' AND cid='$cid'";
    $result = $conn->query($sql);
    if ($result === FALSE) {
        die("Error executing query: " . $conn->error);
    }
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password===$row['password']) {
          session_start();
          $_SESSION['pname']=$name;
          $_SESSION['pid']=$row['pid'];
header("Location:dashp.html");
            exit();
        } else {
           echo "<h2>Invalid Password</h2>";
         }
    } else {
       echo "<h2>No user found with this username.</h2>";
      }
      echo"</div>";
 }
?>
