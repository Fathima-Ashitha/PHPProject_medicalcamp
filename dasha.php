<html>
<head>
    <link rel=stylesheet href=dash.css>
</head>
<body>
<div class="sidebar">
<h3>Menu</h3>
        <ul>
            <li><a href="updatecamp.php" target="contentFrame">Edit camp</a></li>
            <li><a href="registers.php" target="contentFrame">Add Staff</a></li>
            <li><a href="details.php" target="contentFrame">Manage Staff</a></li>
            <li><a href="detailp.php" target="contentFrame">Patients</a></li>
            <li><a href="schedule.php" target="contentFrame">Appointments</a></li>
            <li><a href="allreport.php" target="contentFrame">Reports</a></li>
            <li><a href="logout.php" target="_self">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div >
        <?php

session_start(); 
if(isset($_SESSION['role'])){
    echo '<div class="top-links">';
    echo '<a href="camp.php" target="contentFrame"><b >VIEW CAMPS</b></a>';
    echo '<a href="newcamp.php" target="contentFrame"><b >NEW CAMP</b></a>';
    echo '</div>';
}
        $doctor=$_SESSION['doctor'];
        if(isset($_SESSION['cname'])){
            $cname=$_SESSION['cname'];
            echo '<h2 style="margin-top: -2px">"'.$cname.'"</h2>
            <h3 style="text-align:right">';
        }     
        if (!isset($_SESSION['role'])){
        echo '<h3>Welcome ';
        }
        echo $doctor.'</h3>';
        
     if(!isset($_SESSION['role'])){
        echo"<iframe name='contentFrame' src='updatecamp.php' style='width: 100%; 
        height: 80vh;border: none; border-radius: 8px; box-shadow: 0 2px 10px 
        rgba(0, 0, 0, 0.1);'></iframe>";
     }else{
        echo"<iframe name='contentFrame' src='camp.php' style='width: 100%; 
        height: 80vh;border: none; border-radius: 8px; box-shadow: 0 2px 10px 
        rgba(0, 0, 0, 0.1);'></iframe>";
        }
        
        ?>
    </div>
</body>
</html>