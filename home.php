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
            background-image: url('https://images.unsplash.com/photo-1580281658627-5b9ac087614d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .home-container {
            text-align: center;
            padding: 60px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .home-container:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 48px;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #333333;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .btn-custom, .btn-secondary {
            font-size: 18px;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 15px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            width: 200px;
        }

        .btn-custom {
            background: #28a745;
            color: white;
            box-shadow: 0 8px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-custom:hover {
            background: #218838;
            box-shadow: 0 12px 25px rgba(40, 167, 69, 0.6);
        }

        .btn-secondary {
            background: #007bff;
            color: white;
            box-shadow: 0 8px 15px rgba(0, 123, 255, 0.4);
        }

        .btn-secondary:hover {
            background: #0056b3;
            box-shadow: 0 12px 25px rgba(0, 123, 255, 0.6);
        }
    </style>
</head>
<body>

<div class="home-container">
    <h1>Welcome to HC_Clinic</h1>
    <p>At HC_Clinic, we provide comprehensive healthcare services with a personal touch. Your health and well-being are our top priority. Experience quality medical care, advanced facilities, and a patient-friendly environment.</p>
    <a href="login.php" class="btn btn-custom"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="register.php" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Register</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
