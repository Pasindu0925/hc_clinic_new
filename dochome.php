<?php
session_start(); // Start the session
include 'connect.php'; // Include your database connection

// Ensure the user is logged in and is a doctor
if (!isset($_SESSION['doctor_id']) || $_SESSION['role'] != 3) {
    header("Location: login.php");
    exit();
}

// Get the doctor's ID and name from the session
$doctor_id = $_SESSION['doctor_id'];
$doctor_name = $_SESSION['username'];  // Assuming 'username' is the doctor's name
?>

<!doctype html>
<html lang="en">
<head>
    <title>Doctor's Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="home1.css">
    <link rel="stylesheet" href="home2.css">
    <style>
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

<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
    <a class="navbar-brand" href="dochome.php">HC_Clinic</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="dochome.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="addmedical.php">Add Medical Information</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="medinfo.php">View and Edit Medical Information</a>
            </li>
            <!-- Button to View Upcoming Appointments -->
            <li class="nav-item active">
                <form action="view_appointments.php" method="POST" class="form-inline">
                    <!-- Pass the doctor's ID securely through a hidden input -->
                    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">
                    <button type="submit" class="btn btn-link nav-link">View Upcoming Appointments</button>
                </form>
            </li>
            <li class="logout">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<section id="steps-1893">
    <div class="cs-container">
        <div class="cs-image-group">
            <picture class="cs-picture">
                <!--Mobile Image-->
                <source media="(max-width: 600px)" srcset="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/People/dermatologist1.jpeg">
                <!--Tablet and above Image-->
                <source media="(min-width: 601px)" srcset="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/People/dermatologist1.jpeg">
                <img loading="lazy" decoding="async" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/People/dermatologist1.jpeg" alt="dermatologist" width="324" height="467">
            </picture>
            <img class="cs-graphic cs-brown" loading="lazy" decoding="async" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Graphics/brown-lines2.svg" alt="graphic" width="100" height="98" aria-hidden="true">
            <img class="cs-graphic cs-peach" loading="lazy" decoding="async" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/peach-blob.svg" alt="graphic" width="42" height="31" aria-hidden="true">
            <img class="cs-graphic cs-leaf" loading="lazy" decoding="async" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Graphics/leaf-reverse.svg" alt="graphic" width="136" height="171" aria-hidden="true">
            <img class="cs-graphic cs-dots" loading="lazy" decoding="async" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/beige-dots.svg" alt="graphic" width="159" height="88" aria-hidden="true">
            <img class="cs-graphic cs-lines" loading="lazy" decoding="async" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Graphics/mesh-reverse.svg" alt="graphic" width="150" height="165" aria-hidden="true">
        </div>
        <div class="cs-wrapper">
            <div class="cs-content">
                <span class="cs-topper">How to get started</span>
                <h2 class="cs-title">Simple Steps to Get Our Services</h2>
            </div>
            <ul class="cs-card-group">
                <li class="cs-item">
                    <span class="cs-number">01</span>
                    <div class="cs-flex">
                        <h3 class="cs-h3">Book an Appointment</h3>
                        <p class="cs-item-text">
                            Aside from seeing patients, Dr. Paul is dedicated to patient advocacy and education on evidence-based medicine in dermatology, especially for skin of color. 
                        </p>
                    </div>
                </li>
                <li class="cs-item">
                    <span class="cs-number">02</span>
                    <div class="cs-flex">
                        <h3 class="cs-h3">Attend your appointment</h3>
                        <p class="cs-item-text">
                            Aside from seeing patients, Dr. Paul is dedicated to patient advocacy and education on evidence-based medicine in dermatology, especially for skin of color. 
                        </p>
                    </div>
                </li>
                <li class="cs-item">
                    <span class="cs-number">03</span>
                    <div class="cs-flex">
                        <h3 class="cs-h3">Follow your treatment plan</h3>
                        <p class="cs-item-text">
                            Aside from seeing patients, Dr. Paul is dedicated to patient advocacy and education on evidence-based medicine in dermatology, especially for skin of color. 
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
