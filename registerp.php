<html>
<head>
<link rel=stylesheet href=style.css>
    <title>Registration</title>
</head>
<body>
<div>
    <form  method="POST" action="">
        <h2>Patient registration</h2>
        <table>
        <tr><td>Name: </td><td><input type="text" name="name" required></td></tr>
        <tr><td>Age: </td><td><input type="number" name="age" required></td></tr>
        <tr><td>Gender: </td><td>
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select></td></tr>
        <tr><td>Phone: </td><td><input type="int" name="phone" required></td></tr>
        <tr><td>Address:</td><td><textarea name="address" required></textarea></td></tr>
        <tr><td>Password: </td><td><input type="password" name="password" required></td></tr>
        <tr><td>Email:</td><td><input type="email" name="email" required></td></tr></table>
        <button type="submit" name="SUBMIT" >Submit</button>
       <a href="loginp.php">Go to login</a>
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $cid=$_SESSION['cid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $conn = mysqli_connect("localhost", "root", "", "camp");
 $sql = "SELECT * FROM patient WHERE name='$name' AND age='$age' AND address='$address' AND email='$email' AND cid='$cid'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Already registered.</h2>";
    } else {
        $sql = "SELECT MAX(pid) AS largepid FROM patient WHERE cid='$cid'";
        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $nowpid = $row['largepid'] ? $row['largepid'] : 0;
        } 
        $pid = $nowpid + 1;


        $sql = "INSERT INTO patient (cid, pid, name, age, gender, phone, address, email, password) 
                VALUES ('$cid', '$pid', '$name', '$age', '$gender', '$phone', '$address', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "<h2>Registration Successful</h2>";
        } else {
            echo "<h2>Error</h2>";
        }
    }
}
?>