<?php
include 'connect.php';
session_start();

// Check if the logged-in user's role is a patient
if ($_SESSION['role'] != 4) {
    echo "Access denied. You are not authorized to view this page.";
    exit();
}

// Assuming the logged-in patient's username is stored in the session
$patient_username = trim($_SESSION['patient_username']);

// Fetch the patient name from the patients table using the username
$patient_query = "SELECT name FROM patients WHERE username = '$patient_username'";
$patient_result = mysqli_query($conn, $patient_query);

// Check if the patient exists in the patients table
if ($patient_result && mysqli_num_rows($patient_result) > 0) {
    $patient_row = mysqli_fetch_assoc($patient_result);
    $patient_name = $patient_row['name']; // Get the patient's name
} else {
    echo "Patient not found for username: $patient_username.";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>My Appointments</title>
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
    </style>
</head>
<body>
      
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
        <a class="navbar-brand" href="patienthome.php">HC_Clinic</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="patienthome.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="myrecords.php">My Records</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="myappointments.php">My Appointments</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="text-center">Appointments for <?php echo $patient_name; ?></h3>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to get the appointments for the logged-in patient
            $sql = "SELECT app_id, doc_name, date, time, status 
                    FROM appointments 
                    WHERE patient_name = '$patient_name'";  // Filter by the logged-in patient

            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $app_id = $row['app_id'];
                    $doc_name = $row['doc_name'];
                    $date = $row['date'];
                    $time = $row['time'];
                    $status = $row['status'];

                    echo '
                    <tr>
                        <td>' . $app_id . '</td>
                        <td>' . $doc_name . '</td>
                        <td>' . $date . '</td>
                        <td>' . $time . '</td>
                        <td>' . $status . '</td>
                    </tr>';
                }
            } else {
                echo "<tr><td colspan='5'>No appointments found for $patient_name.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
