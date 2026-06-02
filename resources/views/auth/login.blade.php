<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>KB Nurul'Ain – Masuk</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root {
      --primary: #0e7490;
      --primary-dark: #0c6480;
      --bg-gradient-start: #f0f7fa;
      --bg-gradient-end: #e8f5f0;
      --text-dark: #1e293b;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --card-shadow: 0 4px 32px rgba(14,116,144,.10);
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      min-height: 100vh;
      background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
      display: flex;
      flex-direction: column;
    }

    /* NAVBAR */
    .top-nav {
      padding: 20px 36px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 700;
      color: var(--primary);
      text-decoration: none;
      font-size: 1.2rem;
    }

    .brand-icon {
      width: 36px;
      height: 36px;
      background: var(--primary);
      border-radius: 10px;
      display: grid;
      place-items: center;
      color: #fff;
    }

    /* LOGIN SECTION */
    .login-section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .card-login {
      background: #fff;
      border-radius: 20px;
      padding: 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: var(--card-shadow);
    }

    .title {
      text-align: center;
      font-weight: 700;
      font-size: 1.5rem;
    }

    .subtitle {
      text-align: center;
      font-size: 0.9rem;
      color: var(--text-muted);
      margin-bottom: 25px;
    }

    .form-label {
      font-size: 0.85rem;
      font-weight: 600;
    }

    .form-control {
      border-radius: 10px;
      padding-left: 40px;
      height: 44px;
      font-size: 0.9rem;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
    }

    .btn-masuk {
      width: 100%;
      background: var(--primary);
      color: #fff;
      padding: 12px;
      border-radius: 10px;
      font-weight: 600;
      border: none;
      transition: 0.2s;
    }

    .btn-masuk:hover {
      background: var(--primary-dark);
    }

    .alert-login {
      display: none;
      background: #fef2f2;
      color: #b91c1c;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 0.85rem;
    }

    .alert-login.show {
      display: block;
    }

    .link {
      text-align: center;
      margin-top: 15px;
      font-size: 0.85rem;
    }

    footer {
      padding: 20px;
      font-size: 0.8rem;
      color: var(--text-muted);
      text-align: center;
    }

    /* 🔥 RESPONSIVE FIX */
    @media (max-width: 768px) {
      .top-nav {
        padding: 16px 20px;
      }

      .brand {
        font-size: 1rem;
      }

      .card-login {
        padding: 30px 20px;
      }

      .title {
        font-size: 1.3rem;
      }

      .subtitle {
        font-size: 0.85rem;
      }
    }

    @media (max-width: 480px) {
      .login-section {
        padding: 15px;
      }

      .card-login {
        padding: 25px 18px;
        border-radius: 16px;
      }

      .form-control {
        height: 42px;
        font-size: 0.85rem;
      }

      .btn-masuk {
        padding: 11px;
        font-size: 0.9rem;
      }

      footer {
        font-size: 0.75rem;
        padding: 15px;
      }
    }
  </style>
</head>

<body>

<nav class="top-nav">
  <a href="#" class="brand">
    <span class="brand-icon"><i class="bi bi-mortarboard-fill"></i></span>
    KB Nurul'Ain
  </a>
</nav>

<div class="login-section">
  <div class="card-login">

    <div class="title">Selamat Datang Kembali</div>
    <div class="subtitle">Silakan masuk dashboard guru KB Nurul’Ain</div>

    <div class="alert-login" id="alertLogin"></div>

    <form method="POST" action="{{ url('/login') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label">Email</label>
        <div class="position-relative">
          <i class="bi bi-person input-icon"></i>
          <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="position-relative">
          <i class="bi bi-lock input-icon"></i>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
      </div>

      <button type="submit" class="btn-masuk">
        Masuk <i class="bi bi-box-arrow-in-right"></i>
      </button>

    </form>

  </div>
</div>

<footer>
  <div>KB Nurul'Ain Kabupaten Bintan</div>
  <div>© 2024 Sistem Pencatatan Perkembangan Anak</div>
</footer>

@if ($errors->any())
<script>
  let alertBox = document.getElementById('alertLogin');
  alertBox.innerHTML = "{{ $errors->first() }}";
  alertBox.classList.add('show');
</script>
@endif

</body>
</html>