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
              {!! $form->frm_open('/input_laporan/honor_panitia_petukang/' . $row->id, true) !!}
              @csrf
              @method('put')
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {{-- {!! $form->frm_text('no_bukti', 'paperclip', old('no_bukti') ?: $row->no_bukti, ['readonly' => 'readonly']) !!} --}}
              {!! $form->frm_tanggal('tanggal', 'calendar', old('tanggal') ?: $row->tanggal) !!}
              {!! $form->frm_text('uraian', 'file', old('uraian') ?: $row->uraian) !!}
              {!! $form->frm_select('status', 'person', ['panitia' => 'Panitia', 'pekerja' => 'Pekerja'], old('status') ?: $row->status) !!}
              {!! $form->frm_radio('metode_pembayaran', ['transfer' => 'Transfer', 'tunai' => 'Tunai'], old('metode_pembayaran') ?: $row->metode_pembayaran) !!}
              {!! $form->frm_tanggal('tanggal_mulai', 'calendar', old('tanggal_mulai') ?: $rentang->first()->tanggal_mulai) !!}
              {!! $form->frm_tanggal('tanggal_selesai', 'calendar', old('tanggal_selesai') ?: $rentang->first()->tanggal_selesai) !!}
              {!! $form->frm_file('bukti', 'image') !!}
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_update() !!}
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