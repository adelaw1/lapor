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
              {!! $form->frm_open('/honor') !!}
              @csrf
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {!! $form->frm_select('kategori', 'list-nested', ['panitia' => 'Panitia', 'pekerja' => 'Pekerja'], old('kategori')) !!}
              {!! $form->frm_text('jabatan', 'tag', old('jabatan')) !!}
              {!! $form->frm_text('nominal', 'cash', old('nominal')) !!}
              {!! $form->frm_radio('aktif', ['Y' => 'Ya', 'N' => 'Tidak'], 'Y') !!}
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_save() !!}
              </div>
              {!! $form->frm_close() !!}
          </div>

        </div>

        @push('scripts')
            <script>
              $(document).on('keyup', '#nominal', function () {
                let isi = $(this).val();
                $('#nominal').val(formatRupiah(isi));
              });
            </script>
        @endpush
</x-templates>