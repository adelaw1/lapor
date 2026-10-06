<?php

namespace App\Http\Controllers;

use App\Models\InputLaporan;
use Illuminate\Http\Request;
use App\Models\BelanjaMaterial;

class InputBelanjaMaterialController extends Controller
{
    public function add_belanja_material()
    {
        $data = [
            'title' => 'Input Belanja Material',
            'form' => $this->form,
            'no_bukti' => $this->master->getNoBukti('keluar', 'tunai'),
            'toko' => $this->master->getSelectionDataToko(),
            'satuan' => $this->master->getSelectionDataSatuan(),
        ];

        return view('input_laporan.add_belanja_material', $data);
    }

    public function save_belanja_material(Request $request)
    {
        $validasi = $request->validate([
            // 'no_bukti' => 'required|unique:input_laporan,no_bukti',
            'tanggal' => 'required',
            'uraian' => 'required',
            'metode_pembayaran' => 'required|in:transfer,tunai',
            'bukti' => $request->bukti ? 'image|file|mimes:pdf,jpeg,jpg,png|max:1024' : '',
            'toko' => 'required',
            'nama_barang.*' => 'required',
            'qty.*' => 'required',
            'satuan.*' => 'required',
            'harga.*' => 'required',
        ], [
            'nama_barang.*' => 'Nama barang wajib diisi',
            'qty.*' => 'Qty wajib diisi',
            'satuan.*' => 'Satuan wajib diisi',
            'harga.*' => 'Harga wajib diisi',
        ]);

        $validasi['kategori'] = 'belanja_material';
        $validasi['mutasi'] = 'keluar';
        unset($validasi['toko']);
        $validasi['toko_id'] = $request->toko;
        unset($validasi['nama_barang.*']);
        unset($validasi['qty.*']);
        unset($validasi['satuan.*']);
        unset($validasi['harga.*']);
        $validasi['kode'] = time();

        if ($request->bukti) {
            $bukti = $request->file('bukti')->store('bukti');
            $validasi['bukti'] = $bukti;
        }

        $listBarang = [];
        $total = 0;
        if ($request->nama_barang) {
            $start = 0;
            foreach ($request->nama_barang as $barang) {
                $harga = intval(str_replace('.', '', $request->harga[$start]));
                array_push($listBarang, [
                    // 'no_bukti' => $request->no_bukti,
                    'kode' => $validasi['kode'],
                    'nama_barang' => $barang,
                    'qty' => $request->qty[$start],
                    'satuan_id' => $request->satuan[$start],
                    'harga' => $harga,
                ]);
                $total += ($request->qty[$start] * $harga);
                $start++;
            }
        }

        $validasi['nominal'] = $total;
        InputLaporan::create($validasi);
        BelanjaMaterial::insert($listBarang);
        return redirect('/input_laporan')->with($this->alert->success('Input Laporan <b>Berhasil</b> Disimpan', 'Input Laporan'));
    }

    public function edit_belanja_material(InputLaporan $inputLaporan)
    {
        $data = [
            'title' => 'Edit Input Laporan',
            'form' => $this->form,
            'row' => $inputLaporan,
            'toko' => $this->master->getSelectionDataToko(),
            'satuan' => $this->master->getSelectionDataSatuan(),
            'barang' => $this->master->getDataBelanjaMaterial($inputLaporan->kode),
        ];

        return view('input_laporan.edit_belanja_material', $data);
    }

    public function update_belanja_material(Request $request, InputLaporan $inputLaporan)
    {
        $validasi = $request->validate([
            // 'no_bukti' => $request->no_bukti != $inputLaporan->no_bukti ? 'required|unique:input_laporan,no_bukti' : '',
            'tanggal' => 'required',
            'uraian' => 'required',
            'bukti' => $request->bukti ? 'image|file|mimes:pdf,jpeg,jpg,png|max:1024' : '',
            'toko' => 'required',
            'nama_barang.*' => 'required',
            'qty.*' => 'required',
            'satuan.*' => 'required',
            'harga.*' => 'required',
        ], [
            'nama_barang.*' => 'Nama barang wajib diisi',
            'qty.*' => 'Qty wajib diisi',
            'satuan.*' => 'Satuan wajib diisi',
            'harga.*' => 'Harga wajib diisi',
        ]);
        
        unset($validasi['toko']);
        $validasi['toko_id'] = $request->toko;
        unset($validasi['nama_barang.*']);
        unset($validasi['qty.*']);
        unset($validasi['satuan.*']);
        unset($validasi['harga.*']);

        if ($request->bukti) {
            if ($inputLaporan->bukti) {
                Storage::delete($inputLaporan->bukti);
            }
            $bukti = $request->file('bukti')->store('bukti');
            $validasi['bukti'] = $bukti;
        }

        $listBarang = [];
        $total = 0;
        if ($request->nama_barang) {
            $start = 0;
            foreach ($request->nama_barang as $barang) {
                $harga = intval(str_replace('.', '', $request->harga[$start]));
                array_push($listBarang, [
                    // 'no_bukti' => $request->no_bukti,
                    'kode' => $inputLaporan->kode,
                    'nama_barang' => $barang,
                    'qty' => $request->qty[$start],
                    'satuan_id' => $request->satuan[$start],
                    'harga' => $harga,
                ]);
                $total += ($request->qty[$start] * $harga);
                $start++;
            }
        }

        $validasi['nominal'] = $total;
        $inputLaporan->update($validasi);
        BelanjaMaterial::where('kode', $inputLaporan->kode)->delete();
        BelanjaMaterial::insert($listBarang);
        return redirect('/input_laporan')->with($this->alert->success('Edit Laporan <b>Berhasil</b> Diedit', 'Edit Laporan'));
    }
}
