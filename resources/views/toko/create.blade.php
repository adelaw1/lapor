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
              {!! $form->frm_open('/toko') !!}
              @csrf
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {!! $form->frm_text('nama_toko', 'tag', old('nama_toko')) !!}
              {!! $form->frm_radio('aktif', ['Y' => 'Ya', 'N' => 'Tidak'], 'Y') !!}
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_save() !!}
              </div>
              {!! $form->frm_close() !!}
          </div>

        </div>

</x-templates>