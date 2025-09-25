<html>
    <head>
        <link rel=stylesheet href=style.css>
        <title>camp</title>
</head>
<body>
    <form action="" method="post">
        <div style="width:400px;">
        <?php
session_start();
$cid=$_SESSION['cid'];

function conn(){
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("Error");
    }return $conn;
}
function camp($cid){
    $conn=conn();
    $sql="SELECT * FROM camps WHERE cid='$cid'";
    $result=$conn->query($sql);
    return $result->fetch_assoc();
}
        $row=camp($cid);
        echo "<table><tr><tr><td>CAMP ID</td><td>".$row['cid']."</td></tr>";
        echo "<tr><td>Camp Name</td><td><input type=text name=cname value='".$row['cname']."'</td></tr>";
        echo "<tr><td>Location</td><td><input type=text name=loc value='".$row['loc']."'</td></tr>";
        echo "<tr><td>Specialisation</td><td><input type=text name=specialisation value='".$row['specialisation']."'</td></tr>";
        echo "<tr><td>Phone</td><td><input type=integer name=phone value='".$row['phone']."'</td></tr>";
        echo "<tr><td>Starting Date</td><td><input type=date name=start value='".$row['start']."'</td></tr>";
        echo "<tr><td>Ending Date</td><td><input type=date name=end value='".$row['end']."'</td></tr>";
        echo "<tr><td>Starting Time</td><td><input type=time name=startt value='".$row['startt']."'</td></tr>";
        echo "<tr><td>Ending Time</td><td><input type=time name=endt value='".$row['endt']."'</td></tr>";
        echo "<tr><td>Doctor</td><td><input type=text name=doctor value='".$row['doctor']."'</td></tr>";
        echo "<tr><td>Description</td><td><input type=text name=description style='width:280px;' value='".$row['description']."'>
          </td></tr></table>";
        echo "<br><input type=submit name=submit value=Edit>";
        ?>
      </form>
<?php
if(isset($_POST['submit'])){
    $cname=$_POST['cname'];
    $loc=$_POST['loc'];
    $specialisation=$_POST['specialisation'];
    $phone=$_POST['phone'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $startt=$_POST['startt'];
    $endt=$_POST['endt'];
    $doctor=$_POST['doctor'];
    $description=$_POST['description'];
    $row=camp($cid);
    $conn=conn();
    $sql="UPDATE camps SET cname='$cname',loc='$loc',specialisation='$specialisation',phone='$phone',
     start='$start',end='$end',startt='$startt',endt='$endt',doctor='$doctor',description='$description'
     WHERE cid='$cid'";
    if( $conn->query($sql))
    {echo "<span class=success>Done</span>";
        $_SESSION['cname']=$cname;
    header("refresh:2;url=updatecamp.php");
        exit();
}
}
?>
</div>
</body>
</html>