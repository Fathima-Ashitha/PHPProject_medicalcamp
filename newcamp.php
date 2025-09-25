    <?php
    $message = '';
    if (isset($_POST['submit'])) {
        $conn = mysqli_connect("localhost", "root", "", "camp");
        if (!$conn) {
            die("Error connecting to database");
        }

        $start = $_POST['start'];
        $end = $_POST['end'];
        $startt = $_POST['startt'];
        $endt = $_POST['endt'];

        $startDate = new DateTime($start);
        $endDate = new DateTime($end);
        $startTime = DateTime::createFromFormat('H:i', $startt);
        $endTime = DateTime::createFromFormat('H:i', $endt);
        $currentDate = new DateTime(); 

        if ($startDate > $currentDate && ($startDate < $endDate || $startDate == $endDate)) {
            if ($startTime < $endTime) {
                $cname = strtoupper($_POST['cname']);
                $loc = strtoupper($_POST['loc']);
                $specialisation = strtoupper($_POST['specialisation']);
                $phone = $_POST['phone'];
                $doctor = strtoupper($_POST['doctor']);
                $password = $_POST['password'];
                $description = strtoupper($_POST['description']);

                $sql = "INSERT INTO camps ( cname, loc, specialisation, phone, start, end, startt, endt, doctor, password, description)
                        VALUES ( '$cname', '$loc', '$specialisation', '$phone', '$start', '$end', '$startt', '$endt', '$doctor', '$password', '$description')";

                if ($conn->query($sql)) {
                    $message = "Done";
                } else {
                    $message = "Error";
                }
            } else {
                $message = 'Time not valid';
            }
        } else {
            $message = 'Date not valid';
        }
    }
    ?>

<html>
    <head>
    <title>Create Camp</title>
    <link rel="stylesheet" href="style.css">
    <style>
        input{
            text-transform:uppercase;
        }
        </style>
        <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <form action="" method="post" >
        <br><br><br>
        <h2 >CREATE CAMP</h2>
        <table>
            <tr><td>Enter CAMP Name:</td>
            <td><input type="text" style="width:300px;" name="cname" required></td>
            </tr>
            <tr><td>Enter Location:</td>
            <td><input type="text" name="loc" required></td>
            </tr>
            <tr><td>Enter Specialisation:</td>
            <td><input type="text" name="specialisation" required></td>
            </tr>
            <tr><td>Enter Phone Number:</td>
            <td><input type="text" name="phone" required></td>
            </tr>
            <tr><td>Enter Starting Date:</td>
            <td><input type="date" name="start" required></td>
            </tr>
            <tr><td>Enter Ending Date:</td>
            <td><input type="date" name="end" required></td>
            </tr>
            <tr><td>Enter The Starting Time:</td>
            <td><input type="time" name="startt" required></td>
            </tr>
            <tr><td>Enter The Ending Time:</td>
            <td><input type="time" name="endt" required></td>
            </tr>
            <tr><td>Enter Chief/Doctor Name:</td>
            <td><input type="text" name="doctor" required></td>
            </tr>
            <tr><td>Enter Password:</td>
            <td><input type="password" name="password" required></td>
            </tr>
        </table>
        Describe About The Camp (Like Sponsors):<br>
        <textarea id="description" rows="4" cols="70%" name="description"  required 
        style="text-transform: uppercase; font-size: 16px; padding: 10px; width: 72%;">
        </textarea><br>
        <button type="submit" name="submit" style="width:520px;">Create</button>
    </form>
    <script>
        <?php if ($message): ?>
            showAlert("<?php echo addslashes($message); ?>");
        <?php endif; ?>
    </script>
    </body>
</html>
