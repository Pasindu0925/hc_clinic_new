<?php
include 'connect.php';
session_start();

// Assuming the logged-in patient's username is stored in the session
$user_id = $_SESSION['user_id'];

// Fetch the user's details from the database
$sql = "SELECT * FROM user WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $username = $user['username'];
    $password = $user['password'];
    $role = $user['role'];
} else {
    echo "User not found.";
    exit();
}

// Fetch additional patient details if the role is 'Patient'
if ($role == '4') {
    $patient_query = "SELECT * FROM patients WHERE username = '$username'";
    $patient_result = mysqli_query($conn, $patient_query);
    if ($patient_result && mysqli_num_rows($patient_result) == 1) {
        $patient = mysqli_fetch_assoc($patient_result);
        $name = $patient['name'];
        $dob = $patient['dob'];
        $address = $patient['address'];
        $phone_number = $patient['phone_number'];
        $med_history = $patient['med_history'];
        $insurance_details = $patient['insurance_details'];
    }
}

// Update the user's details when the form is submitted
if (isset($_POST['submit'])) {
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    // Update the user table
    $update_user_query = "UPDATE user SET username='$new_username', password='$new_password' WHERE id='$user_id'";
    $update_user_result = mysqli_query($conn, $update_user_query);

    // Update the patients table if the role is 'Patient'
    if ($role == '4') {
        $new_name = $_POST['name'];
        $new_dob = $_POST['dob'];
        $new_address = $_POST['address'];
        $new_phone_number = $_POST['phone_number'];
        $new_med_history = $_POST['med_history'];
        $new_insurance_details = $_POST['insurance_details'];

        $update_patient_query = "UPDATE patients SET name='$new_name', dob='$new_dob', address='$new_address', phone_number='$new_phone_number', med_history='$new_med_history', insurance_details='$new_insurance_details' WHERE username='$username'";
        $update_patient_result = mysqli_query($conn, $update_patient_query);
    }

    // Redirect after updating
    if ($update_user_result) {
        header("Location: patienthome.php"); // Redirect to home after successful update
        exit();
    } else {
        echo "Error updating profile.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Edit My Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href="patienthome.php">HC_Clinic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="patienthome.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="myrecords.php">My Records</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="myappointments.php">My Appointments</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="editprofile.php">Edit My Profile</a>
            </li>
            <li class="logout">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container form-container">
    <h2>Edit My Profile</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="user_id">User ID (Cannot be edited)</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
        </div>

        <!-- Additional fields for patients -->
        <?php if ($role == '4') { ?>
            <h3>Patient Details</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>" required>
            </div>
            <div class="form-group">
                <label for="med_history">Medical History</label>
                <textarea class="form-control" id="med_history" name="med_history" rows="3" required><?php echo $med_history; ?></textarea>
            </div>
            <div class="form-group">
                <label for="insurance_details">Insurance Details</label>
                <textarea class="form-control" id="insurance_details" name="insurance_details" rows="3" required><?php echo $insurance_details; ?></textarea>
            </div>
        <?php } ?>

        <button type="submit" name="submit" class="btn btn-primary btn-block">Update Profile</button>
    </form>
</div>

</body>
</html>
