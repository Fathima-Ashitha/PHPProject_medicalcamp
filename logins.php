<html >
<head>
    <title>Staff Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
    <div class="login-box">
        <h2>Staff Login</h2>
            <b>Username:</b><br><input type="text"  name="username" required><br>
            <b>email:</b><br><input type="email"  name="email" required><br>
            <b>Password:</b><br><input type="password" name="password" required><br>
            <button type="submit"><b>Login</b></button><br>
             <a href="changes.php"><b>Change password</b></a>
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
    $sql = "SELECT * FROM staff WHERE sname = '$name' AND email='$email' AND cid='$cid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password===$row['password']) {
          session_start();
          $_SESSION['sid']=$row['sid'];
          $_SESSION['sname']=$row['sname'];
header("Location:dashs.php");
            exit();
        } else {
           echo "<h3>Invalid Password</h3>";
         }
    } else {
       echo "<h3>No user found</h3>";
      }
      echo"</div>";
 }
?>