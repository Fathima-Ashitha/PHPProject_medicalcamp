<html>
<head>
    <title>CAMPS</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 30vh;
            background: url("camp.jpg");
            background-repeat:no-repeat;
            background-size:cover;
            background-position:center;
            width:100%;
            height:90vh;
        }
        h1 {
            background: linear-gradient(90deg, #ff7e5f 0%, #feb47b 100%);
            color: white;
            text-align: center;
            border-radius: 10px;
            padding: 20px;
            
            font-size: 44px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .camp-list {
            display: flex;
            justify-content: center;
            margin: 30px auto;
            max-width: 1200px;
            flex-wrap: wrap;
        }
        .container {
            
            border: none;
            border-radius: 20px;
            background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
            color: white;
            padding: 25px;
            margin: 15px;
           width:230px;
           
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        .container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        }
        a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: bold;
            display: inline-block;
            padding: 5px;
            border-radius: 5px;
        }
        
    </style>
</head>
<body>
    <h1>CAMPS</h1>
    <div class="camp-list">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "camp");
        $sql = "SELECT * FROM camps WHERE end >= DATE_SUB(NOW(), INTERVAL 1 WEEK) ORDER BY end, cname";
if($result = $conn->query($sql)){

            $num = $result->num_rows;
            session_start();
            for ($i = 0; $i < $num; $i++) {
                $row = $result->fetch_assoc();
                $cid = $row['cid'];
                echo '<div class="container"><a href="front.php?cid='.$cid .'"><b>'.$row['cname'].':'.$row['specialisation'].'</a></div>';
            }
        }
        ?>
    </div>
</body>
</html>