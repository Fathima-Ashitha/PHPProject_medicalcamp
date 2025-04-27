<html>
<head>
<title>changep</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div>
<form action=" " method="post">
<h2>Change Password</h2>
Enter name:<input type="text" name="name" required><br>
Enter email:<input type="email" name="email" required><br>
Enter new password:<input type="password" name="password" required><br>
<button type="submit" name="submit" >change password</button>
<a href="logins.php">go to login</a>
</form>
</body>
</html>
<?php
function present($conn,$name,$email,$cid){
    $sql="SELECT * FROM staff WHERE sname='$name' AND email='$email' AND cid='$cid'";
    $result=$conn->query($sql);
    if($row=$result->fetch_assoc()){
        if($email===$row['email'] && $name===$row['sname']){
            return true;}
        }
        return false;
        }
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conn =mysqli_connect("localhost", "root", "", "camp");
    if (!$conn) {
        die("Connection failed");
    }
    session_start();
    $cid=$_SESSION['cid'];
   if(present($conn,$name,$email,$cid)){
     $sql="UPDATE staff SET password='$password' WHERE sname='$name' AND email='$email' AND cid='$cid'";
     if($conn->query($sql)){
      echo"<h2>Done</h2>";
         }
    } 
    else
    {echo"<h2>No user found</h2>";
    }
}
echo "</div>";
?>
