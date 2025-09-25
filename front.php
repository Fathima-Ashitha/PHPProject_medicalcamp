<html>
    <head>
        <link rel="stylesheet" href="front.css">
        <title>camp</title>
</head>
<body>
    <?php
    session_start();
    $conn=mysqli_connect("localhost","root","","camp");
    if(!$conn){
        die("error");
    }
    if(isset($_GET['cid'])){
    $last_id=$_GET['cid'];
    $_SESSION['cid']=$last_id;
    $sql="SELECT * FROM camps WHERE cid='$last_id'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    echo '<header><h1>"'.htmlspecialchars($row['cname']).'"<a href="logina.php"><img src="admin.png" alt="Admin" class="admin"></a>
            <br></h1><h2>'.htmlspecialchars($row['loc']).'</h2></header>';
            $_SESSION['start']=$row['start'];
      $_SESSION['end']=$row['end'];
      $sd=strtotime($row['start']);
      $ed=strtotime($row['end']);
      $start= date("d-m-y", $sd);
      $end= date("d-m-y", $ed);
      
      $_SESSION['cname']=$row['cname'];
      $_SESSION['startt']=$row['startt'];
      $_SESSION['endt']=$row['endt'];
      $doctor=$row['doctor'];
      $_SESSION['doctor'] =$doctor;

      
      $_SESSION['specialisation']=$row['specialisation'];
      echo '<h3>SPECIALIZED '.$row['specialisation'].' From '.$start.' to '.$end.'<br><br>'.$row['startt'].'am to '.$row['endt'].'pm<br><br>'
         .htmlspecialchars($row['description']).' by doctor '
         .$doctor.'</h3><h3>ph:'.htmlspecialchars($row['phone']).'</h3><br>';

 if ($ed > time()){

      echo '<p>We are here to provide the best medical care for you. Please register or login to book your appointment.</p>';
      echo '<br><br><a href="registerp.php" class=btn>Patient Registration</a><a href="loginp.php" class=btn>Patient Login</a>';
    }
      echo  '<a href="logins.php" class=btn>Staff Login</a>';
      echo '<footer>&copy; 2024 '. htmlspecialchars($row['cname']).' All rights reserved.</footer>';
    }
    ?>
</body>
</html>