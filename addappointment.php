<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
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
        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href="receptionisthome.php">HC_Clinic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="receptionisthome.php">Home</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <center>
        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'connect.php';

            // Correct SQL to use patient_name
            $sql = "SELECT a.app_id, a.patient_name, a.doc_name, a.date, a.time, a.status 
                    FROM appointments a";  // Removed any erroneous join conditions
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $app_id = $row['app_id'];
                    $patient_name = $row['patient_name'];
                    $doc_name = $row['doc_name'];
                    $date = $row['date'];
                    $time = $row['time'];
                    $status = $row['status'];

                    echo '
                    <tr>
                        <td>' . $app_id . '</td>
                        <td>' . $patient_name . '</td>
                        <td>' . $doc_name . '</td>
                        <td>' . $date . '</td>
                        <td>' . $time . '</td>
                        <td>' . $status . '</td>
                        <td>
                            <a href="r_update.php?app_id=' . $app_id . '">Update</a>
                        </td>
                    </tr>';
                }
            } else {
                echo "<tr><td colspan='7'>No appointments found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </center>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
