<html>
<head>
<link rel=stylesheet href=detail.css>
        <title>All staff</title>
</head>
<body>
    <h2 >ALL STAFFS</h2>
    <?php
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }
    session_start();
    $cid=$_SESSION['cid'];
    $sql="SELECT * FROM staff WHERE cid='$cid'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
   echo "<table border=1> <tr><th>SID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th></tr>";
    while($row=$result->fetch_assoc())
    {
        echo '<tr><td>'.$row['sid'].'</td><td>'.$row['sname'].'</td><td>'.$row['email'].'</td><td>'
        .$row['phone'].'</td><td>'.$row['address'].'</td></tr>';
    }
    echo '</table>';
    }else{
         echo "<h3>Nothing</h3>";
        }
    ?>
    </body>
    </html>