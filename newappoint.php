<html>
    <head>
       <link rel=stylesheet href=appoint.css>
</head>
    <body>
        <form method=post action=""><div>
    <h2 style="color:brown;">Book An Appointment</h2>
    Enter date: <input type=date name=date required><br>
    <input type=submit value=submit name=submit style="background-color:  #0056b3;" id=submit><br>
</div>
</form>
</body>
</html>
<?php

session_start();

function conn(){
    $conn=mysqli_connect("localhost","root","","camp");
 if(!$conn){
    die("Error");
 } return $conn;
}
function display_available_slots($conn, $date, $cid, $appointment_id, $startt, $endt) {
    $available_slots = show_slots($conn, $date, $cid, $startt, $endt);
    
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="appointment_id" value="' . htmlspecialchars($appointment_id) . '">';
    echo '<input type="hidden" name="date" value="' . htmlspecialchars($date) . '">';
    echo '<h4>Morning:</h4>';
    
    foreach ($available_slots['all_morning'] as $slot) {
        $class = in_array($slot, $available_slots['morning']) ? 'time' : 'booked';
        echo '<button type="submit" name="new_time" value="' . htmlspecialchars($slot) . '" class="' . $class . '">' . htmlspecialchars($slot) . '</button>';
    }

    echo '<h4>Evening:</h4>';
    foreach ($available_slots['all_evening'] as $slot) {
        $class = in_array($slot, $available_slots['evening']) ? 'time' : 'booked';
        echo '<button type="submit" name="new_time" value="' . htmlspecialchars($slot) . '" class="' . $class . '">' . htmlspecialchars($slot) . '</button>';
    }
    
    echo '</form>';
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
function show_slots($conn,$date,$cid,$startt,$endt){
 $morning_slots=generate_slots("$startt","12:50",10);
 $evening_slots=generate_slots("14:00","$endt",10);
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
function has_appointment($conn,$date,$pid,$cid){
    $sql="SELECT COUNT(*) AS count FROM appointment WHERE date='$date' AND pid='$pid' AND cid='$cid'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    return $row['count']==0;
}
if (isset($_POST['submit'])) {
    $conn = conn();
    $startt = $_SESSION['startt'];
    $endt = $_SESSION['endt'];
        $start = $_SESSION['start']; //  d-m-y
        $end = $_SESSION['end']; 
        $date = $_POST['date'];
        $currentDate = date('Y-m-d');
    if ($date >= $currentDate){
        
        $startTimestamp = strtotime($start);
        $endTimestamp = strtotime($end);
        $inputTimestamp = strtotime($date);
    
        
        if ($inputTimestamp >= $startTimestamp && $inputTimestamp <= $endTimestamp) {
    

            $dateFormatted = date("d-m-y", strtotime($date));
            $cid = $_SESSION['cid'];
            $pid = $_SESSION['pid'];

            if (has_appointment($conn, $date, $pid, $cid)) {
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="pid" value="' . htmlspecialchars($pid) . '">';
                echo '<input type="hidden" name="cid" value="' . htmlspecialchars($cid) . '">';
                echo '<input type="hidden" name="date" value="' . htmlspecialchars($date) . '">';
                echo '<input type="hidden" name="datee" value="' . htmlspecialchars($dateFormatted) . '">';
                echo '<h3>Slots of ' . htmlspecialchars($dateFormatted) . ':</h3>';

                $available_slots = show_slots($conn, $date, $cid, $startt, $endt);
                
                echo '<h4>Morning:</h4>';
                foreach ($available_slots['all_morning'] as $slot) {
                    $class = in_array($slot, $available_slots['morning']) ? 'time' : 'booked';
                    echo '<button type="submit" name="time" value="' . htmlspecialchars($slot) . '" class="' . $class . '">' . htmlspecialchars($slot) . '</button>';
                }

                echo '<h4>Evening:</h4>';
                foreach ($available_slots['all_evening'] as $slot) {
                    $class = in_array($slot, $available_slots['evening']) ? 'time' : 'booked';
                    echo '<button type="submit" name="time" value="' . htmlspecialchars($slot) . '" class="' . $class . '">' . htmlspecialchars($slot) . '</button>';
                }

                echo '</form>'; 
            } else {
                echo "<h3>You already have an appointment on this date</h3>";
            }
        } else {
            echo "<h3>Not valid Date</h3>";
        }
    }else{
        echo "<h3>Not valid Date</h3>";
    }
}

if(isset($_POST['time'])){
    $conn= conn();
    $cid=$_POST['cid'];
    $pid=$_POST['pid'];
    $date=$_POST['date'];
    $datee=$_POST['datee'];
    $time=$_POST['time'];
    
    $currentDateTime = new DateTime();
    $currentDateTime->modify('+4 hours +30 minutes'); // Add 4 hours and 30 minutes
    $currentDate = $currentDateTime->format('Y-m-d');
    $currentTime = $currentDateTime->format('H:i');

    if ($date == $currentDate && $time <= $currentTime) 
   
   {
        echo "<h3>Cannot schedule in the past</h3>";
    } else {

    if(!available($conn, $date, $time,$cid)){
        echo "<h3>This time slot is already booked by another person</h3>";
    }else{
        $sql="INSERT INTO appointment (cid, pid, date, time) VALUES ('$cid', '$pid', '$date', '$time')";
        if($conn->query($sql)){
            echo "<h3 style='color:#555;'>Appointment scheduled successfully on </h3><h2>".htmlspecialchars($datee)." at ".htmlspecialchars($time).".</h2>";
        }else{
            echo "Error";
        }
    }
    }
}
?>