<?php
include 'connect.php';
session_start();

// Initialize variables
$app_id = '';  // Appointment ID
$patient_name = '';  // Patient Name
$diagnosis = '';  // Diagnosis
$treatment = '';  // Treatment
$vitals = '';  // Vitals from patient_records
$notes = '';   // Notes from patient_records

if (isset($_GET['app_id'])) {
    $app_id = $_GET['app_id'];

    // Fetch record details from the database using app_id
    $sql = "SELECT a.patient_name, mi.diagnosis, mi.treatment, pr.vitals, pr.notes 
            FROM appointments a
            LEFT JOIN patient_records pr ON a.patient_name = pr.patient_name
            LEFT JOIN medical_info mi ON a.patient_name = mi.patient_name
            WHERE a.app_id = '$app_id'";
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $record = mysqli_fetch_assoc($result);
        $patient_name = $record['patient_name'];
        $diagnosis = isset($record['diagnosis']) ? $record['diagnosis'] : '';
        $treatment = isset($record['treatment']) ? $record['treatment'] : '';
        $vitals = isset($record['vitals']) ? $record['vitals'] : 'N/A';
        $notes = isset($record['notes']) ? $record['notes'] : 'N/A';
    }
}

// Update the record when the form is submitted
if (isset($_POST['submit'])) {
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];

    // Update medical_info table or insert new record if it doesn't exist
    $check_query = "SELECT * FROM medical_info WHERE patient_name='$patient_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $sql_update_medical_info = "UPDATE medical_info SET diagnosis='$diagnosis', treatment='$treatment' WHERE patient_name='$patient_name'";
    } else {
        $sql_update_medical_info = "INSERT INTO medical_info (patient_name, diagnosis, treatment) VALUES ('$patient_name', '$diagnosis', '$treatment')";
    }

    $run_medical_info = mysqli_query($conn, $sql_update_medical_info);

    if ($run_medical_info) {
        $_SESSION['message'] = "Updated medical information for patient: $patient_name (Appointment ID: $app_id)";
        header("Location: medical_records.php");  // Redirect to the records page after successful update
        exit();
    } else {
        echo "Please check your query.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Update Medical Information</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href="dochome.php">HC_Clinic</a>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="dochome.php">Home</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Update Medical Information</h2>
    <form method="POST">
        <div class="form-group">
            <label for="patient_name">Patient Name</label>
            <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?php echo $patient_name; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="diagnosis">Diagnosis</label>
            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required><?php echo $diagnosis; ?></textarea>
        </div>
        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea class="form-control" id="treatment" name="treatment" rows="3" required><?php echo $treatment; ?></textarea>
        </div>
        <div class="form-group">
            <label for="vitals">Vitals</label>
            <textarea class="form-control" id="vitals" name="vitals" rows="3" readonly><?php echo $vitals; ?></textarea>
        </div>
        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3" readonly><?php echo $notes; ?></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
