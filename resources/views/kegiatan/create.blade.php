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
              {!! $form->frm_open('/kegiatan') !!}
              @csrf
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {!! $form->frm_text('nama_kegiatan', 'tag', old('nama_kegiatan')) !!}
              {!! $form->frm_textarea('alamat', 'geo-fill', old('alamat')) !!}
              {!! $form->frm_text('nilai_proyek', 'cash', old('nilai_proyek')) !!}
              {!! $form->frm_tanggal('tanggal_mulai', 'calendar', old('tanggal_mulai')) !!}
              {!! $form->frm_text('lama_pekerjaan', 'hourglass-split', old('lama_pekerjaan')) !!}
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_save() !!}
              </div>
              {!! $form->frm_close() !!}
          </div>

        </div>

        @push('scripts')
            <script>
                $(document).on('keyup', '#nilai_proyek', function () {
                    let isi = $(this).val();
                    $('#nilai_proyek').val(formatRupiah(isi));
                });
            </script>
        @endpush

</x-templates>