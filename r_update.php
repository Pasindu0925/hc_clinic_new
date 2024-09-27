<!doctype html>
<html lang="en">
  <head>
    <title>Appointments Update</title>
    <!-- Required meta tags -->
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
  
<?php
    include 'connect.php';

    $app_id = '';
    $patient_name = '';
    $doc_name = '';
    $date = '';
    $time = '';

    if (isset($_GET['app_id'])) {
        $app_id = $_GET['app_id'];

        // Fetch appointment details from the database using app_id
        $sql = "SELECT * FROM appointments WHERE app_id='$app_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $appointments = mysqli_fetch_assoc($result);
            $patient_name = $appointments['patient_name'];
            $doc_name = $appointments['doc_name'];
            $date = $appointments['date'];
            $time = $appointments['time'];
        }
    }

    // Update the appointment when form is submitted
    if (isset($_POST['submit'])) {
        $doc_name = $_POST['doc_name'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $sql = "UPDATE appointments SET doc_name='$doc_name', date='$date', time='$time' WHERE app_id='$app_id'";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            header("Location: appointment.php");
        } else {
            echo "Please check your query.";
        }
    }
?>

    <div class="container mt-5">
        <h2>Update Appointment</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?php echo $patient_name; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="doc_name">Doctor Name</label>
                <select name="doc_name" class="form-control">
                    <option value="Dr.Chandana Nawaratne" <?php if ($doc_name == 'Dr.Chandana Nawaratne') echo 'selected'; ?>>Dr.Chandana Nawaratne</option>
                    <option value="Dr.Ranil Wickramasinghe" <?php if ($doc_name == 'Dr.Ranil Wickramasinghe') echo 'selected'; ?>>Dr.Ranil Wickramasinghe</option>
                    <option value="Dr.Namal Rajapaksha" <?php if ($doc_name == 'Dr.Namal Rajapaksha') echo 'selected'; ?>>Dr.Namal Rajapaksha</option>
                    <option value="Dr.Anura Kumara Dissanayake" <?php if ($doc_name == 'Dr.Anura Kumara Dissanayake') echo 'selected'; ?>>Dr.Anura Kumara Dissanayake</option>
                    <option value="Dr.Sajith Premadasa" <?php if ($doc_name == 'Dr.Sajith Premadasa') echo 'selected'; ?>>Dr.Sajith Premadasa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>" required>
            </div>
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" class="form-control" id="time" name="time" value="<?php echo $time; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
  
</body>
</html>
