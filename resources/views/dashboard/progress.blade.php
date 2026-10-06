<div class="col-lg-8">
    <div class="dashboard-card card">
        <div
        class="card-header d-flex justify-content-between align-items-center"
        >
        <span> Prosentase Pengeluaran Berdasarkan Kategori </span>

        {{-- <button class="btn btn-sm btn-outline-primary">
            Lihat Detail
        </button> --}}
        </div>

        @php
            $honor_konsultan = 0;
            $honor_panitia = 0;
            $upah_pekerja = 0;
            $belanja_material = 0;
            $cek_honor_konsultan = 0;
            $cek_belanja_material = 0;
            $cek_honor_panitia = 0;
            $cek_upah_pekerja = 0;
        @endphp

        @if ($kegiatan->count() > 0)
            @php
                $nilai_proyek = $kegiatan->first()->nilai_proyek;
            @endphp
            @if ($laporan->count() > 0)
                @php
                    $cek_honor_konsultan = $laporan->where('kategori', '=', 'honor_konsultan')->sum('nominal');
                    $cek_belanja_material = $laporan->where('kategori', '=', 'belanja_material')->sum('nominal');
                    $cek_honor_panitia = $laporan->filter(function ($item) {
                                                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'panitia';
                                            })->sum('nominal');
                    $cek_upah_pekerja = $laporan->filter(function ($item) {
                                                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'pekerja';
                                            })->sum('nominal');
                    $honor_konsultan = $cek_honor_konsultan > 0 ? (($cek_honor_konsultan * 100) / $nilai_proyek) : 0;
                    $honor_panitia = $cek_honor_panitia > 0 ? (($cek_honor_panitia * 100) / $nilai_proyek) : 0;
                    $upah_pekerja = $cek_upah_pekerja > 0 ? (($cek_upah_pekerja * 100) / $nilai_proyek) : 0;
                    $belanja_material = $cek_belanja_material > 0 ? (($cek_belanja_material * 100) / $nilai_proyek) : 0;
                @endphp
            @endif
        @endif

        <div class="card-body">
        <!-- PEKERJAAN 1 -->
        <div class="mb-4">
            <div class="d-flex justify-content-between mb-2">
            <span> Honorarium Konsultan <small class="text-muted">({{ number_format($cek_honor_konsultan, 0, ',', '.') }})</small></span>

            <strong> {{ number_format($honor_konsultan, 2) }}% </strong>
            </div>

            <div class="progress">
            <div
                class="progress-bar bg-success"
                style="width: {{ $honor_konsultan }}%"
            ></div>
            </div>
        </div>

        <!-- PEKERJAAN 2 -->
        <div class="mb-4">
            <div class="d-flex justify-content-between mb-2">
            <span> Honorarium Panitia <small class="text-muted">({{ number_format($cek_honor_panitia, 0, ',', '.') }})</small></span>

            <strong> {{ number_format($honor_panitia, 2) }}% </strong>
            </div>

            <div class="progress">
            <div
                class="progress-bar bg-primary"
                style="width: {{ $honor_panitia }}%"
            ></div>
            </div>
        </div>

        <!-- PEKERJAAN 3 -->
        <div class="mb-4">
            <div class="d-flex justify-content-between mb-2">
            <span> Upah Pekerja <small class="text-muted">({{ number_format($cek_upah_pekerja, 0, ',', '.') }})</small></span>

            <strong> {{ number_format($upah_pekerja, 2) }}% </strong>
            </div>

            <div class="progress">
            <div
                class="progress-bar"
                style="width: {{ $upah_pekerja }}%; background: #f6a623"
            ></div>
            </div>
        </div>

        <!-- PEKERJAAN 4 -->
        <div>
            <div class="d-flex justify-content-between mb-2">
            <span> Belanja Material Bangunan <small class="text-muted">({{ number_format($cek_belanja_material, 0, ',', '.') }})</small></span>

            <strong> {{ number_format($belanja_material, 2) }}% </strong>
            </div>

            <div class="progress">
            <div class="progress-bar bg-info" style="width: {{ $belanja_material }}%"></div>
            </div>
        </div>
        </div>
    </div>
    </div>