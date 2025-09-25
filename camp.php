<html><head>
    <title>Camp</title>
    <link rel="stylesheet" href="camp.css">
</head>
<body>
    <h2>CAMPS</h2>
    <ul>
        <?php
        session_start(); 

        $conn = mysqli_connect("localhost", "root", "", "camp");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM camps WHERE end >= DATE_SUB(NOW(), INTERVAL 1 WEEK) 
                ORDER BY end, cname";
        
        if ($result = $conn->query($sql)) {
            $num = $result->num_rows;
            for ($i = 0; $i < $num; $i++) {
                $row = $result->fetch_assoc();
                $cid = htmlspecialchars($row['cid']);
                $cname = htmlspecialchars($row['cname']); 
                $specialisation = htmlspecialchars($row['specialisation']);
                $start=htmlspecialchars($row['start']);
                $end=htmlspecialchars($row['end']);

                echo '<li>
                        <form method="post" action="">
                            <button type="submit" name="camp" value="' . $cid . '">
                                <b>' . $cname . ': ' . $specialisation . '</b><br><p>From'
                                .$start.' To '.$end.'
                            </p></button>
                        </form>
                      </li>';
            }

            
            if (isset($_POST['camp'])) {
                $cid= $_POST['camp']; 
                $_SESSION['cid']=$cid;
                $sql="SELECT * FROM camps WHERE cid='$cid'";
                $result=$conn->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION['cname']=$row['cname'];
                $_SESSION['start']=$row['start'];
                $_SESSION['end']=$row['end'];
                $_SESSION['startt']=$row['startt'];
                $_SESSION['endt']=$row['endt'];
                $_SESSION['specialisation']=$row['specialisation'];
                $_SESSION['doctor'] =$row['doctor'];

            }
        } else {
            echo "Error "; 
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>

