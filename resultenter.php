<html>
<head>
  <link rel="stylesheet" href="style.css">
  <title>Result</title>
</head>
<body> 
  <div><h2 >Result Entry</h2>
  <form method=post action="" enctype="multipart/form-data">
  Enter patient id:<input type="number" name="id" required>
 Enter Result:<input type="file" name="result" accept="image/png, image/jpg, image/jpeg" required>
  <button type=submit  name=submit>submit</button>
  </form>
    </body>
</html>
<?php
function valid_id($conn,$pid,$cid){
    $sql="SELECT COUNT(*) AS count FROM patient WHERE pid='$pid' AND cid='$cid'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $count=$row['count'];
    return $count>0;
}
if(isset($_POST['submit'])){
$conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }
    session_start();
    $cid=$_SESSION['cid'];
    $pid=$_POST['id'];

    if(valid_id($conn,$pid,$cid)){
        $tdate= date("Y-m-d");
        $start=$_SESSION['start'];
        $end=$_SESSION['end'];


        $startTimestamp = strtotime($start); 
        $endTimestamp = strtotime($end);
        $datee = strtotime($tdate);
        if ($datee <= $endTimestamp && $datee >= $startTimestamp) {
         
          
          $fileName = $_FILES['result']['name'];

            
        $sid=$_SESSION['sid'];
        $sql = "INSERT INTO test (cid, sid, pid, date, result) VALUES 
        ('$cid', '$sid', '$pid', '$tdate', '$fileName')";

        if($conn->query($sql)){
         $message= "Inserted";
        }
    }else{$message="Not valid Date";}
    }else{$message="No such Patient";}
  if(isset($message)){
        echo '<p><b>'.$message .'<b></p>';
  }
   
echo"</div>";
}
?>