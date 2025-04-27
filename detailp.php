<html>
<head>
      <link rel=stylesheet href=detail.css>    
        <title>All patient</title>
</head>
<body>
    <h2 >ALL PATIENTS</h2>
    <?php
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }
    session_start();
    $cid=$_SESSION['cid'];
    $sql="SELECT * FROM patient WHERE cid='$cid'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
   echo "<table border=1> <tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Phone</th><th>Address</th><th>Email</th></tr>";
    while($row=$result->fetch_assoc())
    {
        echo '<tr><td>'.$row['pid'].'</td><td>'.$row['name'].'</td><td>'.$row['age'].'</td><td>'.$row['gender'].'</td><td>'.$row['phone'].'</td><td>' .$row['address'].'</td><td>'.$row['email'].'</td></tr>';
    }
    echo '</table>';
    }else{
         echo "<br><h3 >Nothing</h3>";
        }
    ?>
    </body>
    </html>
