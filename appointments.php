<html>
    <head> <title>Schedule</title>
        <style>
            .booked {
                background-color: red;
                color: white;
                padding: 10px;
                margin: 5px;
                cursor: not-allowed;
            }
            .time {
                padding: 10px;
                margin: 5px;
            }
            .time:hover {
                background-color: green;
            }
            header {
                margin: 0;
                text-align: center;
                padding: 20px;
                background-color: blue;
            }
            h3 {
                text-align: center;
                color: red;
            }
            div {
                text-align: center;
            }
            #submit {
                padding: 8px;
                border: none;
                color: white;
                border-radius: 4px;
                margin-top: 15px;
            }
        </style>
    </head>
<body>
    <header>
        <form action="" method="post">
            <?php
                session_start();
                $cname = $_SESSION['cname'];
                $specialisation = $_SESSION['specialisation'];
                echo '<h2 style="color:white;">' . $cname . '</h2>';
                echo '<h3 style="color:white;">' . $specialisation . '</h3>';
            ?>
    </header>
    <div>
        <h2 style="color:brown;">Book An Appointment</h2>
        Enter date: <input type="date" name="date" required><br>
        <input type="submit" value="submit" name="submit" style="background-color:  #0056b3;" id="submit"><br>
    </div>
    </form>

    <!-- View, Update, Delete Section -->
    <div>
        <h2 style="color:brown;">Your Appointments</h2>
        <?php
        function conn() {
            $conn = mysqli_connect("localhost", "root", "", "camp");
            if (!$conn) {
                die("Error");
            }
            return $conn;
        }

        function show_user_appointments($conn, $pid, $cid) {
            $sql = "SELECT * FROM appointment WHERE pid='$pid' AND cid='$cid'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "Date: " . htmlspecialchars($row['date']) . " Time: " . htmlspecialchars($row['time']);
                    echo " <form style='display:inline;' method='post' action=''>";
                    echo "<input type='hidden' name='appointment_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='update'>Update</button>";
                    echo "<button type='submit' name='delete'>Delete</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<h3>No appointments found</h3>";
            }
        }

        if (isset($_SESSION['pid']) && isset($_SESSION['cid'])) {
            $conn = conn();
            $pid = $_SESSION['pid'];
            $cid = $_SESSION['cid'];
            show_user_appointments($conn, $pid, $cid);
        }
        ?>
    </div>

    <?php
    if (isset($_POST['delete'])) {
        $conn = conn();
        $appointment_id = $_POST['appointment_id'];
        $sql = "DELETE FROM appointment WHERE id='$appointment_id'";
        if ($conn->query($sql)) {
            echo "<h3>Appointment deleted successfully.</h3>";
        } else {
            echo "Error deleting appointment.";
        }
    }

    if (isset($_POST['update'])) {
        $conn = conn();
        $appointment_id = $_POST['appointment_id'];
        $_SESSION['appointment_id'] = $appointment_id;
        echo "<div><h3>Update Appointment</h3>";
        echo "<form method='post' action=''>";
        echo "New Date: <input type='date' name='new_date' required><br>";
        echo "<input type='submit' value='Update' name='update_appointment' style='background-color: #0056b3;' id='submit'>";
        echo "</form></div>";
    }

    if (isset($_POST['update_appointment'])) {
        $conn = conn();
        $appointment_id = $_SESSION['appointment_id'];
        $new_date = $_POST['new_date'];
        $cid = $_SESSION['cid'];
        $sql = "SELECT COUNT(*) AS count FROM appointment WHERE date='$new_date' AND cid='$cid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            $sql = "UPDATE appointment SET date='$new_date' WHERE id='$appointment_id'";
            if ($conn->query($sql)) {
                echo "<h3>Appointment updated successfully to " . htmlspecialchars($new_date) . ".</h3>";
            } else {
                echo "Error updating appointment.";
            }
        } else {
            echo "<h3>This date is already booked by another person.</h3>";
        }
    }
    ?>
</body>
</html>