<div class="project-header">
    <span class="project-badge">
    <i class="bi bi-building me-1"></i>
    PROYEK AKTIF
    </span>

    @if ($kegiatan->count() > 0)
        @php
            $tgl_saat_ini = now();
            $tgl_mulai = $format->parse($kegiatan->first()->tanggal_mulai);
            $tgl_selesai = $format->parse($kegiatan->first()->tanggal_mulai)->addDays($kegiatan->first()->lama_pekerjaan - 1);
        @endphp
        <h2>{{ $kegiatan->first()->nama_kegiatan }}</h2>

        <p class="mb-3 opacity-75">{{ $kegiatan->first()->alamat  }}</p>

        <div class="row g-3">
        <div class="col-md-3">
            <small class="opacity-75"> Nilai Kontrak </small>

            <div class="fw-bold fs-5">Rp {{ number_format($kegiatan->first()->nilai_proyek, 0, ',', '.') }}</div>
        </div>

        <div class="col-md-3">
            <small class="opacity-75"> Mulai </small>

            <div class="fw-bold">{{ $tgl_mulai->isoFormat('D MMMM Y') }}</div>
        </div>

        <div class="col-md-3">
            <small class="opacity-75"> Target Selesai </small>

            <div class="fw-bold">{{ $tgl_selesai->isoFormat('D MMMM Y') }}</div>
        </div>

        <div class="col-md-3">
            <small class="opacity-75"> Status </small>

            <div>
            @if ($tgl_saat_ini < $kegiatan->first()->tanggal_mulai)
                <span class="badge bg-info"> Belum Berjalan </span>
            @elseif ($tgl_saat_ini > $kegiatan->first()->tanggal_mulai && $tgl_saat_ini < $tgl_selesai)
                <span class="badge bg-success"> Sedang Berjalan </span>
            @else
                <span class="badge bg-danger"> Selesai </span>
            @endif
            </div>
        </div>
        </div>
    @else
        <h2>-</h2>

        <p class="mb-3 opacity-75">-</p>

        <div class="row g-3">
        <div class="col-md-3">
            <small class="opacity-75"> Nilai Kontrak </small>

            <div class="fw-bold fs-5">-</div>
        </div>

        <div class="col-md-3">
            <small class="opacity-75"> Mulai </small>

            <div class="fw-bold">-</div>
        </div>

        <div class="col-md-3">
            <small class="opacity-75"> Target Selesai </small>

            <div class="fw-bold">-</div>
        </div>

        <div class="col-md-3">
            <small class="opacity-75"> Status </small>

            <div>
            <span class="badge bg-success"> - </span>
            </div>
        </div>
        </div>
    @endif
</div>