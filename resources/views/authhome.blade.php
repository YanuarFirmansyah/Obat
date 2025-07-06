<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik Sehat Sejahtera - Selamat Datang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .hero-section {
            background: linear-gradient(rgba(4, 120, 188, 0.7), rgba(0, 75, 128, 0.8)), url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=2070&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero-section h1 {
            font-weight: 700;
            font-size: 3.5rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
        }

        .hero-section p {
            font-weight: 300;
            font-size: 1.25rem;
            max-width: 600px;
            margin: 20px auto 40px auto;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
        }

        .btn-custom {
            padding: 12px 25px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-custom.btn-primary {
            background-color: #ffffff;
            color: #0478BC;
            border: 2px solid #ffffff;
        }

        .btn-custom.btn-primary:hover {
            background-color: transparent;
            color: #ffffff;
        }

        .btn-custom.btn-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-custom.btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .service-section {
            padding: 80px 0;
        }
        
        .service-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .service-card .card-body {
            padding: 40px;
        }

        .service-icon {
            font-size: 3rem;
            color: #0478BC;
        }

        .footer {
            background-color: #343a40;
            color: #f8f9fa;
            padding: 20px 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-clinic-medical"></i>
                Poliklinik Sehat Sejahtera
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <h1 class="mb-4">Layanan Kesehatan Profesional dan Terpercaya</h1>
            <p class="lead mb-5">Kesehatan Anda adalah prioritas utama kami. Akses layanan kami dengan mudah melalui platform digital ini.</p>
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg mr-3 btn-custom">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
                <a href="{{ route('registerForm') }}" class="btn btn-success btn-lg btn-custom">
                    <i class="fas fa-user-plus mr-2"></i>Register
                </a>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section class="service-section">
        <div class="container">
            <h2 class="text-center mb-5 font-weight-bold">Layanan Unggulan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center">
                        <div class="card-body">
                            <i class="fas fa-user-md service-icon mb-3"></i>
                            <h5 class="card-title font-weight-bold">Dokter Profesional</h5>
                            <p class="card-text">Tim dokter kami terdiri dari para ahli yang berpengalaman dan siap melayani Anda dengan sepenuh hati.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center">
                        <div class="card-body">
                            <i class="fas fa-calendar-check service-icon mb-3"></i>
                            <h5 class="card-title font-weight-bold">Jadwal Fleksibel</h5>
                            <p class="card-text">Atur jadwal konsultasi Anda dengan mudah dan fleksibel melalui sistem pendaftaran online kami.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card service-card text-center">
                        <div class="card-body">
                            <i class="fas fa-pills service-icon mb-3"></i>
                            <h5 class="card-title font-weight-bold">Resep Digital</h5>
                            <p class="card-text">Dapatkan resep obat secara digital setelah konsultasi, yang dapat langsung ditebus di apotek rekanan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>© 2024 Poliklinik Sehat Sejahtera. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>