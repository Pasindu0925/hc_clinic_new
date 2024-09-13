<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
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
</head>
<body>

<div class="container">
    <div class="login-container">
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

        <?php
        // Include database connection
        include 'connect.php';

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
                    // Store user information in session
                    $_SESSION['user_id'] = $row['id']; // User ID
                    $_SESSION['username'] = $row['username']; // Username
                    $_SESSION['role'] = $row['role']; // User Role

                    // Check if the role is a doctor
                    if ($role == 3) {
                        $_SESSION['doctor_id'] = $row['id']; // Store doctor ID
                        $_SESSION['doctor_name'] = $row['username']; // Store doctor name (username here)
                    }

                    // Redirect based on role
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
                            echo "Invalid role selected.";
                            break;
                    }
                    exit();
                } else {
                    echo "<p style='color:red;'>Incorrect password. Please try again.</p>";
                }
            } else {
                echo "<p style='color:red;'>Invalid username or role. Please try again.</p>";
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
