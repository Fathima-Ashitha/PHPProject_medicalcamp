
<html>
    <head> <title>schedule</title>
        <style>
           .booked{
                background-color:red;
                color:white;
                padding:10px;
                margin:5px;
                cursor:not-allowed;
            }
            .time{
                padding:10px;
                 margin:5px;
            }
            .time:hover{
                background-color:green;
            }
           header{
            margin:0;
            text-align:center;
           padding:20px;
            background-color: blue;
           }
           h3{
           text-align:center;
           color:red;
           }
           div{
            text-align:center;
           }
           #submit{
            padding:8px;
    border:none;
    color:white;
    border-radius:4px;
    margin-top:15px;
           }
            </style>
</head>
<body>
   
    <header>
        <form action="" method=post>
<?php
  session_start();
  $cname=$_SESSION['cname'];
  $specialisation=$_SESSION['specialisation'];
  echo '<h2 style="color:white;">'.$cname.'</h2>';
  echo '<h3 style="color:white;">'.$specialisation.'</h3>';
?>
    </header>
    <div><h2 style="color:brown;">Book An Appointment</h2>
    Enter date: <input type=date name=date required><br>
    <input type=submit value=submit name=submit style="background-color:  #0056b3;" id=submit><br>
     </div>
</form>
</body>
</html>
<?php
function conn()
{$conn=mysqli_connect("localhost","root","","camp");
 if(!$conn){
    die("Error");
 } return $conn;
}
function generate_slots($start,$end,$min){
    $interval=$min*60;
    $slots=[];
    $curr=strtotime($start);
    $end=strtotime($end);
    while($curr<=$end){
        $slots[]=date("H:i:s",$curr);
        $curr=$curr+$interval;
    }  return $slots;
}
function available($conn,$date,$time,$cid){
    $sql="SELECT COUNT(*) AS count FROM appointment WHERE date='$date' AND time='$time' AND cid='$cid'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    return $row['count']==0;
}
function show_slots($conn,$date,$cid){
$morning_slots=generate_slots("07:00","12:50",10);
$evening_slots=generate_slots("14:00","18:50",10);
 $available_morning=[];
 foreach($morning_slots as $time){
    if(available($conn,$date,$time,$cid)){
        $available_morning[]=$time;
    }
 }
 $available_evening=[];
 foreach($evening_slots as $time){
    if(available($conn,$date,$time,$cid)){
        $available_evening[]=$time;
    }
 }
 return['morning' => $available_morning,'evening' => $available_evening,
        'all_morning' => $morning_slots,'all_evening' => $evening_slots];
}
if(isset($_POST['submit']))
{
    $conn=conn();
    $start=$_SESSION['start'];
    $end=$_SESSION['end'];
    $date=$_POST['date'];
    $datee=strtotime($date);
    $datee= date("d-m-y", $datee);
    if($datee<=$end && $datee>=$start)
{
    $cid=$_SESSION['cid'];
    $pid=$_SESSION['pid'];
    $sql="SELECT COUNT(*) AS count FROM appointment WHERE date='$date' AND pid='$pid' AND cid='$cid'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    if($row['count']==0)
    {   echo '<form method=post action="">';
        echo '<input type=hidden name="pid" value="'.$pid.'">';
        echo '<input type=hidden name="cid" value="'.$cid.'">';
        echo '<input type=hidden name="date" value="'.htmlspecialchars($date).'">';
        echo '<input type=hidden name="datee" value="'.htmlspecialchars($datee).'">';
        echo '<h3>Slots of '.htmlspecialchars($datee).':</h3>';
$available_slots=show_slots($conn,$date,$cid);
        echo '<h4>Morning:</h4>';
foreach($available_slots['all_morning'] as $slot){
if(in_array($slot,$available_slots['morning'])){
            $class='time';
         }else{
            $class='booked';
         }
        echo '<button type="submit" name="time" value="'.htmlspecialchars($slot).'" class="'.$class.'">'.htmlspecialchars($slot).'</button>';
    }
        echo '<h4>Evening:</h4>';
foreach($available_slots['all_evening'] as $slot){
if(in_array($slot,$available_slots['evening'])){
            $class='time';
        }else{
            $class='booked';
        }
        echo '<button type="submit" name="time" value="'.htmlspecialchars($slot).'" class="'.$class.'">'.htmlspecialchars($slot).'</button>';
    }
    }else{
        echo "<h3>You already have an appointment on this date</h3>";
    } 
}else{
    echo "<h3>Not A Valid Date</h3>";
}
}
if(isset($_POST['time'])){
    $conn= conn();
    $cid=$_POST['cid'];
    $pid=$_POST['pid'];
    $date=$_POST['date'];
    $datee=$_POST['datee'];
    $time=$_POST['time'];
    if(!available($conn, $date, $time,$cid)){
        echo "<h3>This time slot is already booked by another person</h3>";
    }else{
        $sql="INSERT INTO appointment (cid, pid, date, time) VALUES ('$cid', '$pid', '$date', '$time')";
        if($conn->query($sql)){
            echo "<h3>Appointment scheduled successfully on ".htmlspecialchars($datee)." at ".htmlspecialchars($time).".</h3>";
        }else{
            echo "Error";
        }
    }
}
?>
