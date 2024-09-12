<!doctype html>
<html lang="en">
<head>
    <title>Add Patient Record</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            margin: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-title {
            margin-bottom: 20px;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href="nursehome.php">HC_Clinic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
                <a class="nav-link" href="nursehome.php">Home</a>
            </li>
        </ul>
    </div>
</nav>
    <div class="form-container">
        <h2 class="form-title text-center">Add Patient Record</h2>

        <!-- Patient Record Form -->
        <form action="addpatientrecord.php" method="POST">
            <div class="form-group">
                <label for="patient_name">Select Patient</label>
                <select class="form-control" id="patient_name" name="patient_name" required>
                    <?php
                    include 'connect.php';
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
                <label for="vitals">Vitals</label>
                <textarea class="form-control" id="vitals" name="vitals" rows="3" placeholder="Enter vitals" required></textarea>
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter notes" required></textarea>
            </div>
            <button type="submit" name="submit" class="submit-btn">Add Record</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $patient_name = $_POST['patient_name'];
    $vitals = $_POST['vitals'];
    $notes = $_POST['notes'];

    // Insert the new patient record into the database
    $sql = "INSERT INTO patient_records (patient_name, vitals, notes) VALUES ('$patient_name', '$vitals', '$notes')";
    $run = mysqli_query($conn, $sql);

    if ($run) {
        header("Location: patientsrecords.php"); // Redirect to records page after successful insertion
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
