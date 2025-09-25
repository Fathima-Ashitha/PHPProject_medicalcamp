<html>
    <head>
    <link rel=stylesheet href=detail.css>
        <title>schedule</title>
</head>
<body>
    <h2 >SCHEDULING</h2>
    <div class="container1">
    <form method=post action="">
        <h3 style="color:#00796b">Enter date to view the appointments:</h3>
        <input type=date name=date required><br><br>
        <input type=submit name=submit class=submit value=view><br><br>
</form>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }
    session_start();
    $cid=$_SESSION['cid'];
    $start = $_SESSION['start']; //  d-m-y
    $end = $_SESSION['end']; 
    $date=$_POST['date'];

    $startTimestamp = strtotime($start);
    $endTimestamp = strtotime($end);
    $inputTimestamp = strtotime($date);
   

    if ($inputTimestamp >= $startTimestamp && $inputTimestamp <= $endTimestamp) {

    $sql="SELECT * FROM appointment WHERE date='$date' AND cid='$cid' ORDER BY time ASC";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        echo "<table border=1><tr><th>Time</th><th>Patient ID</th><th>Patient Name</th></tr>";
        while($row=$result->fetch_assoc()){
            $pid=$row['pid'];
            $psql="SELECT name FROM patient WHERE pid='$pid' and cid='$cid'";
            $presult=$conn->query($psql);
            $prow=$presult->fetch_assoc();
            $name=$prow['name'];
            echo"<tr><td>".$row['time']."</td><td>".$pid."</td><td>".$name."</td></tr>";
        }
            echo "</table>";
    }else{
        echo "<h4>No Appointments Till Now<h4>";
    }
}else{
    echo "<h4>Invalid Date<h4>";
}
}
?>