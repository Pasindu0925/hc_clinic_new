<?php
include 'connect.php';
session_start(); // Start the session

// Ensure the doctor is logged in and retrieve their ID
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$doctor_id = $_SESSION['doctor_id']; // Get doctor ID from session

// Fetch doctor's name based on their ID to use in the query
$doctor_name_query = "SELECT name FROM doctors WHERE doc_id = '$doctor_id'";
$doctor_name_result = mysqli_query($conn, $doctor_name_query);
$doctor_name_row = mysqli_fetch_assoc($doctor_name_result);
$doctor_name = $doctor_name_row['name']; // Fetch the doctor's name
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-zMpOr0vL9TzNu1jzG+p4AqkBdhavRrWIe0iDlEu5KQ/xNUolGpP0xKqRk9b1nx+3" crossorigin="anonymous"></script>
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
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to get appointments for the logged-in doctor
            $sql = "SELECT a.app_id, a.p_id, d.name as doctor_name, a.date, a.time, a.status
                    FROM appointments a
                    JOIN doctors d ON a.doc_name = d.name
                    WHERE a.doc_name = '$doctor_name'"; // Match by doctor's name

            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $app_id = $row['app_id'];
                    $p_id = $row['p_id'];
                    $doctor_name = $row['doctor_name'];
                    $date = $row['date'];
                    $time = $row['time'];
                    $status = $row['status'];

                    echo '
                    <tr>
                        <td>' . $app_id . '</td>
                        <td>' . $p_id . '</td>
                        <td>' . $doctor_name . '</td>
                        <td>' . $date . '</td>
                        <td>' . $time . '</td>
                        <td>' . $status . '</td>
                        <td>
                            <a href="update_appointment.php?id=' . $app_id . '&status=Complete">Complete</a> 
                            <a href="update_appointment.php?id=' . $app_id . '&status=Ongoing">Ongoing</a>
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

</body>
</html>
