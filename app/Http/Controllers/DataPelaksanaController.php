<?php

namespace App\Http\Controllers;

use App\Models\DataPelaksana;
use Illuminate\Http\Request;
use App\Models\Honor;
use App\Models\InputLaporan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataPelaksanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Pelaksana',
            'rows' => DataPelaksana::latest()->get(),
        ];

        return view('data_pelaksana.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pelaksana',
            'form' => $this->form,
            'jabatan' => $this->getDataHonor(),
        ];

        return view('data_pelaksana.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tanda_tangan' => $request->tanda_tangan ? 'image|file|mimes:png|max:1024' : '',
        ]);

        unset($validasi['jabatan']);
        $validasi['honor_id'] = $request->jabatan;
        $validasi['nip'] = $request->nip;
        if ($request->tanda_tangan) {
            $ttd = $request->file('tanda_tangan')->store('tanda_tangan');
            $validasi['ttd'] = $ttd;
        }

        DataPelaksana::create($validasi);
        return redirect('/data_pelaksana')->with($this->alert->success('Data Pelaksana <b>Berhasil</b> Ditambah', 'Tambah Data Pelaksana'))
                                        ->with('update_laporan', $request->jabatan);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataPelaksana $dataPelaksana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPelaksana $dataPelaksana)
    {
        $data = [
            'title' => 'Edit Data Pelaksana',
            'form' => $this->form,
            'row' => $dataPelaksana,
            'jabatan' => $this->getDataHonor(),
        ];

        return view('data_pelaksana.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataPelaksana $dataPelaksana)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tanda_tangan' => $request->tanda_tangan ? 'image|file|mimes:png|max:1024' : '',
        ]);

        unset($validasi['jabatan']);
        $validasi['honor_id'] = $request->jabatan;
        $validasi['nip'] = $request->nip;
        if ($request->tanda_tangan) {
            if ($dataPelaksana->ttd) {
                Storage::delete($dataPelaksana->ttd);
            }
            $ttd = $request->file('tanda_tangan')->store('tanda_tangan');
            $validasi['ttd'] = $ttd;
        }

        $dataPelaksana->update($validasi);
        return redirect('/data_pelaksana')->with($this->alert->success('Data Pelaksana <b>Berhasil</b> Diedit', 'Edit Data Pelaksana'))
                                    ->with('update_laporan', $request->jabatan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPelaksana $dataPelaksana)
    {
        if ($dataPelaksana->ttd) {
            Storage::delete($dataPelaksana->ttd);
        }
        $id = $dataPelaksana->honor_id;
        $dataPelaksana->destroy($dataPelaksana->id);
        return redirect('/data_pelaksana')->with($this->alert->success('Data Pelaksana <b>Berhasil</b> Dihapus', 'Hapus Data Pelaksana'))
                                        ->with('update_laporan', $id);
    }

    private function getDataHonor()
    {
        $honor = Honor::where('aktif', '=', 'Y')->orderBy('id', 'asc')->get();
        $return = [];
        foreach ($honor as $h) {
            $return[$h->id] = $h->jabatan;
        }

        return $return;
    }

    public function updateInputLaporan(Request $request): void
    {
        $honor = Honor::findOrFail($request->id);
        $statusTarget = $honor->kategori;
        if ($statusTarget == 'panitia') {
            $nominal = $this->master->getDataPanitia()->sum('honor.nominal');
            InputLaporan::where('kategori', '=', 'honor_panitia_petukang')
                    ->where('status', '=', 'panitia')
                    ->update(['nominal' => $nominal]);
        } else {
            $data = $this->master->getInputLaporan()
            ->filter(function ($item) {
                return $item->kategori === 'honor_panitia_petukang' && $item->status === 'pekerja';
            });
            $update = [];
            foreach ($data as $dt){
                $mulai = $dt->rentang_tanggal->tanggal_mulai;
                $selesai = $dt->rentang_tanggal->tanggal_selesai;
                $mulai = Carbon::parse($mulai);
                $selesai = Carbon::parse($selesai);
                $jmlHari = $mulai->diffInDays($selesai) + 1;
                $nominal = $this->master->getDataPekerja()->sum('honor.nominal');
                array_push($update, [
                    'id' => $dt->id,
                    'nominal' => ($jmlHari * $nominal),
                ]);

            }
                
            foreach ($update as $up) {
                InputLaporan::where('id', $up['id'])->update(['nominal' => $up['nominal']]);
            }
        }
    }
}
