<?php
include 'connect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <title>Medical Info and Patient Records</title>
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
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Medical Info ID</th>
                    <th>Patient Name</th>
                    <th>Vitals</th>
                    <th>Notes</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
            <?php
            // SQL query to join medical_info and patient_records tables using patient_name
            $sql = "SELECT mi.med_id, mi.patient_name, mi.diagnosis, mi.treatment, pr.vitals, pr.notes 
                    FROM medical_info mi
                    LEFT JOIN patient_records pr ON mi.patient_name = pr.patient_name";  // Using patient_name as the foreign key

            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $med_id = $row['med_id'];
                    $patient_name = $row['patient_name'];
                    $vitals = $row['vitals'];
                    $notes = $row['notes'];
                    $diagnosis = $row['diagnosis'];
                    $treatment = $row['treatment'];

                    echo '
                    <tr>
                        <td>' . $med_id . '</td>
                        <td>' . $patient_name . '</td>
                        <td>' . $vitals . '</td>
                        <td>' . $notes . '</td>
                        <td>' . $diagnosis . '</td>
                        <td>' . $treatment . '</td>
                        <td>
                            <a href="d_update.php?id=' . $med_id . '" class="btn btn-warning btn-sm">Update</a> 
                            <a href="d_delete.php?id=' . $med_id . '" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>';
                }
            } else {
                echo "<tr><td colspan='7'>No records found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </center>

</body>
</html>
