<html>
    <head>
        <link rel=stylesheet href=detail.css>
        <title>Result</title>
</head>
<body>
   <?php
   $conn=mysqli_connect("localhost","root","","camp");
   if(!$conn)
   {die("Error");}
   session_start();
   $pid=$_SESSION['pid'];
   $cid=$_SESSION['cid'];
   $sql="SELECT * FROM test WHERE cid='$cid' AND pid='$pid'";
   $result=$conn->query($sql);
   if($row=$result->fetch_assoc()){
    echo "<br><h2>REPORTS</h2>";
    echo "<table><tr><th>Test</th><th>Date</th><th>Result</th></tr>";
    do{
      $date=strtotime($row['date']);
      $date= date("d-m-y", $date);
      echo "<tr><td>".$row['tname']."</td><td>".$date."</td><td>".$row['result']."</td></tr>";
   }while($row=$result->fetch_assoc());
}else{echo "<br><br><h3>No test yet<h3>";}

   ?>
</body>
