<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $patient_name = $_POST['patient_name'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];

    // Insert the new medical record into the database
    $sql = "INSERT INTO medical_info (patient_name, diagnosis, treatment) VALUES ('$patient_name', '$diagnosis', '$treatment')";
    $run = mysqli_query($conn, $sql);

    if ($run) {
        header("Location: medinfo.php"); // Redirect to records page after successful insertion
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medical Information</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

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

<div class="container">
    <div class="register-container">
        <h2><i class="fas fa-notes-medical"></i> Add Medical Information</h2>
        <form action="addmedical.php" method="POST">
            <div class="form-group">
                <label for="patient_name">Select Patient</label>
                <select class="form-control" id="patient_name" name="patient_name" required>
                    <?php
                    // Fetch patients from the patients table
                    $sql = "SELECT name FROM patients";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="diagnosis">Diagnosis</label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" placeholder="Enter diagnosis" required></textarea>
            </div>
            <div class="form-group">
                <label for="treatment">Treatment</label>
                <textarea class="form-control" id="treatment" name="treatment" rows="3" placeholder="Enter treatment plan" required></textarea>
            </div>
            <center><input type="submit" value="Add Medical Information" name="submit" class="btn btn-custom"></center>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
