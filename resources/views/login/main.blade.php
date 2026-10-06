<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title }}</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/bootstrap-5.0.2-dist/css/bootstrap.min.css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="/plugins/bootstrap-sweetalert2/sweetalert2.all.min.css" />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <style>
      :root {
        --primary: #173f5f;
        --secondary: #20639b;
        --orange: #f6a623;
        --green: #2e8b57;
      }

      * {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        min-height: 100vh;
        font-family: "Segoe UI", sans-serif;
        background: #f4f7fb;
      }

      /* =========================
           MAIN LOGIN WRAPPER
        ========================= */

      .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
      }

      .login-container {
        width: 100%;
        max-width: 1100px;
        min-height: 650px;
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(23, 63, 95, 0.15);
        display: flex;
      }

      /* =========================
           LEFT SIDE
        ========================= */

      .login-left {
        width: 50%;
        position: relative;
        padding: 50px;
        color: white;

        background: linear-gradient(
          135deg,
          rgba(23, 63, 95, 0.97),
          rgba(32, 99, 155, 0.92)
        );

        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
      }

      .login-left::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        top: -150px;
        right: -100px;
      }

      .login-left::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(246, 166, 35, 0.12);
        bottom: -120px;
        left: -100px;
      }

      /* LOGO */

      .brand {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 14px;
      }

      .brand-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;

        background: rgba(255, 255, 255, 0.15);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 25px;

        border: 1px solid rgba(255, 255, 255, 0.2);
      }

      .brand-title {
        font-size: 18px;
        font-weight: 700;
      }

      .brand-subtitle {
        font-size: 12px;
        opacity: 0.7;
      }

      /* CONTENT */

      .left-content {
        position: relative;
        z-index: 2;
      }

      .left-content h1 {
        font-size: 38px;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 18px;
      }

      .left-content p {
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.7;
        max-width: 430px;
      }

      /* BUILDING ILLUSTRATION */

      .building {
        position: relative;
        z-index: 2;
        height: 180px;
        margin-top: 30px;

        display: flex;
        align-items: flex-end;
        justify-content: center;
      }

      .building-main {
        width: 280px;
        height: 125px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 5px 5px 0 0;
        position: relative;
      }

      .building-roof {
        position: absolute;
        width: 0;
        height: 0;
        border-left: 155px solid transparent;
        border-right: 155px solid transparent;
        border-bottom: 65px solid var(--orange);
        top: -65px;
        left: -15px;
      }

      .building-door {
        position: absolute;
        width: 48px;
        height: 70px;
        background: var(--primary);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 4px 4px 0 0;
      }

      .building-window {
        position: absolute;
        width: 35px;
        height: 35px;
        background: #bde4f7;
        border: 4px solid var(--primary);
        top: 35px;
      }

      .window-1 {
        left: 35px;
      }

      .window-2 {
        right: 35px;
      }

      /* FOOTER LEFT */

      .left-footer {
        position: relative;
        z-index: 2;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.55);
      }

      /* =========================
           RIGHT SIDE
        ========================= */

      .login-right {
        width: 50%;
        padding: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .login-form {
        width: 100%;
        max-width: 400px;
      }

      /* HEADER */

      .login-header {
        margin-bottom: 35px;
      }

      .login-header h2 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 8px;
      }

      .login-header p {
        color: #6b7280;
        margin: 0;
      }

      /* FORM */

      .form-label {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
      }

      .input-group-custom {
        position: relative;
      }

      .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        z-index: 5;
      }

      .form-control-custom {
        height: 52px;
        padding-left: 45px;
        padding-right: 45px;

        border: 1px solid #dfe5ec;
        border-radius: 10px;

        font-size: 14px;

        transition: 0.2s;
      }

      .form-control-custom:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 4px rgba(32, 99, 155, 0.1);
      }

      .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);

        border: none;
        background: transparent;
        color: #94a3b8;

        cursor: pointer;

        z-index: 5;
      }

      /* REMEMBER */

      .form-check-input:checked {
        background-color: var(--secondary);
        border-color: var(--secondary);
      }

      .forgot-password {
        color: var(--secondary);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
      }

      .forgot-password:hover {
        text-decoration: underline;
      }

      /* LOGIN BUTTON */

      .btn-login {
        height: 52px;
        border: none;
        border-radius: 10px;

        background: linear-gradient(135deg, var(--primary), var(--secondary));

        color: white;
        font-weight: 600;

        transition: 0.2s;

        box-shadow: 0 7px 18px rgba(32, 99, 155, 0.22);
      }

      .btn-login:hover {
        color: white;
        transform: translateY(-1px);

        box-shadow: 0 10px 22px rgba(32, 99, 155, 0.3);
      }

      /* DIVIDER */

      .divider {
        display: flex;
        align-items: center;
        gap: 15px;

        color: #9ca3af;
        font-size: 12px;

        margin: 25px 0;
      }

      .divider::before,
      .divider::after {
        content: "";
        height: 1px;
        background: #e5e7eb;
        flex: 1;
      }

      /* INFO */

      .login-info {
        background: #f5f8fc;
        border-radius: 10px;
        padding: 13px 15px;

        font-size: 12px;
        color: #64748b;
      }

      .login-info i {
        color: var(--secondary);
      }

      /* =========================
           RESPONSIVE
        ========================= */

      @media (max-width: 900px) {
        .login-container {
          max-width: 600px;
        }

        .login-left {
          display: none;
        }

        .login-right {
          width: 100%;
          padding: 50px;
        }
      }

      @media (max-width: 576px) {
        .login-wrapper {
          padding: 0;
          align-items: stretch;
        }

        .login-container {
          min-height: 100vh;
          border-radius: 0;
          box-shadow: none;
        }

        .login-right {
          padding: 30px 22px;
        }

        .login-form {
          max-width: 100%;
        }

        .login-header h2 {
          font-size: 25px;
        }
      }
    </style>
  </head>

  <body>
    <div class="login-wrapper">
      <div class="login-container">
        <!-- =========================
             LEFT SIDE
        ========================== -->

        <div class="login-left">
          <!-- BRAND -->

          <div class="brand">
            <div class="brand-icon">
              <i class="bi bi-building"></i>
            </div>

            <div>
              <div class="brand-title">REVITALISASI 2026</div>

              <div class="brand-subtitle">
                Sistem Laporan Keuangan Pembangunan Sekolah
              </div>
            </div>
          </div>

          <!-- CONTENT -->

          <div class="left-content">
            <h1>Pantau Pembangunan Sekolah Dengan Mudah</h1>

            <p>
              Sistem informasi untuk menajemen laporan keuangan pembangunan gedung sekolah secara terintegrasi.
            </p>

            <!-- BUILDING -->

            <div class="building">
              <div class="building-main">
                <div class="building-roof"></div>

                <div class="building-window window-1"></div>

                <div class="building-window window-2"></div>

                <div class="building-door"></div>
              </div>
            </div>
          </div>

          <!-- FOOTER -->

          <div class="left-footer">
            © 2026 Sistem Informasi Laporan Pembangunan Sekolah
          </div>
        </div>

        <!-- =========================
             RIGHT SIDE
        ========================== -->

        <div class="login-right">
          <div class="login-form">
            <!-- HEADER -->

            <div class="login-header">
              <h2>Selamat Datang 👋</h2>

              <p>Silakan masuk untuk melanjutkan ke sistem.</p>
            </div>

            <!-- LOGIN FORM -->

            <form action="/" method="POST" id="loginForm">
                @csrf
              <!-- USERNAME -->

              <div class="mb-4">
                <label class="form-label"> Username </label>

                <div class="input-group-custom">
                  <i class="bi bi-person input-icon"></i>

                  <input
                    type="text"
                    class="form-control form-control-custom"
                    id="username"
                    name="username"
                    placeholder="Masukkan username"
                    autocomplete="username"
                  />
                </div>
                @error('username')
                    <div class="feedback-invalid">
                        <span class="badge bg-danger">{{ $message }}</span>
                    </div>
                @enderror
              </div>

              <!-- PASSWORD -->

              <div class="mb-3">
                <label class="form-label"> Password </label>

                <div class="input-group-custom">
                  <i class="bi bi-lock input-icon"></i>

                  <input
                    type="password"
                    class="form-control form-control-custom"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                  />

                  <button
                    type="button"
                    class="password-toggle"
                    onclick="togglePassword()"
                  >
                    <i class="bi bi-eye" id="passwordIcon"> </i>
                  </button>
                </div>
                @error('password')
                    <div class="feedback-invalid">
                        <span class="badge bg-danger">{{ $message }}</span>
                    </div>
                @enderror
              </div>

              <!-- LOGIN BUTTON -->

              <button type="submit" class="btn btn-login w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>

                Masuk ke Sistem
              </button>
            </form>

            <!-- DIVIDER -->

            <div class="divider">Akses Sistem</div>

            <!-- INFO -->

            <div class="login-info">
              <i class="bi bi-shield-check me-2"></i>

              Pastikan username dan password Anda benar sebelum masuk ke sistem.
            </div>
          </div>
        </div>
      </div>
    </div>

    @if (session()->has('notif'))
        <div id="notif" data-icon="{{ session('icon') }}" data-message="{{ session('message') }}" data-title="{{ session('title') }}"></div>
    @else
        <div id="notif" data-icon="" data-message="" data-title=""></div>
    @endif

    <!-- BOOTSTRAP JS -->
    <script src="/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="/plugins/bootstrap-sweetalert2/sweetalert2.all.min.js"></script>

    <script>
      /*
    ==========================================
    SHOW / HIDE PASSWORD
    ==========================================
    */

      function togglePassword() {
        const password = document.getElementById("password");

        const icon = document.getElementById("passwordIcon");

        if (password.type === "password") {
          password.type = "text";

          icon.classList.remove("bi-eye");

          icon.classList.add("bi-eye-slash");
        } else {
          password.type = "password";

          icon.classList.remove("bi-eye-slash");

          icon.classList.add("bi-eye");
        }
      }
    </script>

    <script>
        const notif = document.getElementById('notif');
        const icon = notif.getAttribute('data-icon');
        const message = notif.getAttribute('data-message');
        const title = notif.getAttribute('data-title');
        if (message) {
            Swal.fire({
                title: title,
                html: message,
                icon: icon
            });
        }
    </script>
  </body>
</html>
