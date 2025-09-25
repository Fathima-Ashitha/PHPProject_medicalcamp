<html>
<head>
    <title>Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
    <div class="login-box">
        <h2>Chief Login</h2>
       <b>User Name:</b><br><input type="text" name="username" required><br>
       <b>Password:</b><br><input type="password"  name="password" required><br>
            <button type="submit"><b>Login</b></button>
</form> 
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
    $name =$_POST['username'];
    $password = $_POST['password'];
    if ($password==="camp" && $name==="admin") {
      $_SESSION['role'] = 'admin';
header("Location:dasha.php");
            exit();
    }else{
      $conn=mysqli_connect("localhost","root" ,"","camp");
      $cid=$_SESSION['cid'];
      $sql="SELECT * FROM camps WHERE cid='$cid'";
      if($result=$conn->query($sql)){
        $row=$result->fetch_assoc();
        if($row['doctor']==$name && $row['password']==$password){
header("Location:dasha.php");
exit();
        }else{
          echo '<h3>Invalid</h3>';
        }
      }else{echo '<h3>Invalid</h3>';}
    }
         echo"</div>";
 }
?>
