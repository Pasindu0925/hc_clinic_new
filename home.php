<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HC_Clinic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1579154202453-eefe7b3ddedc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            color: white;
        }
        .home-container {
            text-align: center;
            margin-top: 180px;
            background: rgba(0, 0, 0, 0.6);
            padding: 50px;
            border-radius: 10px;
        }
        h1 {
            font-size: 50px;
            font-weight: bold;
            color: #ffffff;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #ffffff;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            font-size: 18px;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 10px;
            text-decoration: none;
        }
        .btn-custom:hover {
            background-color: #218838;
            text-decoration: none;
        }
        .btn-secondary {
            background-color: #007bff;
        }
        .btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="home-container">
        <h1>Welcome to HC_Clinic</h1>
        <p>Your health and well-being are our top priority.</p>
        <a href="login.php" class="btn btn-custom"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="adminpage.php" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Register</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
