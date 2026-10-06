<?php

namespace App\Http\Controllers;

use App\Models\InputLaporan;
use Illuminate\Http\Request;
use App\Models\RentangTanggal;
use Carbon\Carbon;

class InputHonorPanitiaPetukangController extends Controller
{
    public function add_honor_panitia_petukang()
    {
        $data = [
            'title' => 'Input Honor Panitia / Petukang',
            'form' => $this->form,
            'no_bukti' => $this->master->getNoBukti('keluar', 'tunai'),
        ];

        return view('input_laporan.add_honor_panitia_petukang', $data);
    }

    public function save_honor_panitia_petukang(Request $request)
    {
        $validasi = $request->validate([
            // 'no_bukti' => 'required|unique:input_laporan,no_bukti',
            'tanggal' => 'required',
            'uraian' => 'required',
            'status' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'metode_pembayaran' => 'required|in:transfer,tunai',
            'bukti' => $request->bukti ? 'image|file|mimes:pdf,jpeg,jpg,png|max:1024' : '',
        ]);

        $validasi['kategori'] = 'honor_panitia_petukang';
        $validasi['mutasi'] = 'keluar';
        unset($validasi['tanggal_mulai']);
        unset($validasi['tanggal_selesai']);
        $validasi['kode'] = time();

        if ($request->bukti) {
            $bukti = $request->file('bukti')->store('bukti');
            $validasi['bukti'] = $bukti;
        }

        if ($request->status == 'panitia') {
            $validasi['nominal'] = $this->master->getDataPanitia()->sum('honor.nominal');
        } else {
            $tanggalAwal = Carbon::parse($request->tanggal_mulai);
            $tanggalAkhir = Carbon::parse($request->tanggal_selesai);
            $jumlahHari = ($tanggalAwal->diffInDays($tanggalAkhir) + 1);
            $honor = $this->master->getDataPekerja()->sum('honor.nominal');
            $validasi['nominal'] = $honor * $jumlahHari;
        }

        $rentang = [
            // 'no_bukti' => $request->no_bukti,
            'kode' => $validasi['kode'],
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ];

        InputLaporan::create($validasi);
        RentangTanggal::create($rentang);
        return redirect('/input_laporan')->with($this->alert->success('Input Laporan <b>Berhasil</b> Disimpan', 'Input Laporan'));
    }

    public function edit_honor_panitia_petukang(InputLaporan $inputLaporan)
    {
        $data = [
            'title' => 'Edit Input Laporan',
            'form' => $this->form,
            'row' => $inputLaporan,
            'rentang' => RentangTanggal::where('no_bukti', $inputLaporan->no_bukti)->get(),
        ];

        return view('input_laporan.edit_honor_panitia_petukang', $data);
    }

    public function update_honor_panitia_petukang(Request $request, InputLaporan $inputLaporan)
    {
        $validasi = $request->validate([
            // 'no_bukti' => $request->no_bukti != $inputLaporan->no_bukti ? 'required|unique:input_laporan,no_bukti' : '',
            'tanggal' => 'required',
            'uraian' => 'required',
            'status' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'metode_pembayaran' => 'required|in:transfer,tunai',
            'bukti' => $request->bukti ? 'image|file|mimes:pdf,jpeg,jpg,png|max:1024' : '',
        ]);

        unset($validasi['tanggal_mulai']);
        unset($validasi['tanggal_selesai']);

        if ($request->bukti) {
            if ($inputLaporan->bukti) {
                Storage::delete($inputLaporan->bukti);
            }
            $bukti = $request->file('bukti')->store('bukti');
            $validasi['bukti'] = $bukti;
        }

        if ($request->status == 'panitia') {
            $validasi['nominal'] = $this->master->getDataPanitia()->sum('honor.nominal');
        } else {
            $tanggalAwal = Carbon::parse($request->tanggal_mulai);
            $tanggalAkhir = Carbon::parse($request->tanggal_selesai);
            $jumlahHari = ($tanggalAwal->diffInDays($tanggalAkhir) + 1);
            $honor = $this->master->getDataPekerja()->sum('honor.nominal');
            $validasi['nominal'] = $honor * $jumlahHari;
        }

        $rentang = [
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ];

        $inputLaporan->update($validasi);
        RentangTanggal::where('kode', $inputLaporan->kode)->update($rentang);
        return redirect('/input_laporan')->with($this->alert->success('Edit Laporan <b>Berhasil</b> Diedit', 'Edit Laporan'));
    }
}
