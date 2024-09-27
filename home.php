<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HC_Clinic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }

        .header-section {
            background-image: url('https://images.unsplash.com/photo-1580281658627-5b9ac087614d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #ffffff;
        }

        .content h1 {
            font-size: 64px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .content p {
            font-size: 22px;
            margin-bottom: 40px;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-custom, .btn-secondary {
            font-size: 18px;
            padding: 15px 30px;
            border-radius: 30px;
            margin: 15px;
            transition: all 0.3s ease;
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

        /* About Section */
        .about-section {
            padding: 60px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .about-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #007bff;
        }

        .about-section p {
            font-size: 18px;
            color: #555555;
            max-width: 700px;
            margin: 0 auto 40px;
        }

        /* Services Section */
        .services-section {
            padding: 60px 0;
            background: #ffffff;
            text-align: center;
        }

        .services-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #28a745;
        }

        .service-card {
            background: #f8f9fa;
            border: none;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .service-card:hover {
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .service-card h5 {
            font-size: 24px;
            color: #007bff;
            margin-top: 20px;
        }

        .service-card p {
            color: #555555;
        }

        /* Footer */
        .footer {
            padding: 40px 0;
            background: #333333;
            color: #ffffff;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<section class="header-section">
    <div class="overlay"></div>
    <div class="content">
        <h1>Welcome to HC_Clinic</h1>
        <p>Your health and well-being are our top priority. Experience quality care and compassionate service.</p>
        <a href="login.php" class="btn btn-custom"><i class="fas fa-sign-in-alt"></i> Login</a>
        <a href="register.php" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Register</a>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <h2>About HC_Clinic</h2>
    <p>HC_Clinic is dedicated to providing comprehensive healthcare services with a personal touch. Our experienced team of doctors, nurses, and healthcare professionals work together to ensure your well-being at every stage of your health journey.</p>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <h2>Our Services</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="https://images.unsplash.com/photo-1580281658627-5b9ac087614d?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="General Checkups">
                    <div class="card-body">
                        <h5 class="card-title">General Checkups</h5>
                        <p class="card-text">Regular health checkups are key to maintaining a healthy lifestyle. Visit us for comprehensive health assessments.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="https://images.unsplash.com/photo-1580281658627-5b9ac087614d?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Specialized Consultations">
                    <div class="card-body">
                        <h5 class="card-title">Specialized Consultations</h5>
                        <p class="card-text">Our specialists are here to provide expert advice and treatment for a wide range of health concerns.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="https://images.unsplash.com/photo-1580281658627-5b9ac087614d?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="24/7 Emergency Care">
                    <div class="card-body">
                        <h5 class="card-title">24/7 Emergency Care</h5>
                        <p class="card-text">We are available around the clock to provide emergency services and urgent care for all your medical needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="footer">
    <p>&copy; 2024 HC_Clinic. All Rights Reserved.</p>
</footer>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
