<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HC_Clinic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1e90ff, #00c9ff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
            color: #ffffff;
            background-image: url('https://images.unsplash.com/photo-1517336714731-489689fd1ca8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwzNjUyOXwwfDF8c2VhcmNofDIwfHxoZWFsdGh8ZW58MHx8fHwxNjMyMDAxNjc2&ixlib=rb-1.2.1&q=80&w=1080');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        .login-container {
            max-width: 500px;
            padding: 50px;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .login-container:hover {
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 35px;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .form-group label {
            font-weight: 500;
            font-size: 16px;
            color: #ffffff;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 15px;
            color: #ffffff;
            border-radius: 30px;
            margin-bottom: 20px;
        }
        .form-control::placeholder {
            color: #ffffff;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            outline: none;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            font-size: 18px;
            padding: 15px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
            width: 100%;
        }
        .btn-custom:hover {
            background-color: #218838;
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.6);
        }
        .btn-custom:focus {
            outline: none;
        }
        .login-container i {
            margin-right: 10px;
        }
        .login-container p {
            font-size: 16px;
            color: #ffffff;
            margin-top: 20px;
        }
        .login-container a {
            color: #00c9ff;
            text-decoration: none;
        }
        .login-container a:hover {
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
            <button type="submit" class="btn btn-custom"><i class="fas fa-sign-in-alt"></i> Login</button>
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

        <div class="text-center mt-3">
            <p>Don't have an account? <a href="adminpage.php">Register here.</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
