<header class="topbar">
        <div class="d-flex align-items-center gap-3">
          <!-- Mobile Menu -->
          <button class="mobile-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
          </button>

          <div>
            <div class="fw-semibold">{{ Str::ucfirst(str_replace('_', ' ', request()->segment(1))) }}</div>

            <small class="text-muted">
              Laporan pembangunan gedung sekolah
            </small>
          </div>
        </div>

        <!-- RIGHT TOPBAR -->
        <div class="d-flex align-items-center gap-3">
          <!-- ADMIN DROPDOWN -->
          <div class="dropdown">
            <button
              class="btn p-0 border-0 d-flex align-items-center gap-2"
              type="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <!-- Avatar -->
              <div class="user-avatar">AD</div>

              <!-- Admin Information -->
              <div class="user-info text-start">
                <div class="fw-semibold small">{{ auth()->user()->nama }}</div>

                <small class="text-muted"> {{ Str::ucfirst(auth()->user()->level) }} </small>
              </div>

              <i class="bi bi-chevron-down text-muted small"></i>
            </button>

            <!-- DROPDOWN MENU -->
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
              <!-- LOGOUT -->
              <li>
                <button class="dropdown-item text-danger">
                  <a href="/logout" class="text-danger" style="text-decoration: none;">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                  </a>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </header>