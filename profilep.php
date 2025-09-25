<html>
    <head>
        <link rel=stylesheet href=style.css>
        <title>patient profile</title>
</head>
<body>
    <form action="" method="post">
        <div>
        <h2>Details</h2>
        <?php
session_start();
$cid=$_SESSION['cid'];
$pid=$_SESSION['pid'];

function conn(){
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }return $conn;
}
function patient($pid,$cid){
    $conn=conn();
    $sql="SELECT * FROM patient WHERE pid='$pid' AND cid='$cid'";
    $result=$conn->query($sql);
    return $result->fetch_assoc();
}

        $row=patient($pid,$cid);
        echo "<table><tr><tr><td>PID</td><td>".$row['pid']."</td></tr>";
        echo "<tr><td>Name</td><td><input type=text name=name value='".$row['name']."'</td></tr>";
        echo "<tr><td>Age</td><td><input type=integer name=age value='".$row['age']."'</td></tr>";
        echo "<tr><td>Gender</td><td><input type=text name=gender value='".$row['gender']."'</td></tr>";
        echo "<tr><td>Phone</td><td><input type=text name=phone value='".$row['phone']."'</td></tr>";
        echo "<tr><td>Address</td><td><input type=text name=address value='".$row['address']."'</td></tr>";
        echo "<tr><td>Email</td><td><input type=email name=email value='".$row['email']."'</td></tr></table>";
        echo "<br><input type=submit name=submit value=Edit>";
        ?>
        
      </form>
<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $row=patient($pid,$cid);
    if($name==$row['name'] && $age==$row['age'] && $gender==$row['gender'] && $phone==$row['phone'] &&
       $address==$row['address'] && $email==$row['email']){
        echo "<h3>No Changes Done</h3>";
    }else {
        $conn=conn();
        $sql="UPDATE patient SET name='$name',age='$age',gender='$gender',phone='$phone',
           address='$address',email='$email' WHERE pid='$pid' AND cid='$cid'";
        if($conn->query($sql)){
            echo "<span class=success>Done</span>";
            $_SESSION['pname']=$name;
            header("refresh:2;url=profilep.php");
            exit();
        }
}
}
?>
</div>
</body>
</html>