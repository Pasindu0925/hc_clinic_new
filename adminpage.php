<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                <a class="nav-link" href="adminhome.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="viewstaff.php">View Staff</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="register-container">
        <h2><i class="fas fa-user-plus"></i> Register Staff </h2>
        <form action="adminpage.php" method="POST">
            <div class="form-group">
                <label for="username"><i class="fas fa-envelope"></i> Email (Username)</label>
                <input type="email" class="form-control" id="username" name="username" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="role"><i class="fas fa-user-tag"></i> Role</label>
                <select class="form-control" id="role" name="role_id" required>
                    <option value="1">Receptionist</option>
                    <option value="2">Nurse</option>
                    <option value="3">Doctor</option>
                </select>
            </div>
            <center> <input type="submit" value="Register"></center>
        </form>

        <?php
        include 'connect.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role_id'];

            $sql = "INSERT INTO user(username, password, role) VALUES ('$username', '$password', '$role')";

            $run = mysqli_query($conn, $sql);

            if ($run) {
                header("location:adminpage.php");
            } else {
                echo "Please check your queries";
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
