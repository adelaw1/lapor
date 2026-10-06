<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title }}</title>

    <link rel="shortcut icon" href="/favicon/logo.ico">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="/bootstrap-5.0.2-dist/css/bootstrap.min.css" />

    <!-- DatePicker -->
    <link rel="stylesheet" href="/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" />

    <!-- SweetAlert -->
    <link rel="stylesheet" href="/plugins/bootstrap-sweetalert2/sweetalert2.all.min.css" />

    <!-- DataTables -->
    <link href="/plugins/DataTables/datatables.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <link rel="stylesheet" href="/css/templates.css" />
    @stack('styles')
  </head>

  <body>
    <!-- SIDEBAR -->
    @include('partials.sidebar')

    <!-- MAIN -->
    <main class="main">
      <!-- TOPBAR -->
      @include('partials.header')

      <!-- CONTENT -->
      <section class="content">
        <!-- PAGE TITLE -->
        {{ $slot }}

        <!-- FOOTER -->
        @include('partials.footer')

      </section>
    </main>

    @if (session()->has('notif'))
        <div id="notif" data-icon="{{ session('icon') }}" data-message="{{ session('message') }}" data-title="{{ session('title') }}"></div>
    @else
        <div id="notif" data-icon="" data-message="" data-title=""></div>
    @endif

    <!-- BOOTSTRAP JS -->
    <script src="/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/libs/jquery/jquery.js"></script>

    <!-- DatePicker -->
    <script src="/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="/plugins/bootstrap-sweetalert2/sweetalert2.all.min.js"></script>

    <!-- DataTables -->
    <script src="/plugins/DataTables/datatables.min.js"></script>

    <script src="/js/formatRupiah.js"></script>

    <script>
      function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");

        sidebar.classList.toggle("show");
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
        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                html: "Data akan <strong>Dihapus!</strong>",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="bx bx-like"></i> Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parents('form').submit();
                }
            });
        });
    </script>

    <script>
      $('#dataTable').DataTable({
        autoWidth: true,
        responsive: true,
      });
      $('.date').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true,
      });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // Cari semua submenu yang memiliki item aktif
            document.querySelectorAll(".submenu .nav-link.active").forEach(function (activeLink) {

                // Cari parent collapse
                const collapse = activeLink.closest(".collapse");

                if (collapse) {

                    // Buka dropdown
                    const bsCollapse = new bootstrap.Collapse(collapse, {
                        show: true
                    });

                    // Ubah status aria-expanded pada menu induk
                    const parentToggle = document.querySelector(
                        '[href="#' + collapse.id + '"]'
                    );

                    if (parentToggle) {
                        parentToggle.setAttribute("aria-expanded", "true");
                    }
                }
            });

        });
    </script>

    @stack('scripts')

  </body>
</html>
