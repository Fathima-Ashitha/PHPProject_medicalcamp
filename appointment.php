<html>
    <head>
<link rel=stylesheet href=style.css></head>
<body>
   <div>
    <h2 style="text-align:center; color:brown;">Your Appointments</h2>
<?php
 $conn=mysqli_connect("localhost","root","","camp");
 if(!$conn){
   die("Error");
 }session_start();
        $pid = $_SESSION['pid'];
        $cid = $_SESSION['cid'];
        $sql = "SELECT * FROM appointment WHERE pid='$pid' AND cid='$cid'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<b>Date</b>: " . htmlspecialchars($row['date']) . " AND <b> Time</b>: " . htmlspecialchars($row['time']);
                echo "<form method=post action=editappoint.php><input type='hidden' name='pid' value='" . $row['pid'] . "'>";
                echo "<input type='hidden' name='date' value='" . htmlspecialchars($row['date']) . "'>";  
                echo "<button type='submit' style='display:inline-block; width:48%; margin-right:4%' name='update'>Update</button>";
                echo "<button type='submit' style='display:inline-block; width:48%;' name='delete'>Delete</button></form>";
                
            }
            echo "<a href=newappoint.php>New appointment</a>";
           echo "</div>";
        } else {
            header("Location:newappoint.php");
        }

echo ' </body> </html>';
 
?>
</body>
</html>