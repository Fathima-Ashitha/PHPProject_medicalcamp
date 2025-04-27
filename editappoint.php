<html>
    <head>
        <link rel=stylesheet href=appoint.css>
</head>
<body>
<?php
session_start();
function conn(){
    $conn=mysqli_connect("localhost","root","","camp");
 if(!$conn){
    die("Error");
 } return $conn;
}
if (isset($_POST['time'])) {
    $conn = conn();
    $appointment_id = $_POST['pid'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $cid = $_SESSION['cid'];

    if (!available($conn, $date, $time, $cid)) {
        echo "<h3>This time slot is already booked by another person</h3>";
    } else {
        $sql = "UPDATE appointment SET time='$time' WHERE pid='$appointment_id' AND date='$date' AND cid='$cid'";
        if ($conn->query($sql)) {
            echo "<h3 style='color:#555;'>Appointment updated successfully to </h3><h2>" . htmlspecialchars($time) . " on " . htmlspecialchars($date) . ".</h2>";
        } else {
            echo "Error updating appointment.";
        }
    }
}
if (isset($_POST['delete'])) {
    $conn = conn();
    $pid = $_POST['pid'];
    $date=$_POST['date'];
    $sql = "DELETE FROM appointment WHERE pid='$pid' AND date='$date'";
    if ($conn->query($sql)) {
        echo "<h3>Appointment deleted successfully.</h3>";
    } else {
        echo "Error deleting appointment.";
    }
}
if (isset($_POST['update'])) {
    $conn = conn();
    $pid = $_POST['pid'];
    $date = $_POST['date'];
    $cid = $_SESSION['cid'];
    $startt = $_SESSION['startt'];
    $endt = $_SESSION['endt'];

    echo "<h2>Select a new time for the appointment on " . htmlspecialchars($date) . ":</h2>";
    $available_slots = show_slots($conn, $date, $cid, $startt, $endt);
    
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="pid" value="' . htmlspecialchars($pid) . '">';
    echo '<input type="hidden" name="date" value="' . htmlspecialchars($date) . '">';
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
?>
</body>
</html>