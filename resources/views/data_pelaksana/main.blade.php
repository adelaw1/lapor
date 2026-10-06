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

            <a href="/data_pelaksana/create" class="btn btn-primary btn-sm">
              <i class="bi bi-plus-lg me-1"></i>
              Tambah Data Pelaksana
            </a>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-stripped" id="dataTable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Honor</th>
                    <th>TTD</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>

                    @php $no = 1; @endphp
                    @foreach ($rows as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->nip ?: '-' }}</td>
                            <td>{{ $row->honor->jabatan }}</td>
                            <td>{{ number_format($row->honor->nominal, 0, ',', '.') }}</td>
                            <td>
                              @if ($row->ttd)
                                  <img src="{{ asset("storage/" . $row->ttd)}}" alt="{{ $row->nama }}" width="50" />
                              @else
                                  -
                              @endif
                            </td>
                            <td>
                                <form action="/data_pelaksana/{{ $row->id }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <a href="/data_pelaksana/{{ $row->id }}/edit" class="btn btn-sm btn-warning">
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