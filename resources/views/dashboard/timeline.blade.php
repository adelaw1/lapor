<div class="col-lg-4">
    <div class="dashboard-card card">
        <div class="card-header">5 Transaksi Terbaru</div>

        <div class="card-body">
        <div class="timeline">

            @foreach ($laporan->sortByDesc('tanggal')->take(5) as $item)
                <div class="timeline-item">
                    <div class="timeline-dot {{ $item->mutasi == 'masuk' ? 'done' : 'warning' }}"></div>

                    <small class="text-muted"> {{ $format->parse($item->tanggal)->isoFormat('D MMMM Y') }} </small>

                    <div class="fw-semibold">{{ $item->uraian }}</div>

                    <small class="text-{{ $item->mutasi == 'keluar' ? 'danger' : 'success' }}"> {{ number_format($item->nominal, 0, ',', '.') }} </small>
                </div>
            @endforeach

        </div>
        </div>
    </div>
    </div>