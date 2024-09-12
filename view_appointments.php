<?php
include 'connect.php';
session_start(); // Start the session

// Ensure the doctor is logged in and retrieve their username
if (!isset($_SESSION['doctor_name'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$doctor_username = $_SESSION['doctor_name']; // Get doctor username from session

// Fetch the doctor's name from the doctors table using the username
$doctor_query = "SELECT name FROM doctors WHERE username = '$doctor_username'";
$doctor_result = mysqli_query($conn, $doctor_query);

// Check if the doctor exists in the doctors table
if ($doctor_result && mysqli_num_rows($doctor_result) > 0) {
    $doctor_row = mysqli_fetch_assoc($doctor_result);
    $doctor_name = $doctor_row['name']; // Get the doctor's name
} else {
    echo "Doctor not found $doctor_name $doctor_username.";
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>View Appointments</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .logout {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .logout .nav-link {
            background-color: #dc3545; 
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-align: center;
        }

        .logout .nav-link:hover {
            background-color: #c82333; 
        }

        .navbar-nav .nav-item:not(.logout) .nav-link:hover {
            background-color: #0056b3; 
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkHfh6EXrWjFl5W8A7VvZOJ3BCsw2P0ndKv6ikHi" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
        <a class="navbar-brand" href="dochome.php">HC_Clinic</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="dochome.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <center>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient ID</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to get appointments for the logged-in doctor using the doctor's name
            $sql = "SELECT app_id, p_id, doc_name, date, time
                    FROM appointments
                    WHERE doc_name = '$doctor_name'"; // Match by doctor's name

            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $app_id = $row['app_id'];
                    $p_id = $row['p_id'];
                    $doc_name = $row['doc_name'];
                    $date = $row['date'];
                    $time = $row['time'];

                    echo '
                    <tr>
                        <td>' . $app_id . '</td>
                        <td>' . $p_id . '</td>
                        <td>' . $doc_name . '</td>
                        <td>' . $date . '</td>
                        <td>' . $time . '</td>
                        <td>
                            <a href="update_appointment.php?id=' . $app_id . '&status=Complete">Complete</a> 
                            <a href="update_appointment.php?id=' . $app_id . '&status=Ongoing">Ongoing</a>
                        </td>
                    </tr>';
                }
            } else {
                echo "<tr><td colspan='6'>No appointments found for $doctor_name $doc_name.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </center>

</body>
</html>
