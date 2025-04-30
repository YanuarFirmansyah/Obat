<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Aplikasi</title>

  <!-- Google Font: Source Sans Pro -->
  @include('layouts.lib.ext-css')
  <style>
    :root {
        --primary-color: #0d6efd;
        --primary-dark: #0a58ca;
        --secondary-color: #6c757d;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --card-border-radius: 0.75rem;
        --transition: all 0.3s ease;
    }
    body {
        font-family: 'Poppins', sans-serif;
        color: var(--dark-color);
        line-height: 1.6;
        background-color: #f5f8fe;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .register-container {
        max-width: 550px;
        width: 100%;
        padding: 0 15px;
    }
    .card {
        border: none;
        border-radius: var(--card-border-radius);
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
    .card-body {
        padding: 2rem;
    }
    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid #e2e8f0;
        font-size: 0.95rem;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: var(--transition);
    }
    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .logo i {
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }
    .logo-text {
        font-size: 1.5rem;
        font-weight: 700;
    }
    .back-to-home {
        display: block;
        text-align: center;
        margin-top: 2rem;
        color: var(--secondary-color);
        text-decoration: none;
        transition: var(--transition);
    }
    .back-to-home:hover {
        color: #157046;
    }
    .back-to-home i {
        margin-right: 0.5rem;
    }
    @media (max-width: 576px) {
        .card-body {
            padding: 1.5rem;
        }
    }
  </style>
</head>
<body class="">
  <div class="register-container">
    <div class="text-center mb-4">
      <a href="/" class="text-decoration-none">
        <div class="logo">
          <i class="fas fa-clinic-medical text-primary pb-2"></i>
          <span class="logo-text text-dark">Obat</span>
        </div>
      </a>
      <h2 class="h4 fw-bold">Buat Akun Baru</h2>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
      <div class="card-body">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-user text-muted"></i>
              </span>
              <input type="text" class="form-control border-start-0" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-map-marker-alt text-muted"></i>
              </span>
              <textarea class="form-control border-start-0" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
            </div>
          </div>

          <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-phone text-muted"></i>
              </span>
              <input type="tel" class="form-control border-start-0" id="no_hp" name="no_hp" placeholder="Contoh: 08123456789" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-envelope text-muted"></i>
              </span>
              <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="nama@contoh.com" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text bg-light border-end-0">
                <i class="fas fa-lock text-muted"></i>
              </span>
              <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Buat password" required>
              <button class="input-group-text bg-light border-start-0" type="button" id="togglePassword">
                <i class="fas fa-eye-slash text-muted"></i>
              </button>
            </div>
          </div>

          <div class="d-grid mb-4">
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
          </div>

          <div class="text-center">
            <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Masuk</a></p>
          </div>
        </form>
      </div>
    </div>

    
  </div>

  <!-- jQuery -->
  @include('layouts.lib.ext-js')
  <script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);

      // Toggle icon
      this.querySelector('i').classList.toggle('fa-eye');
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>