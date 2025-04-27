<html>
<head>
  <style>
    body{
     display:flex;
     justify-content:center;
     align-items:center;
     line-height:1.75;
     height:90vh;
    }
    button{
     border-radius:5px;
     padding:8px;
     margin:10px 0px 10px 0px;
     width:100%;
     background-color: green;
     color:white;
     border-radius:40px;
     cursor:pointer; 
    }
    td{
     padding:5px;
    }
    button:hover{
     background-color:white;
     color:green;
    }
    h2{
     color:blue;
     text-align:center;
     text-decoration:underline;
    }
    p{
        text-align:center;
    }
  </style>
  <title>Result</title>
</head>
<body> 
  <div><h2 >Result Entry</h2>
  <form method=post action="">
  <table>
<tr><td>Enter patient id:<br><input type="number" name="id" required></td><td>
  Enter Test name:<br> <input type="text" name="test" required></td><td>
  Enter date:<br> <input type="date" name="date" required></td><td>
 Enter Result:<br> <textarea name="result" rows=5 cols=41  required></textarea></td></tr></table>
  <button type=submit  name=submit>submit</button></td>
  </form>
    </body>
</html>
<?php
function valid_id($conn,$pid){
    $sql="SELECT COUNT(*) AS count FROM patient WHERE pid='$pid'";
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
    $pid=$_POST['id'];
    if(valid_id($conn,$pid)){
        $tname=$_POST['test'];
        $tdate=$_POST['date'];

        session_start();
        $start=$_SESSION['start'];
        $end=$_SESSION['end'];
        $datee=strtotime($tdate);
        $datee= date("d-m-y", $datee);

        if($datee<=$end && $datee>=$start){
        $result=[];
        $result=$_POST['result'];
        
        $sid=$_SESSION['sid'];
        $sql="INSERT INTO test (sid,pid,tname,date,result) VALUES 
              ('$sid','$pid','$tname','$tdate','$result')";
        if($conn->query($sql)){
         $message= "Inserted";
        }
    }else
      {$message="Not valid date";}
}
       else{
        $message="No such Patient";
       }
    if(isset($message)){
        echo '<p><b>'.$message .'<b></p>';
    }
   
echo"</div>";
}
?>
