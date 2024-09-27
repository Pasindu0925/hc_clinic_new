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
        /* Background Image */
        body {
            background-image: url('https://images.unsplash.com/photo-1585436432032-3e6a42f0e3d8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTI3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&w=1080');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Overlay Effect */
        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .login-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .login-header img {
            width: 100px;
            border-radius: 50%;
        }

        .login-header h2 {
            margin-top: 15px;
            font-weight: 700;
        }

        .form-group label {
            color: #495057;
            font-weight: 600;
        }

        .form-control {
            border-radius: 20px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
            border-radius: 25px;
            font-weight: 600;
            padding: 10px 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-custom:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-custom:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(72, 180, 97, 0.25);
        }

        .alert {
            margin-top: 20px;
            border-radius: 20px;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-footer a {
            color: #007bff;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .health-image {
            width: 100%;
            margin-bottom: 20px;
            border-radius: 10px;
        }

    </style>
</head>
<body>
    <div class="container overlay">
        <div class="login-container">
            <div class="login-header">
                <img src="https://images.unsplash.com/photo-1579154204601-0278d4d6e03c?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80" alt="Health Clinic Logo">
                <h2><i class="fas fa-user-md"></i> Healthcare Login</h2>
            </div>
            <img class="health-image" src="https://images.unsplash.com/photo-1581070398553-40aa78bc063e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyMTI3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&q=80&w=1080" alt="Healthcare Image">
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
            include 'connect.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $role = mysqli_real_escape_string($conn, $_POST['role']);

                $sql = "SELECT * FROM user WHERE username='$username' AND role='$role'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);

                    if ($password === $row['password']) {
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['role'] = $row['role'];

                        if ($role == 3) {
                            $_SESSION['doctor_id'] = $row['id'];
                            $_SESSION['doctor_name'] = $row['username'];
                        } elseif ($role == 4) {
                            $_SESSION['patient_username'] = $row['username'];
                        }

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
                                echo "<div class='alert alert-danger'>Invalid role selected.</div>";
                                break;
                        }
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Incorrect password. Please try again.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Invalid username or role. Please try again.</div>";
                }
            }
            ?>
            <div class="login-footer">
                <p>Need an account? <a href="register.php">Sign up</a></p>
                <p><a href="forgot_password.php">Forgot Password?</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
