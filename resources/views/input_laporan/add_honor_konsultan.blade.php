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
              {!! $form->frm_open('/input_laporan/honor_konsultan', true) !!}
              @csrf
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {{-- {!! $form->frm_text('no_bukti', 'paperclip', old('no_bukti') ?: $no_bukti) !!} --}}
              {!! $form->frm_tanggal('tanggal', 'calendar', old('tanggal')) !!}
              {!! $form->frm_text('uraian', 'file', old('uraian')) !!}
              {!! $form->frm_text('nominal', 'cash', old('nominal')) !!}
              {!! $form->frm_radio('metode_pembayaran', ['transfer' => 'Transfer', 'tunai' => 'Tunai'], old('metode_pembayaran') ?: 'tunai') !!}
              {!! $form->frm_file('bukti', 'image') !!}
    
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
                // const metode_pembayaran = document.querySelectorAll("input[name='metode_pembayaran']");
                // metode_pembayaran.forEach(el => {
                //   $(el).on('click', function (dt) {
                //     let isi = $(this).val();
                //     $.ajax({
                //       url: "/input_laporan/get_no_bukti/keluar/" + isi,
                //       success: function (result) {
                //         $('#no_bukti').val(result);
                //       }
                //     })
                //   });
                // });
            </script>
        @endpush

</x-templates>