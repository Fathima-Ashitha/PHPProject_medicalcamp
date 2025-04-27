<html>
    <head>
        <title>create camp</title>
        <link rel=stylesheet href=style.css>
</head>
<body>
    <div>
        <form action="" method=post>
            <h2>CREATE CAMP</h2>
    Enter CAMP Name:
    <input type=text name=cname required>
    Enter the location:
    <input type=text name=loc required>
    Enter Phone Number:
    <input type=integer name=phone required>
    Enter starting date:
    <input type=date name=start required>
    Enter last date:
    <input type=date name=end required>
    Enter Chief/Doctor name:
    <input type=text name=doctor required>
    Enter password:
    <input type=password name=password required>
    Describe about the speciality of camp:
    <input type=text name=description required><br>
    <button type=submit name=submit>Create</button>
</form>
<?php
if(isset($_POST['submit'])){
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }
    $cname=$_POST['cname'];
    $loc=$_POST['loc'];
    $phone=$_POST['phone'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $doctor=$_POST['doctor'];
    $password=$_POST['password'];
    $description=$_POST['description'];
    $sql="INSERT INTO camps (cid,cname,loc,phone,start,end,doctor,password,description)
      VALUES('cid','$cname','$loc','$phone','$start','$end','$doctor','$password','$description')";
    if($conn->query($sql)){
        echo "<h2>Created</h2>";
    }
}
?>
</div>
</html>
