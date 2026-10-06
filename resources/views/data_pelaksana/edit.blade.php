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

          </div>

          <div class="p-4">
              {!! $form->frm_open('/data_pelaksana/' . $row->id, true) !!}
              @csrf
              @method('put')
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {!! $form->frm_text('nama', 'tag', old('nama') ?: $row->nama) !!}
              {!! $form->frm_text('nip', 'bookmark', old('nip') ?: $row->nip) !!}
              {!! $form->frm_select('jabatan', 'list-stars', $jabatan, old('jabatan') ?: $row->honor_id) !!}
              @if ($row->ttd)
                  {!! $form->image("tanda_tangan_terpasang", ["src" => asset("storage/" . $row->ttd), "width" => 100]) !!}
              @endif
              {!! $form->frm_file('tanda_tangan') !!}
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_update() !!}
              </div>
              {!! $form->frm_close() !!}
          </div>

        </div>

</x-templates>