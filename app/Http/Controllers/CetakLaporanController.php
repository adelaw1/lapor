<?php

namespace App\Http\Controllers;

use App\Models\InputLaporan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Carbon\CarbonPeriod;

class CetakLaporanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Cetak Laporan',
        ];

        return view('cetak_laporan.main', $data);
    }

    public function cetak_bku()
    {
        $data = [
            'format' => new Carbon,
            // 'laporan' => $this->master->getDataLaporanGroupBulan(),
            'master' => $this->master,
        ];

        $paperF4 = [0, 0, 609.45, 935.43];

        $pdf = Pdf::loadView('cetak_laporan.bku', $data);
        $pdf->setPaper($paperF4, 'landscape');
        return $pdf->stream('buku_kas_umum.pdf');
    }

    public function cetak_bb()
    {
        $data = [
            'format' => new Carbon,
            // 'laporan' => $this->master->getDataLaporanGroupBulan()->where('metode_pembayaran', '=', 'transfer'),
            'master' => $this->master,
        ];

        $paperF4 = [0, 0, 609.45, 935.43];

        $pdf = Pdf::loadView('cetak_laporan.bb', $data);
        $pdf->setPaper($paperF4, 'landscape');
        return $pdf->stream('buku_bank.pdf');
    }

    public function cetak_bkt()
    {
        $data = [
            'format' => new Carbon,
            // 'laporan' => $this->master->getDataLaporanGroupBulan()
            //             ->filter(function ($item) {
            //                 return $item->mutasi === 'tarik' || $item->metode_pembayaran === 'tunai';
            //             }),
            'master' => $this->master,
        ];

        $paperF4 = [0, 0, 609.45, 935.43];

        $pdf = Pdf::loadView('cetak_laporan.bkt', $data);
        $pdf->setPaper($paperF4, 'landscape');
        return $pdf->stream('buku_kas_tunai.pdf');
    }

    public function cetak_daftar_hadir(Request $request)
    {
        $data = [
            'status' => $request->status,
            'format' => new Carbon,
            'laporan' => ($request->status == 'panitia' ? 
            $this->master->getInputLaporan()
            ->filter(function ($item) {
                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'panitia';
            }) :
            $this->master->getInputLaporan()
            ->filter(function ($item) {
                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'pekerja';
            })),
            'pelaksana' => ($request->status == 'panitia' ? $this->master->getDataPanitia() : $this->master->getDataPekerja()),
            'periode' => new CarbonPeriod,
        ];

        $paperF4 = [0, 0, 609.45, 935.43];

        $pdf = Pdf::loadView('cetak_laporan.daftar_hadir', $data);
        $pdf->setPaper($paperF4, 'landscape');
        return $pdf->stream('daftar_hadir.pdf');
    }

    public function cetak_honorarium(Request $request)
    {
        $data = [
            'status' => $request->status,
            'format' => new Carbon,
            'laporan' => ($request->status == 'panitia' ? 
            $this->master->getInputLaporan()
            ->filter(function ($item) {
                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'panitia';
            }) :
            $this->master->getInputLaporan()
            ->filter(function ($item) {
                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'pekerja';
            })),
            'pelaksana' => ($request->status == 'panitia' ? $this->master->getDataPanitia() : $this->master->getDataPekerja()),
            'periode' => new CarbonPeriod,
        ];

        $paperF4 = [0, 0, 609.45, 935.43];

        $pdf = Pdf::loadView('cetak_laporan.honorarium', $data);
        $pdf->setPaper($paperF4, 'landscape');
        return $pdf->stream('honorarium.pdf');
    }
}
