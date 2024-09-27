<?php
include 'connect.php';
session_start();

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
    <title>My Medical Records</title>
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
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="text-center">Medical Records for <?php echo $patient_name; ?></h3>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Medical History</th>
                    <th>Insurance Details</th>
                    <th>Vitals</th>
                    <th>Notes</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to join patients, patient_records, and medical_info tables using patient_name and filter by logged-in patient name
            $sql = "SELECT p.p_id, p.name AS patient_name, p.dob, p.address, p.phone_number, p.med_history, p.insurance_details, 
                           pr.vitals, pr.notes, mi.diagnosis, mi.treatment 
                    FROM patients p
                    LEFT JOIN patient_records pr ON p.name = pr.patient_name
                    LEFT JOIN medical_info mi ON p.name = mi.patient_name
                    WHERE p.username = '$patient_username'";  // Filter by the logged-in patient

            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $p_id = $row['p_id'];
                    $patient_name = $row['patient_name'];
                    $dob = $row['dob'];
                    $address = $row['address'];
                    $phone_number = $row['phone_number'];
                    $med_history = $row['med_history'];
                    $insurance_details = $row['insurance_details'];
                    $vitals = isset($row['vitals']) ? $row['vitals'] : 'N/A';
                    $notes = isset($row['notes']) ? $row['notes'] : 'N/A';
                    $diagnosis = !empty($row['diagnosis']) ? $row['diagnosis'] : '';  // Leave empty for missing diagnosis
                    $treatment = !empty($row['treatment']) ? $row['treatment'] : '';  // Leave empty for missing treatment

                    echo '
                    <tr>
                        <td>' . $p_id . '</td>
                        <td>' . $patient_name . '</td>
                        <td>' . $dob . '</td>
                        <td>' . $address . '</td>
                        <td>' . $phone_number . '</td>
                        <td>' . $med_history . '</td>
                        <td>' . $insurance_details . '</td>
                        <td>' . $vitals . '</td>
                        <td>' . $notes . '</td>
                        <td>' . $diagnosis . '</td>
                        <td>' . $treatment . '</td>
                    </tr>';
                }
            } else {
                echo "<tr><td colspan='11'>No records found for $patient_name.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
