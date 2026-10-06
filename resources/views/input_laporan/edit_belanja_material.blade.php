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
              {!! $form->frm_open('/input_laporan/belanja_material/' . $row->id, true) !!}
              @csrf
              @method('put')
              {!! $form->push_error($errors) !!}
              {!! $form->set_size(2, 10) !!}
    
              {{-- {!! $form->frm_text('no_bukti', 'paperclip', old('no_bukti') ?: $row->no_bukti, ['readonly' => 'readonly']) !!} --}}
              {!! $form->frm_tanggal('tanggal', 'calendar', old('tanggal') ?: $row->tanggal) !!}
              {!! $form->frm_text('uraian', 'file', old('uraian') ?: $row->uraian) !!}
              {!! $form->frm_radio('metode_pembayaran', ['transfer' => 'Transfer', 'tunai' => 'Tunai'], old('metode_pembayaran') ?: $row->metode_pembayaran) !!}
              {!! $form->frm_file('bukti', 'image') !!}

              <hr>
              <p><b>Belaja Material</b></p>
              {!! $form->frm_select('toko', 'shop', $toko, old('toko') ?: $row->toko_id) !!}

              @php
                $inputBarang = old('nama_barang', []);
                $jmlInputBarang = count($inputBarang);
              @endphp

              <div id="material">
                @php $ind = 1; @endphp
                @if ($jmlInputBarang < 1)
                  @foreach ($barang as $brg)
                    <div class="row mb-3">
                      <label class="control-label col-md-2" for="nama_barang">Barang/ Material</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="bi bi-cart4"></i>
                          </span>
                          <input type="text" class="form-control"  name="nama_barang[]" id="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang') ?: $brg->nama_barang }}" required />
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
                          <input type="number" class="form-control"  name="qty[]" id="qty" value="{{ old('qty') ?: $brg->qty }}" placeholder="Qty" required />
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
                          <select class="form-control" name="satuan[]" id="satuan" required>
                            <option value="">- Pilih Satuan -</option>
                            @foreach ($satuan as $key => $val)
                                @php
                                  $select = $key == $brg->satuan_id ? "selected" : "";
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
                          <input type="text" class="form-control harga"  name="harga[]" id="harga" value="{{ old('harga') ?: number_format($brg->harga, 0, ',', '.') }}" placeholder="Harga Barang" required />
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
                          @if ($ind > 1)
                            <button class="btn btn-sm btn-danger" type="button" onclick="hapus_material(this)">
                              <i class="bi bi-x"></i>
                            </button>
                          @endif
                        </div>
                      </div>
                  </div>
                  @php $ind++; @endphp
                  @endforeach
                @else
                  @for ($ind = 0; $ind <= $jmlInputBarang - 1; $ind++)
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
                  @endfor
                @endif
              </div>
    
              <div class="row" style="text-align: right;">
                  {!! $form->btn_update() !!}
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
            </script>
        @endpush

</x-templates>