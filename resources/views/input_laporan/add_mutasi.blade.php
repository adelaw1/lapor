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
              {!! $form->frm_open('/input_laporan/mutasi', true) !!}
              @csrf
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {{-- {!! $form->frm_text('no_bukti', 'paperclip', old('no_bukti') ?: $no_bukti) !!} --}}
              {!! $form->frm_tanggal('tanggal', 'calendar', old('tanggal')) !!}
              {!! $form->frm_text('uraian', 'file', old('uraian')) !!}
              {!! $form->frm_text('nominal', 'cash', old('nominal')) !!}
              {!! $form->frm_radio('mutasi', ['masuk' => 'Masuk', 'keluar' => 'Keluar', 'tarik' => 'Tarik Tunai'], old('mutasi') ?: 'masuk') !!}
              {!! $form->frm_radio('metode_pembayaran', ['transfer' => 'Transfer', 'tunai' => 'Tunai'], old('metode_pembayaran') ?: 'transfer') !!}
              {!! $form->frm_checkbox('realisasi_anggaran', ['Y' => 'Iya'], old('realisasi_anggaran')) !!}
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
                // let defaultMetodePembayaran = 'transfer';
                let defaultMutasi = 'masuk';
                const metode_pembayaran = document.querySelectorAll("input[name='metode_pembayaran']");
                const mutasi = document.querySelectorAll("input[name='mutasi']");

                // metode_pembayaran.forEach(el => {
                //   $(el).on('click', function (e) {
                //     // defaultMetodePembayaran = $(this).val();
                //     get_no_bukti();
                //   });
                // });

                mutasi.forEach(el => {
                  $(el).on('click', function (e) {
                    defaultMutasi = $(this).val();
                    get_no_bukti();
                  });
                });

                function get_no_bukti() {
                  if (defaultMutasi == 'tarik') {
                    metode_pembayaran.forEach(el => {
                      if ($(el).val() == 'transfer') {
                        $(el).prop('checked', true);
                      }
                      $(el).prop('disabled', true);
                    });
                  } else {
                    metode_pembayaran.forEach(el => {
                      $(el).prop('disabled', false);
                    });
                  }
                  // $.ajax({
                  //   url: "/input_laporan/get_no_bukti/" + defaultMutasi + "/" + defaultMetodePembayaran,
                  //   success: function (result) {
                  //     $('#no_bukti').val(result);
                  //   }
                  // });
                }
            </script>
        @endpush

</x-templates>