<!doctype html>
<html lang="en">
  <head>
    <title>Patients Records Update</title>
    <!--  meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
        <a class="navbar-brand" href="nursehome.php">HC_Clinic</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavp_id" aria-controls="collapsibleNavp_id"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="nursehome.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>
  
    <?php
include 'connect.php';

$rec_id = '';  // Record ID
$p_id = '';    // Patient ID
$vitals = '';  // Patient Vitals
$notes = '';   // Notes

if (isset($_GET['rec_id'])) {
    $rec_id = $_GET['rec_id'];

    // Fetch record details from the database
    $sql = "SELECT * FROM patient_records WHERE rec_id='$rec_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $record = mysqli_fetch_assoc($result);
        $p_id = $record['p_id'];
        $vitals = $record['vitals'];
        $notes = $record['notes'];
    }
}

// Update the record when the form is submitted
if (isset($_POST['submit'])) {
    $p_id = $_POST['p_id'];
    $vitals = $_POST['vitals'];
    $notes = $_POST['notes'];

    $sql = "UPDATE patient_records SET p_id='$p_id', vitals='$vitals', notes='$notes' WHERE rec_id='$rec_id'";
    $run = mysqli_query($conn, $sql);
    if ($run) {
        header("Location: patientsrecords.php");  // Redirect to the records page after successful update
    } else {
        echo "Please check your query.";
    }
}
?>

<div class="container mt-5">
        <h2>Update Record</h2>
        <form method="POST">
            <div class="form-group">
                <label for="p_id">Patient ID</label>
                <input type="text" class="form-control" id="p_id" name="p_id" value="<?php echo $p_id; ?>" >
            </div>
            <div class="form-group">
                <label for="vitals">Vitals</label>
                <input type="text" class="form-control" id="vitals" name="vitals" value="<?php echo $vitals; ?>" >
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3" ><?php echo $notes; ?></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  
</body>
</html>
