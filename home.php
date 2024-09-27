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
            background: linear-gradient(115deg, #1d1e22, #323a45);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .home-container {
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            transition: all 0.3s ease;
        }
        .home-container:hover {
            border: 2px solid rgba(255, 255, 255, 0.4);
        }
        h1 {
            font-size: 60px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 3px;
            text-transform: uppercase;
            text-shadow: 0 0 15px #fff, 0 0 20px #ff00ff, 0 0 30px #ff00ff;
            margin-bottom: 20px;
        }
        p {
            font-size: 20px;
            margin-bottom: 30px;
            color: #c7c7c7;
        }
        .btn-custom, .btn-secondary {
            font-size: 18px;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            margin: 15px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }
        .btn-custom {
            background: #28a745;
            color: white;
            box-shadow: 0 0 20px #28a745, 0 0 30px #28a745, 0 0 40px #28a745;
        }
        .btn-custom:hover {
            background: #218838;
            box-shadow: 0 0 30px #218838, 0 0 40px #218838, 0 0 50px #218838;
        }
        .btn-secondary {
            background: #007bff;
            color: white;
            box-shadow: 0 0 20px #007bff, 0 0 30px #007bff, 0 0 40px #007bff;
        }
        .btn-secondary:hover {
            background: #0056b3;
            box-shadow: 0 0 30px #0056b3, 0 0 40px #0056b3, 0 0 50px #0056b3;
        }
    </style>
</head>
<body>

<div class="home-container">
    <h1>Welcome to HC_Clinic</h1>
    <p>Your health and well-being are our top priority.</p>
    <a href="login.php" class="btn btn-custom"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="adminpage.php" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Register</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
