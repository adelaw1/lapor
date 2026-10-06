<?php

namespace App\Http\Controllers;

use App\Models\InputLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InputMutasiController extends Controller
{
    public function add_mutasi()
    {
        $data = [
            'title' => 'Input Mutasi',
            'form' => $this->form,
            'no_bukti' => $this->master->getNoBukti('masuk', 'transfer'),
        ];

        return view('input_laporan.add_mutasi', $data);
    }

    public function save_mutasi(Request $request)
    {
        $validasi = $request->validate([
            // 'no_bukti' => 'required|unique:input_laporan,no_bukti',
            'tanggal' => 'required',
            'uraian' => 'required',
            'nominal' => 'required',
            'mutasi' => 'required|in:masuk,keluar,tarik',
            'metode_pembayaran' => 'required|in:transfer,tunai',
            'bukti' => $request->bukti ? 'image|file|mimes:pdf,jpeg,jpg,png|max:1024' : '',
        ]);

        $validasi['kategori'] = 'mutasi';
        $validasi['nominal'] = str_replace('.', '', $request->nominal);
        if ($request->realisasi_anggaran) {
            $validasi['realisasi_anggaran'] = 'Y';
        }

        if ($request->bukti) {
            $bukti = $request->file('bukti')->store('bukti');
            $validasi['bukti'] = $bukti;
        }

        InputLaporan::create($validasi);
        return redirect('/input_laporan')->with($this->alert->success('Input Laporan <b>Berhasil</b> Disimpan', 'Input Laporan'));
    }

    public function edit_mutasi(InputLaporan $inputLaporan)
    {
        $data = [
            'title' => 'Edit Input Laporan',
            'form' => $this->form,
            'row' => $inputLaporan,
        ];

        return view('input_laporan.edit_mutasi', $data);
    }

    public function update_mutasi(Request $request, InputLaporan $inputLaporan)
    {
        $validasi = $request->validate([
            // 'no_bukti' => $request->no_bukti != $inputLaporan->no_bukti ? 'required|unique:input_laporan,no_bukti' : '',
            'tanggal' => 'required',
            'uraian' => 'required',
            'nominal' => 'required',
            'mutasi' => 'required|in:masuk,keluar,tarik',
            'metode_pembayaran' => 'required|in:transfer,tunai',
            'bukti' => $request->bukti ? 'image|file|mimes:pdf,jpeg,jpg,png|max:1024' : '',
        ]);

        $validasi['nominal'] = str_replace('.', '', $request->nominal);
        if ($request->realisasi_anggaran) {
            $validasi['realisasi_anggaran'] = 'Y';
        }

        if ($request->bukti) {
            if ($inputLaporan->bukti) {
                Storage::delete($inputLaporan->bukti);
            }
            $bukti = $request->file('bukti')->store('bukti');
            $validasi['bukti'] = $bukti;
        }

        $inputLaporan->update($validasi);
        return redirect('/input_laporan')->with($this->alert->success('Input Laporan <b>Berhasil</b> Diedit', 'Edit Laporan'));
    }
}
