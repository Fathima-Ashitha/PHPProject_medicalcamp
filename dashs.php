<html>
<head>
    <title>Staff Dashboard</title>
<link rel=stylesheet href=dash.css>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <ul>
            <li><a href="profiles.php" target="contentFrame">Profile Settings</a></li>
            <li><a href="schedule.php" target="contentFrame">Appointments</a></li>
            <li><a href="allreport.php" target="contentFrame">Reports</a></li>
            <li><a href="resultenter.php" target="contentFrame">Add Reports</a></li>
            <li><a href="logout.php" target="_self">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="welcome-header">
            <h2>Welcome <?php session_start(); $sname=$_SESSION['sname']; echo strtoupper($sname); ?></h2>
            <p>Select an option from the menu on the left to get started.</p>
        </div>
        <iframe name="contentFrame" src="profiles.php" style="width: 100%; height: 80vh; border: none; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);"></iframe>
    </div>
</body>
</html>