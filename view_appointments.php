<?php
include 'connect.php';
session_start();

$doctor_username = trim($_SESSION['doctor_name']); // Get doctor username from session

// Fetch the doctor's name from the doctors table using the username
$doctor_query = "SELECT name FROM doctors WHERE username = '$doctor_username'";
$doctor_result = mysqli_query($conn, $doctor_query);

// Check if the doctor exists in the doctors table
if ($doctor_result && mysqli_num_rows($doctor_result) > 0) {
    $doctor_row = mysqli_fetch_assoc($doctor_result);
    $doctor_name = $doctor_row['name']; // Get the doctor's name
} else {
    echo "Doctor not found for username: $doctor_username.";
    exit();
}

// Mark an appointment as completed if requested
if (isset($_GET['complete_id'])) {
    $complete_id = intval($_GET['complete_id']);
    $update_query = "UPDATE appointments SET status = 'Completed' WHERE app_id = $complete_id";
    mysqli_query($conn, $update_query);
    header("Location: view_appointments.php"); // Refresh the page
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
        <div class="container mt-4">
            <h2 class="text-center">View Appointments</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                <?php
                // SQL query to fetch appointments for the logged-in doctor
                $sql = "SELECT app_id, patient_name, doc_name, date, time, status FROM appointments WHERE doc_name = '$doctor_name'";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $app_id = $row['app_id'];
                        $patient_name = $row['patient_name']; // Use patient_name instead of p_id
                        $doc_name = $row['doc_name'];
                        $date = $row['date'];
                        $time = $row['time'];
                        $status = $row['status'];

                        echo '
                        <tr>
                            <td>' . $app_id . '</td>
                            <td>' . $patient_name . '</td> <!-- Display patient_name -->
                            <td>' . $doc_name . '</td>
                            <td>' . $date . '</td>
                            <td>' . $time . '</td>
                            <td>' . $status . '</td>
                            <td>';
                        
                        if ($status == 'Ongoing') {
                            echo '<a href="view_appointments.php?complete_id=' . $app_id . '" class="btn btn-warning btn-sm">Mark as Completed</a>';
                        } else {
                            echo 'Completed';
                        }

                        echo '</td>
                        </tr>';
                    }
                } else {
                    echo "<tr><td colspan='7'>No appointments found for $doctor_name.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </center>

</body>
</html>
