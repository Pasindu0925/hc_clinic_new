<?php
// Include database connection
include 'connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Query the users table for the provided username and role
    $sql = "SELECT * FROM user WHERE username='$username' AND role='$role'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password (without hashing)
        if ($password === $row['password']) {
            // Based on role, redirect to different pages
            switch ($role) {
                case 1:
                    header("Location: receptionisthome.php");
                    break;
                case 2:
                    header("Location: nursehome.php");
                    break;
                case 3:
                    header("Location: dochome.php");
                    break;
                case 4:
                    header("Location: patienthome.php");
                    break;
                case 5:
                    header("Location: adminhome.php");
                    break;
                default:
                    echo "<p style='color:red;'>Invalid role selected.</p>";
                    break;
            }
            exit();
        } else {
            $login_error = "Incorrect password. Please try again.";
        }
    } else {
        $login_error = "Invalid username or role. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to HC Clinic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #74ebd5, #acb6e5);
            font-family: 'Arial', sans-serif;
        }
        .home-container {
            text-align: center;
            color: #fff;
            background: rgba(0, 0, 0, 0.6);
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .home-container h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .home-container p {
            font-size: 20px;
            margin-bottom: 40px;
        }
        .btn-login {
            background-color: #007bff;
            color: white;
            font-size: 24px;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-login:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
        .login-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        // Function to show the login form
        function showLoginForm() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('welcome-message').style.display = 'none';
        }
    </script>
</head>
<body>

<div class="container">
    <!-- Home Screen Section -->
    <div id="welcome-message" class="home-container">
        <h1>Welcome to HC Clinic</h1>
        <p>Your trusted healthcare management system</p>
        <button class="btn-login" onclick="showLoginForm()">Login</button>
    </div>

    <!-- Login Form Section -->
    <div id="login-form" class="login-container" style="display: none;">
        <h2><i class="fas fa-sign-in-alt"></i> Login </h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="role"><i class="fas fa-user-tag"></i> Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="1">Receptionist</option>
                    <option value="2">Nurse</option>
                    <option value="3">Doctor</option>
                    <option value="4">Patient</option>
                    <option value="5">Admin</option>
                </select>
            </div>
            <center><input type="submit" value="Login" class="btn btn-custom"></center>
        </form>

        <!-- Display login error message if any -->
        <?php if (isset($login_error)): ?>
            <div class="alert alert-danger mt-4 text-center"><?php echo $login_error; ?></div>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
