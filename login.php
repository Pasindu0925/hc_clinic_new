<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HC_Clinic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
        }
        .login-container {
            width: 400px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 15px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            padding: 40px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .login-container:hover {
            box-shadow: 0 12px 45px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.4);
        }
        .login-container h2 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #ffffff;
        }
        .form-group label {
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 10px;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 15px;
            color: #ffffff;
            margin-bottom: 20px;
            border-radius: 30px;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.4);
            outline: none;
            box-shadow: none;
        }
        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
            font-weight: 500;
            padding: 15px;
            width: 100%;
            border: none;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.4);
            text-transform: uppercase;
        }
        .btn-custom:hover {
            background-color: #218838;
            box-shadow: 0 12px 20px rgba(40, 167, 69, 0.6);
        }
        .login-container i {
            margin-right: 10px;
            color: #ffffff;
        }
        .text-center p {
            color: #ffffff;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2 class="text-center"><i class="fas fa-sign-in-alt"></i> Login</h2>
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
            <p><a href="adminpage.php" style="color: #ffffff;">Don't have an account? Register here.</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
