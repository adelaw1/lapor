<x-templates>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mb-4">
          <h3 class="page-title mb-1">Laporan Pembangunan Gedung Sekolah</h3>

          <p class="text-muted mb-0">
            Monitoring perkembangan pembangunan secara berkala.
          </p>
        </div>

        <!-- TABLE -->
        <div class="dashboard-card card mt-4">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <span> {{ $title }} </span>

            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="bi bi-plus"></span> Tambah Laporan
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/input_laporan/honor_konsultan">Honor Konsultan</a></li>
                  <li><a class="dropdown-item" href="/input_laporan/honor_panitia_petukang">Honor Panitia / Petukang</a></li>
                  <li><a class="dropdown-item" href="/input_laporan/belanja_material">Belanja Barang</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/input_laporan/mutasi">Mutasi Dana</a></li>
                </ul>
            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-stripped" id="dataTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    {{-- <th>No. Bukti</th> --}}
                    <th>Pembayaran</th>
                    <th>Uraian</th>
                    <th>Mutasi</th>
                    <th>Nominal</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>

                    @php
                      $no = 1;
                      $btn_edit = [
                        'honor_konsultan' => 'edit_honor_konsultan',
                        'mutasi' => 'edit_mutasi',
                        'honor_panitia_petukang' => 'edit_honor_panitia_petukang',
                        'belanja_material' => 'edit_belanja_material'
                      ];
                      $bkkb = 0;
                      $bkkt = 0;
                      $bkmb = 0;
                      $bkmt = 0;
                      $no_bukti = 0;
                    @endphp
                    @foreach ($rows as $row)
                        {{-- @if ($row->mutasi == 'keluar')
                            @if ($row->metode_pembayaran == 'transfer')
                                  @php
                                      $bkkb++;
                                      $no_bukti = $bkkb;
                                  @endphp
                            @else
                                  @php
                                      $bkkt++;
                                      $no_bukti = $bkkt;
                                  @endphp
                            @endif                              
                        @elseif ($row->mutasi == 'masuk')
                            @if ($row->metode_pembayaran == 'transfer')
                                  @php
                                      $bkmb++;
                                      $no_bukti = $bkmb;
                                  @endphp
                            @else
                                  @php
                                      $bkmt++;
                                      $no_bukti = $bkmt;
                                  @endphp
                            @endif
                        @endif

                        @php
                            $no_bukti = ($no_bukti < 10 ? "00" : ($no_bukti < 100 ? "0" : "")) . $no_bukti;
                        @endphp --}}
                          
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $frm->parse($row->tanggal)->isoFormat('D MMMM Y') }}</td>
                            {{-- <td>{{ $row->mutasi == 'tarik' ? '-' : $master->getNoBukti($row->mutasi, $row->metode_pembayaran) . $no_bukti }}</td> --}}
                            <td>
                              @if ($row->metode_pembayaran == 'transfer')
                                  <span class="badge rounded-pill bg-primary">Transfer</span>
                              @else
                                  <span class="badge rounded-pill bg-warning">Tunai</span>
                              @endif
                            </td>
                            <td>
                              {{ $row->uraian }}
                              @if ($row->status)
                                  @if ($row->status == 'panitia')
                                      @php $jml = $master->getDataPanitia()->count(); @endphp
                                      ({{ $jml }} org)
                                  @else
                                      @php $jml = $master->getDataPekerja()->count(); @endphp
                                      ({{ $jml }} org)
                                  @endif
                              @endif
                              @if ($row->toko)
                                  <br><small class="badge rounded-pill bg-secondary">Toko {{ $row->toko->nama_toko }}</small>
                              @endif
                            </td>
                            <td>
                                @if ($row->mutasi == 'masuk')
                                    <span class="badge rounded-pill bg-success">Masuk</span>
                                @elseif ($row->mutasi == 'keluar')
                                    <span class="badge rounded-pill bg-danger">Keluar</span>
                                @else
                                    <span class="badge rounded-pill bg-info">Tarik TUnai</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($row->nominal, 0, ',', '.') }}</td>
                            <td>
                              @if ($row->bukti)
                                  <a href="{{ asset('storage/' . $row->bukti) }}" target="_blank">Download Bukti</a>
                              @else
                                  <small class="text-muted">Tidak ada</small>
                              @endif
                            </td>
                            <td>
                                <form action="/input_laporan/{{ $row->id }}" method="POST">
                                    @csrf
                                    @method('delete')

                                      <a href="/input_laporan/{{ $row->kategori }}/{{ $row->id }}/{{ $btn_edit[$row->kategori] }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                      </a>
                                    
                                    <button type="submit" class="btn btn-sm btn-danger hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>

</x-templates>