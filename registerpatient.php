<?php
// Ensure no whitespace or newline before the opening PHP tag

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $med_history = $_POST['med_history'];
    $insurance_details = $_POST['insurance_details'];
    $role = $_POST['role'];

    // Insert into user table
    $sql_user = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    $run_user = mysqli_query($conn, $sql_user);

    if ($run_user) {
        // Insert into patients table
        $sql_patient = "INSERT INTO patients (username, name, dob, address, phone_number, med_history, insurance_details) VALUES ('$username', '$name', '$dob', '$address', '$phone_number', '$med_history', '$insurance_details')";
        $run_patient = mysqli_query($conn, $sql_patient);

        if ($run_patient) {
            // Redirect to viewpatients.php before any HTML is sent
            header("Location: viewpatients.php");
            exit(); // Exit after header redirection
        } else {
            echo "Error: Could not insert into patients table. " . mysqli_error($conn);
        }
    } else {
        echo "Error: Could not insert into users table. " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P_Register</title>
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
    <a class="navbar-brand" href="adminpage.php">HC_Clinic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="receptionisthome.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="viewpatients.php">View Patients</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="register-container">
        <h2><i class="fas fa-user-plus"></i> Register Patient </h2>
        <form action="registerpatient.php" method="POST">
            
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter patient's name" required>
            </div>
            
            <div class="form-group">
                <label for="username"><i class="fas fa-envelope"></i> Email (Username)</label>
                <input type="email" class="form-control" id="username" name="username" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            
            <div class="form-group">
                <label for="dob"> Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter your DOB" required>
            </div>

            <div class="form-group">
                <label for="address"> Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your Address" required>
            </div>

            <div class="form-group">
                <label for="phone_number"> Phone Number</label>
                <input type="text" class="form-control" id="p_no" name="phone_number" placeholder="Enter your Phone Number" required>
            </div>

            <div class="form-group">
                <label for="med_history"> Medical History</label>
                <input type="text" class="form-control" id="med_history" name="med_history" placeholder="Medical History" required>
            </div>

            <div class="form-group">
                <label for="insurance"> Insurance Details</label>
                <input type="text" class="form-control" id="insurance" name="insurance_details" placeholder="Insurance Details" required>
            </div>

            <div class="form-group" style="display: none;">
                <label for="role"><i class="fas fa-user-tag"></i> Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="4">Patient</option>
                </select>
            </div>
            <center><input type="submit" value="Register"></center>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
