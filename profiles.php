<html>
    <head>
        <link rel=stylesheet href=style.css>
        <title>staff profile</title>
</head>
<body>
    <form action="" method="post">
        <div>
        <h2>Details</h2>
        <?php
session_start();
$cid=$_SESSION['cid'];
$sid=$_SESSION['sid'];

function conn(){
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }return $conn;
}
function staff($sid,$cid){
        $conn=conn();
        $sql="SELECT * FROM staff WHERE sid='$sid' AND cid='$cid'";
        $result=$conn->query($sql);
        return $result->fetch_assoc();
}
function update($sid,$cid,$sname,$phone,$address,$email){
    $conn=conn();
    $sql="UPDATE staff SET sname='$sname',phone='$phone',
           address='$address',email='$email' WHERE sid='$sid' AND cid='$cid'";
    return $conn->query($sql);
}

        $row=staff($sid,$cid);
        echo "<table><tr><tr><td>SID</td><td>".$row['sid']."</td></tr>";
        echo "<tr><td>Name</td><td><input type=text name=sname value='".$row['sname']."'</td></tr>";
        echo "<tr><td>Address</td><td><input type=text name=address value='".$row['address']."'</td></tr>";
        echo "<tr><td>Email</td><td><input type=email name=email value='".$row['email']."'</td></tr>";
        echo "<tr><td>Phone</td><td><input type=text name=phone value='".$row['phone']."'</td></tr></table>";
        echo "<br><input type=submit name=submit value=Edit>";
        ?>
        <a href="dashs.html">Back</a>
      </form>
<?php
if(isset($_POST['submit'])){
    $sname=$_POST['sname'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $row=staff($sid,$cid);
    if($sname==$row['sname']  && $phone==$row['phone'] &&
       $address==$row['address'] && $email==$row['email']){
        echo "<h2>No Changes Done</h2>";
    }else if(update($sid,$cid,$sname,$phone,$address,$email)){
        header("Location:profiles.php");
        exit();
    }
}
?>
</div>
</body>
</html>