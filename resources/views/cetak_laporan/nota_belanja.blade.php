<x-templates>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-4">
          <h3 class="page-title mb-1">Laporan Pembangunan Gedung Sekolah</h3>

          <p class="text-muted mb-0">
            Monitoring perkembangan pembangunan secara berkala.
          </p>
        </div>

        <div class="masonry-container">

          @php
              $nota = $master->getDataAllBelanjaMaterial();
          @endphp

          @foreach ($nota as $comp)
            <div class="masonry-item mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-primary">{{ $comp->toko->nama_toko }}</h5>
                  <p class="card-text">Tanggal Transaksi : {{ $format->parse($comp->tanggal)->isoFormat('D MMMM Y') }}</p>
                </div>
                <ul class="list-group list-group-flush">
                  @php $total = 0; @endphp
                  @foreach ($comp->barang as $item)
                    @php $total += ($item->harga * $item->qty); @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div>
                        <strong>{{ $item->nama_barang }}</strong><br>
                        <small class="text-muted">
                          ({{ $item->qty }}
                          {{ $item->satuan->nama_satuan }}
                          &#64;{{ number_format($item->harga, 0, ',', '.') }})
                        </small>
                      </div>
                      <div>
                        <strong>{{ number_format(($item->harga * $item->qty), 0, ',', '.') }}</strong>
                      </div>
                    </li>
                  @endforeach
                </ul>
                <div class="card-body">
                  <div class=" d-flex justify-content-between align-items-start">
                    <h5>Total</h5>
                    <h5>{{ number_format($total, 0, ',', '.') }}</h5>
                  </div>
                  <div>
                    <a href="/input_laporan/belanja_material/{{ $comp->id }}/edit_belanja_material">Edit Laporan</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>

        @push('styles')
            <style>
              .masonry-container {
                  column-count: 3; /* Jumlah kolom ke samping untuk layar besar */
                  column-gap: 1rem; /* Jarak antar kolom */
              }
              .masonry-item {
                  break-inside: avoid; /* Mencegah card terpotong di tengah */
                  margin-bottom: 1rem; /* Jarak antar card ke bawah */
              }

              /* Responsif untuk layar HP/Tablet */
              @media (max-width: 992px) {
                  .masonry-container { column-count: 2; }
              }
              @media (max-width: 576px) {
                  .masonry-container { column-count: 1; }
              }
            </style>
        @endpush

</x-templates>