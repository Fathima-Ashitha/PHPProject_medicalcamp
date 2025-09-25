<html>
<head>
    <title>Patient Dashboard</title>
<link rel=stylesheet href=dash.css>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <ul>
            <li><a href="profilep.php" target="contentFrame">Profile Settings</a></li>
            <li><a href="appointment.php" target="contentFrame">Take Appointment</a></li>
            <li><a href="reports.php" target="contentFrame">View Reports</a></li>
            <li><a href="logout.php" target="_self">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="welcome-header">
            <h2>Welcome <?php session_start(); $pname=$_SESSION['pname']; 
            echo strtoupper($pname)?>
            </h2><p>Doctor:<strong> 
        <?php
            $doctor = $_SESSION['doctor'];
            $specialisation=$_SESSION['specialisation'];
        echo $doctor."</strong><br> Specialized <strong>".$specialisation;
    ?>
    </strong></p></div>
        <iframe name="contentFrame" src="profilep.php" style="width: 100%; height: 80vh; border: none; 
         border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"></iframe>
    </div>
</body>
</html>