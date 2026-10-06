<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kegiatan',
            'row' => Kegiatan::latest()->get(),
            'form' => $this->form,
        ];

        if ($data['row']->count() > 0) {
            return view('kegiatan.update', $data);
        }

        return view('kegiatan.create', $data);
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            'nama_kegiatan' => 'required',
            'alamat' => 'required',
            'nilai_proyek' => 'required',
            'tanggal_mulai' => 'required',
            'lama_pekerjaan' => 'required',
        ]);

        $validasi['nilai_proyek'] = str_replace('.', '', $request->nilai_proyek);

        Kegiatan::create($validasi);
        return redirect('/kegiatan')->with($this->alert->success('Data Kegiatan <strong>Berhasil</strong> Disimpan', 'Simpan Data Kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validasi = $request->validate([
            'nama_kegiatan' => 'required',
            'alamat' => 'required',
            'nilai_proyek' => 'required',
            'tanggal_mulai' => 'required',
            'lama_pekerjaan' => 'required',
        ]);

        $validasi['nilai_proyek'] = str_replace('.', '', $request->nilai_proyek);

        $kegiatan->update($validasi);
        return redirect('/kegiatan')->with($this->alert->success('Data Kegiatan <strong>Berhasil</strong> Diedit', 'Edit Data Kegiatan'));
    }
}
