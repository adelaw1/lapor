@php
    $anggaran_realisasi = 0;
    $prosentase_anggaran_realisasi = 0;
    $anggaran_belum_realisasi = 0;
    $prosentase_anggaran_belum_realisasi = 0;
    $pengeluaran = 0;
    $pemasukan = 0;
    $sisa_saldo = 0;
@endphp

@if ($laporan->count() > 0)
    @php
        $pengeluaran = $laporan->where('mutasi', '=', 'keluar')->sum('nominal');
        $pemasukan = $laporan->where('mutasi', '=', 'masuk')->sum('nominal');
        $anggaran_realisasi = $laporan->where('realisasi_anggaran', '=', 'Y')->sum('nominal');
    @endphp
    @if ($kegiatan->count() > 0)
        @php
            $prosentase_anggaran_realisasi = ($anggaran_realisasi * 100) / $kegiatan->first()->nilai_proyek;
            $prosentase_anggaran_belum_realisasi = 100 - ceil($prosentase_anggaran_realisasi);
            $anggaran_belum_realisasi = $kegiatan->first()->nilai_proyek - $anggaran_realisasi;
        @endphp
    @endif
@endif

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
    <div class="stat-card">
        <div class="stat-icon icon-blue">
        <i class="bi bi-wallet2"></i>
        </div>

        <div class="stat-number">Rp. {{ number_format($anggaran_realisasi, 0, ',', '.') }}</div>

        <div class="d-flex justify-content-between">
            <div class="stat-label">Anggaran Terealisasi</div>
            <small class="text-muted">{{ ceil($prosentase_anggaran_realisasi) }}%</small>
        </div>

        <div class="progress mt-3">
        <div class="progress-bar bg-primary" style="width: {{ ceil($prosentase_anggaran_realisasi) }}%"></div>
        </div>
    </div>
    </div>

    <div class="col-xl-3 col-md-6">
    <div class="stat-card">
        <div class="stat-icon icon-orange">
        <i class="bi bi-wallet-fill"></i>
        </div>

        <div class="stat-number">Rp. {{ number_format($anggaran_belum_realisasi, 0, ',', '.') }}</div>

        <div class="d-flex justify-content-between">
            <div class="stat-label">Anggaran Belum Terealisasi</div>
            <small class="text-muted">{{ ceil($prosentase_anggaran_belum_realisasi) }}%</small>
        </div>

        <div class="progress mt-3">
        <div
            class="progress-bar"
            style="width: {{ ceil($prosentase_anggaran_belum_realisasi) }}%; background: #f6a623"
        ></div>
        </div>
    </div>
    </div>

    <div class="col-xl-3 col-md-6">
    <div class="stat-card">
        <div class="stat-icon icon-red">
        <i class="bi bi-cash"></i>
        </div>

        <div class="stat-number">{{ number_format($pengeluaran, 0, ',', '.') }}</div>

        <div class="stat-label">Pengeluaran</div>

        <div class="mt-3 text-danger small">
        <i class="bi bi-arrow-down"></i>
        Pengeluaran sampai saat ini
        </div>
    </div>
    </div>

    <div class="col-xl-3 col-md-6">
    <div class="stat-card">
        <div class="stat-icon icon-green">
        <i class="bi bi-cash-stack"></i>
        </div>

        <div class="stat-number">{{ number_format(($pemasukan - $pengeluaran), 0, ',', '.') }}</div>

        <div class="stat-label">Sisa Saldo</div>

        <div class="mt-3 text-success small">
            Sisa saldo saat ini
        </div>
    </div>
    </div>
</div>