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
              {!! $form->frm_open('/input_laporan/belanja_material', true) !!}
              @csrf
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {{-- {!! $form->frm_text('no_bukti', 'paperclip', old('no_bukti') ?: $no_bukti) !!} --}}
              {!! $form->frm_tanggal('tanggal', 'calendar', old('tanggal')) !!}
              {!! $form->frm_text('uraian', 'file', old('uraian')) !!}
              {!! $form->frm_radio('metode_pembayaran', ['transfer' => 'Transfer', 'tunai' => 'Tunai'], old('metode_pembayaran') ?: 'tunai') !!}
              {!! $form->frm_file('bukti', 'image') !!}

              <hr>
              <p><b>Belaja Material</b></p>
              {!! $form->frm_select('toko', 'shop', $toko, old('toko')) !!}
              
              @php
                $inputBarang = old('nama_barang', []);
                $jmlInputBarang = count($inputBarang) < 1 ? count($inputBarang) : count($inputBarang) - 1;
              @endphp
              
              <div id="material">
                @for ($ind = 0; $ind <= $jmlInputBarang; $ind++)
                  <div class="row mb-3">
                      <label class="control-label col-md-2" for="nama_barang">Barang/ Material</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="bi bi-cart4"></i>
                          </span>
                          <input type="text" class="form-control"  name="nama_barang[]" id="nama_barang" value="{{ old('nama_barang.' . $ind) }}" placeholder="Nama Barang" />
                        </div>
                        @error('nama_barang.' . $ind)
                            <span class="badge bg-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-2">
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="bi bi-at"></i>
                          </span>
                          <input type="number" class="form-control"  name="qty[]" id="qty" value="{{ old('qty.' . $ind) }}" placeholder="Qty" />
                        </div>
                        @error('qty.' . $ind)
                            <span class="badge bg-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-2">
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="bi bi-list-check"></i>
                          </span>
                          <select class="form-control" name="satuan[]" id="satuan">
                            <option value="">- Pilih Satuan -</option>
                            @foreach ($satuan as $key => $val)
                                @php
                                    $select = $key == old('satuan.' . $ind) ? "selected" : "";
                                @endphp
                                <option value="{{ $key }}" {{ $select }}>{{ $val }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('satuan.' . $ind)
                            <span class="badge bg-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-2">
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="bi bi-cash"></i>
                          </span>
                          <input type="text" class="form-control harga"  name="harga[]" id="harga" value="{{ old('harga.' . $ind) }}" placeholder="Harga Barang" />
                        </div>
                        @error('harga.' . $ind)
                            <span class="badge bg-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-1">
                        <div class="input-group">
                          <button class="btn btn-sm btn-primary" type="button" onclick="javascript:tambah_material()">
                            <i class="bi bi-plus"></i>
                          </button>
                          @if ($ind > 0)
                            <button class="btn btn-sm btn-danger" type="button" onclick="javascript:hapus_material(this)">
                              <i class="bi bi-x"></i>
                            </button>
                          @endif
                        </div>
                      </div>
                  </div>
                @endfor
              </div>              
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_save() !!}
              </div>
              {!! $form->frm_close() !!}
          </div>

        </div>

        <div id="template_material" style="display: none;">
          <div class="row mb-3">
              <label class="control-label col-md-2" for="nama_barang">Barang/ Material</label>
              <div class="col-md-3">
                <div class="input-group">
                  <span class="input-group-text">
                      <i class="bi bi-cart4"></i>
                  </span>
                  <input type="text" class="form-control"  name="nama_barang[]" id="nama_barang" value="{{ old('nama_barang.' . $ind) }}" placeholder="Nama Barang" />
                </div>
                @error('nama_barang.' . $ind)
                    <span class="badge bg-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-2">
                <div class="input-group">
                  <span class="input-group-text">
                      <i class="bi bi-at"></i>
                  </span>
                  <input type="number" class="form-control"  name="qty[]" id="qty" value="{{ old('qty.' . $ind) }}" placeholder="Qty" />
                </div>
                @error('qty.' . $ind)
                    <span class="badge bg-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-2">
                <div class="input-group">
                  <span class="input-group-text">
                      <i class="bi bi-list-check"></i>
                  </span>
                  <select class="form-control" name="satuan[]" id="satuan">
                    <option value="">- Pilih Satuan -</option>
                    @foreach ($satuan as $key => $val)
                        @php
                            $select = $key == old('satuan.' . $ind) ? "selected" : "";
                        @endphp
                        <option value="{{ $key }}" {{ $select }}>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
                @error('satuan.' . $ind)
                    <span class="badge bg-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-2">
                <div class="input-group">
                  <span class="input-group-text">
                      <i class="bi bi-cash"></i>
                  </span>
                  <input type="text" class="form-control harga"  name="harga[]" id="harga" value="{{ old('harga.' . $ind) }}" placeholder="Harga Barang" />
                </div>
                @error('harga.' . $ind)
                    <span class="badge bg-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-1">
                <div class="input-group">
                  <button class="btn btn-sm btn-primary" type="button" onclick="javascript:tambah_material()">
                    <i class="bi bi-plus"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" type="button" onclick="javascript:hapus_material(this)">
                    <i class="bi bi-x"></i>
                  </button>
                </div>
              </div>
          </div>
        </div>

        @push('scripts')
            <script>
                $(document).on('keyup', '.harga', function () {
                    let isi = $(this).val();
                    $(this).val(formatRupiah(isi));
                });

                let material = $('#material');
                let template_material = $('#template_material').html();
                console.log(material);
                function tambah_material() {
                  material.append(template_material);
                }

                function hapus_material(e) {
                  let obj = $(e).parent().parent().parent();
                  Swal.fire({
                      title: 'Apakah anda yakin?',
                      html: "Data mateiral akan <strong>Dihapus!</strong>",
                      icon: 'question',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: '<i class="bx bx-like"></i> Yakin'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          obj.remove();
                      }
                  });
                }

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