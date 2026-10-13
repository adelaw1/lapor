<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputLaporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\BelanjaMaterial;
use App\Models\RentangTanggal;

class InputLaporanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Input Laporan',
            'rows' => InputLaporan::orderBy('tanggal', 'desc')
                    ->orderBy('id', 'desc')
                    ->with(['toko'])
                    ->get(),
            'frm' => new Carbon,
            'master' => $this->master,
        ];

        return view('input_laporan.main', $data);
    }

    public function destroy(InputLaporan $inputLaporan)
    {
        if ($inputLaporan->bukti) {
            Storage::delete($inputLaporan->bukti);
        }

        $belanja = BelanjaMaterial::where('kode', '=', $inputLaporan->kode)->delete();
        $rentang = RentangTanggal::where('kode', '=', $inputLaporan->kode)->delete();
        $inputLaporan->destroy($inputLaporan->id);
        return redirect('/input_laporan')->with($this->alert->success('Input Laporan <b>Berhasil</b> Dihapus', 'Hapus Laporan'));
    }

    public function get_no_bukti(Request $request)
    {
        return $this->master->getNoBukti($request->mutasi, $request->metode_pembayaran);
    }
}
