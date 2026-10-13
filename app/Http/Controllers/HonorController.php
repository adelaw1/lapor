<?php

namespace App\Http\Controllers;

use App\Models\Honor;
use App\Models\InputLaporan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Honorarium',
            'rows' => Honor::latest()->get(),
        ];

        return view('honor.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Honorarium',
            'form' => $this->form,
        ];

        return view('honor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'kategori' => 'required',
            'jabatan' => 'required',
            'nominal' => 'required',
            'aktif' => 'required|in:Y,N',
        ]);

        $validasi['nominal'] = str_replace('.', '', $request->nominal);

        Honor::create($validasi);
        return redirect('/honor')->with($this->alert->success('Honorarium <b>Berhasil</b> Ditambah', 'Tambah Honorarium'))
                                ->with('update_laporan', $request->kategori);
    }

    /**
     * Display the specified resource.
     */
    public function show(Honor $honor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Honor $honor)
    {
        $data = [
            'title' => 'Edit Honorarium',
            'row' => $honor,
            'form' => $this->form,
        ];

        return view('honor.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Honor $honor)
    {
        $validasi = $request->validate([
            'kategori' => 'required',
            'jabatan' => 'required',
            'nominal' => 'required',
            'aktif' => 'required|in:Y,N',
        ]);

        $validasi['nominal'] = str_replace('.', '', $request->nominal);

        $honor->update($validasi);
        return redirect('/honor')->with($this->alert->success('Honorarium <b>Berhasil</b> Diedit', 'Edit Honorarium'))
                                    ->with('update_laporan', $request->kategori);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Honor $honor)
    {
        $kategori = $honor->kategori;
        $honor->destroy($honor->id);
        return redirect('/honor')->with($this->alert->success('Honorarium <b>Berhasil</b> Dihapus', 'Hapus Honorarium'))
                                ->with('update_laporan', $kategori);
    }

    public function updateInputLaporan(Request $request): void
    {
        if ($request->kategori == 'panitia') {
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
