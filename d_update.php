<?php
include 'connect.php';

// Initialize variables
$med_id = '';  // Medical Info ID
$p_id = '';    // Patient ID
$diagnosis = '';  // Diagnosis
$treatment = '';  // Treatment
$vitals = '';  // Vitals from patient_records
$notes = '';   // Notes from patient_records

if (isset($_GET['id'])) {
    $med_id = $_GET['id'];

    // Fetch record details from the database
    $sql = "SELECT mi.med_id, mi.p_id, mi.diagnosis, mi.treatment, pr.vitals, pr.notes 
            FROM medical_info mi 
            LEFT JOIN patient_records pr ON mi.p_id = pr.p_id 
            WHERE mi.med_id = '$med_id'";
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $record = mysqli_fetch_assoc($result);
        $p_id = $record['p_id'];
        $diagnosis = $record['diagnosis'];
        $treatment = $record['treatment'];
        
    }
}

// Update the record when the form is submitted
if (isset($_POST['submit'])) {
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    

    // Update medical_info table
    $sql_update_medical_info = "UPDATE medical_info SET diagnosis='$diagnosis', treatment='$treatment' WHERE med_id='$med_id'";
    $run_medical_info = mysqli_query($conn, $sql_update_medical_info);

    

    if ($run_medical_info ) {
        header("Location: medinfo.php");  // Redirect to the records page after successful update
    } else {
        echo "Please check your query.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Update Medical Information</title>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

<div class="container mt-5">
    <h2>Update Medical Information</h2>
    <form method="POST">
        <div class="form-group">
            <label for="diagnosis">Diagnosis</label>
            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required><?php echo $diagnosis; ?></textarea>
        </div>
        <div class="form-group">
            <label for="treatment">Treatment</label>
            <textarea class="form-control" id="treatment" name="treatment" rows="3" required><?php echo $treatment; ?></textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>