<html>
<head>
<link rel=stylesheet href=style.css>
    <title>Staff Management</title>
</head>
<body><div>
    <form method="post" action="">
    <h2>Staff registration</h2>
        <label>Name:</label><input type="text" name="sname" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Phone:</label><input type="integer" name="phone" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <label>Address:</label><input type="text" name="address" required><br>
        <button type="submit" name="submit" >Submit</button>
    </form>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $conn =mysqli_connect("localhost", "root", "", "camp");
    if (!$conn) {
        die("Connection failed ");
    }
session_start();
$cid=$_SESSION['cid'];
$sname = $_POST['sname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$address = $_POST['address'];

$sql = "SELECT * FROM staff WHERE sname='$sname' AND email='$email' AND address='$address' AND cid='$cid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h3>Already registered.</h3>";
    } else {
        $sql = "SELECT MAX(sid) AS largesid FROM staff WHERE cid='$cid'";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $nowsid = $row['largesid'] ? $row['largesid'] : 0;
        } 
        $sid = $nowsid + 1;

    $sql = "INSERT INTO staff (cid, sid, sname, email, password, phone, address) VALUES 
    ('$cid','$sid','$sname', '$email','$password', '$phone','$address')";
    if ($conn->query($sql)) {
        echo "<span class=success>Registration successfull</span>";
    } else {
        echo "<h3>Error</h3>";
    }
    echo '</div>';
}
}
?>