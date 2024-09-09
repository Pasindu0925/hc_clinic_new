<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
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
    <div class="register-container">
        <h2><i class="fas fa-user-plus"></i> Add an appointment </h2>
        <form action="addappointment.php" method="POST">
            <div class="form-group">
                <label for="p_id"> Patient ID</label>
                <input type="number" class="form-control" id="app_id" name="p_id" placeholder="Enter the Patient ID" required>
            </div>
            <div class="form-group">
                <label for="doc_name"> Select Your Doctor</label>
                <select class="form-control" id="doc_name" name="doc_name" required>
                    <option value="Dr.Chandana Nawaratne">Dr.Chandana Nawaratne</option>
                    <option value="Dr.Ranil Wickramasinghe">Dr.Ranil Wickramasinghe</option>
                    <option value="Dr.Namal Rajapaksha">Dr.Namal Rajapaksha</option>
                    <option value="Dr.Anura Kumara Dissanayake">Dr.Anura Kumara Dissanayake</option>
                    <option value="Dr.Sajith Premadasa">Dr.Sajith Premadasa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date"> Date</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
            </div>
            <div class="form-group">
                <label for="time"> Time</label>
                <input type="time" class="form-control" id="time" name="time" placeholder="Time" required>
            </div>
            
            <center> <input type="submit" value="Add Appointments"></center>
        </form>

        <?php
        include 'connect.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $p_id = $_POST['p_id'];
            $doc_name = $_POST['doc_name'];
            $date = $_POST['date'];
            $time = $_POST['time'];

            $sql = "INSERT INTO appointments(p_id, doc_name, date, time) VALUES ('$p_id', '$doc_name', '$date', '$time')";

            $run = mysqli_query($conn, $sql);

            if ($run) {
                header("location:appointment.php");
            } else {
                echo "Please check your insert details";
            }
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
