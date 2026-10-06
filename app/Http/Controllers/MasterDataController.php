<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\Satuan;
use App\Models\DataPelaksana;
use App\Models\InputLaporan;
use App\Models\BelanjaMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

class MasterDataController extends Controller
{
    protected $dataPelaksana;
    protected $dataToko;
    protected $dataSatuan;
    protected $inputLaporan;

    public function __construct()
    {
        $this->dataPelaksana = DataPelaksana::with(['honor'])->orderBy('id', 'asc')->get();
        $this->dataToko = Toko::orderBy('nama_toko', 'asc')->get();
        $this->dataSatuan = Satuan::orderBy('nama_satuan', 'asc')->get();
        $this->inputLaporan = InputLaporan::get();
    }

    public function getDataPanitia()
    {
        return $this->dataPelaksana->where('honor.kategori', '=', 'panitia');
    }

    public function getDataPekerja()
    {
        return $this->dataPelaksana->where('honor.kategori', '=', 'pekerja');
    }

    public function getDataToko()
    {
        return $this->dataToko;
    }

    public function getInputLaporan()
    {
        return $this->inputLaporan;
    }

    public function getSelectionDataToko()
    {
        $data = $this->dataToko;
        $return = [];
        foreach ($data as $dt) {
            $return[$dt->id] = $dt->nama_toko;
        }

        return $return;
    }

    public function getNoBukti($mutasi, $metode_pembayaran)
    {
        $kode = "";
        if ($mutasi == 'masuk') {
            if ($metode_pembayaran == 'transfer') {
                $kode = "BKMB-";
            } else {
                $kode = "BKMT-";
            }
        } else {
            if ($metode_pembayaran == 'transfer') {
                $kode = "BKKB-";
            } else {
                $kode = "BKKT-";
            }
        }
        // $jumlah = $this->inputLaporan->where('mutasi', '=', $mutasi)->where('metode_pembayaran', '=', $metode_pembayaran);
        // $jml = ($jumlah->count() < 10 ? "00" : ($jumlah->count() < 100 ? "0" : "")) . ($jumlah->count() + 1);
        // return $mutasi == 'tarik' ? '-' : "{$kode}-{$jml}";
        return $kode;
    }

    public function getSelectionDataSatuan()
    {
        $data = $this->dataSatuan;
        $return = [];
        foreach ($data as $dt) {
            $return[$dt->id] = $dt->nama_satuan;
        }

        return $return;
    }

    public function getDataBelanjaMaterial($kode)
    {
        $data = BelanjaMaterial::where('kode', $kode)->orderBy('id', 'asc')->get();
        return $data;
    }

    public function getDataLaporanGroupBulan()
    {
        $data = InputLaporan::select(
                    DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as bulan_tahun"),
                    DB::raw("tanggal, kode, kategori, uraian, mutasi, metode_pembayaran, nominal, bukti")
                )
                ->orderBy('bulan_tahun')
                ->with(['rentang_tanggal', 'barang'])
                ->orderBy('id', 'asc')
                ->orderBy('tanggal', 'asc')
                ->get();
        return $data;
    }
}
