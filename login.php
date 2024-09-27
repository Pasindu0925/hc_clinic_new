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
            background-image: url('https://images.unsplash.com/photo-1581092795360-206bd9dfb179?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDJ8fGhlYWx0aHxlbnwwfHx8fDE2MjcyNjc5NzI&ixlib=rb-1.2.1&q=80&w=1080');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            width: 400px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .login-container h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #007bff;
        }
        .form-control {
            border: none;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
            border: 1px solid #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            cursor: pointer;
            box-shadow: 0 8px 16px rgba(0, 123, 255, 0.3);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            box-shadow: 0 12px 20px rgba(0, 123, 255, 0.5);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 500;
            color: #333;
        }
        .login-container i {
            color: #007bff;
            font-size: 22px;
            margin-bottom: 10px;
        }
        .login-container p {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .login-container p a {
            color: #007bff;
            text-decoration: none;
        }
        .login-container p a:hover {
            text-decoration: underline;
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
                    } elseif ($role == 4) { // If the role is a patient
                        $_SESSION['patient_username'] = $row['username']; // Store patient username for session
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
