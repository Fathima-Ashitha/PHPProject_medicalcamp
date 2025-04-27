<html>
    <head>
        <link rel=stylesheet href=detail.css>
        <title>All Result</title>
</head>
<body>
   <?php
   $conn=mysqli_connect("localhost","root","","camp");
   if(!$conn)
   {die("Error");}
   session_start();
  
   $cid=$_SESSION['cid'];
   $sql="SELECT * FROM test WHERE cid='$cid' ORDER BY sid,pid ASC ";
   $result=$conn->query($sql);
   if($row=$result->fetch_assoc()){
    echo "<br><h2>REPORTS</h2>";
    echo "<table><tr><th>sid</th><th>pid</th><th>Patient Name</th><th>Test</th><th>Date</th><th>Result</th></tr>";
    do{
      $pid=$row['pid'];
      $psql="SELECT name FROM patient WHERE pid='$pid'";
            $presult=$conn->query($psql);
            $prow=$presult->fetch_assoc();
            $name=$prow['name'];
            $dat=strtotime($row['date']);
            $date= date("d-m-y", $dat);
   echo "<tr><td>".$row['sid']."</td><td>".$pid."</td><td>".$name."</td><td>".$row['tname']."</td><td>".$date."</td><td>".$row['result']."</td></tr>";
   }while($row=$result->fetch_assoc());
}else{echo "<br><br><h3>No test yet<h3>";}

   ?>
</body>
