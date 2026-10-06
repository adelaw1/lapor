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

            <a href="/honor/create" class="btn btn-primary btn-sm">
              <i class="bi bi-plus-lg me-1"></i>
              Tambah Honorarium
            </a>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-stripped" id="dataTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Jabatan</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp
                    @foreach ($rows as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                              @php
                                  $warna = ['konsultan' => 'info', 'panitia' => 'warning', 'pekerja' => 'secondary'];
                              @endphp
                              <span class="badge rounded-pill bg-{{$warna[$row->kategori]}}">{{ Str::ucfirst($row->kategori) }}</span>
                            </td>
                            <td>{{ $row->jabatan }}</td>
                            <td>Rp. {{ number_format($row->nominal, 0, ',', '.') }}</td>
                            <td>
                              <span class="badge rounded-pill {{ ($row->aktif == 'Y' ? 'bg-primary' : 'bg-danger') }}">{{ ($row->aktif == 'Y' ? 'Aktif' : 'Non Aktif') }}</span>
                            </td>
                            <td>
                                <form action="/honor/{{ $row->id }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <a href="/honor/{{ $row->id }}/edit" class="btn btn-sm btn-warning">
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