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
    if(isset($_SESSION['view'])){
      $sq="SELECT * FROM patient WHERE cid='$cid' AND pid='$pid'";
      $resul=$conn->query($sq);
      if($ro=$resul->fetch_assoc()){
      echo "<h3 style=display:flex;text-align:left;color:brown;>Patient: ".$ro['name']."</h3>";
    }}
    echo "<table><tr><th>Date</th><th>Result</th></tr>";
    do{
      $res=htmlspecialchars($row['result']);
      $date=strtotime($row['date']);
      $date= date("d-m-y", $date);
      echo "<tr><td>".$date."</td><td><a href='view_file.php?result=$res' target='_blank'><button>View</button></td></tr>";
   }while($row=$result->fetch_assoc());
}else{echo "<br><br><h3>No test yet<h3>";}

   ?>
</body>
</html>