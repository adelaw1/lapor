<x-templates>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-4">
          <h3 class="page-title mb-1">Laporan Pembangunan Gedung Sekolah</h3>

          <p class="text-muted mb-0">
            Monitoring perkembangan pembangunan secara berkala.
          </p>
        </div>

        <!-- TABLE -->
        {{-- <div class="dashboard-card card mt-4">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <span> {{ $title }} </span>

          </div>

          <div class="card-body">

            <button class="btn btn-primary">
                <i class="bi bi-printer"></i>
                Cetak BKU
            </button>

          </div>
        </div> --}}

        <div class="row">
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-book-half text-success" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Buku Kas Umum (BKU)</h5>
                        <p class="card-text">Catatan kronologis penerimaan dan pengeluaran kas untuk memantau saldo.</p>
                        <a href="/cetak_laporan/bku" class="btn btn-sm btn-success" target="_blank">
                            <span class="bi bi-printer"></span> Cetak BKU
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-bank text-primary" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Buku Bank (BB)</h5>
                        <p class="card-text">catatan khusus yang merekam seluruh mutasi dan saldo rekening bank.</p>
                        <a href="/cetak_laporan/bb" class="btn btn-sm btn-primary" target="_blank">
                            <span class="bi bi-printer"></span> Cetak BB
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-wallet text-danger" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Buku Kas Tunai (BKT)</h5>
                        <p class="card-text">Catatan transaksi keuangan yang menggunakan uang tunai fisik di brankas.</p>
                        <a href="/cetak_laporan/bkt" class="btn btn-sm btn-danger" target="_blank">
                            <span class="bi bi-printer"></span> Cetak BKT
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-journal-text" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Daftar Hadir P2SP</h5>
                        <p class="card-text">Blanko daftar hadir Panitia P2SP Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu.</p>
                        <a href="/cetak_laporan/daftar_hadir/panitia" class="btn btn-sm btn-dark" target="_blank">
                            <span class="bi bi-printer"></span> Cetak Daftar Hadir
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-journal-code text-warning" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Honorarium P2SP</h5>
                        <p class="card-text">Blanko penyerahan honorP2SP Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu.</p>
                        <a href="/cetak_laporan/honorarium/panitia" class="btn btn-sm btn-warning" target="_blank">
                            <span class="bi bi-printer"></span> Cetak Honorarium
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-journal-text text-dark" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Daftar Hadir Pekerja</h5>
                        <p class="card-text">Blanko daftar hadir Pekerja Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu.</p>
                        <a href="/cetak_laporan/daftar_hadir/pekerja" class="btn btn-sm btn-dark" target="_blank">
                            <span class="bi bi-printer"></span> Cetak Daftar Hadir
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="dashboard-card card">
                    <div class="text-center p-2">
                        <span class="bi bi-journal-code text-warning" style="font-size: 80px;"></span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Honorarium Pekerja</h5>
                        <p class="card-text">Blanko penyerahan Upah Pekerja Revitalisasi 2026 SMK Ashhabul Maimanah Sidayu.</p>
                        <a href="/cetak_laporan/honorarium/pekerja" class="btn btn-sm btn-warning" target="_blank">
                            <span class="bi bi-printer"></span> Cetak Honorarium
                        </a>
                    </div>
                </div>
            </div>
        </div>

</x-templates>