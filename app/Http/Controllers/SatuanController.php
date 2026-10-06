<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Satuan',
            'rows' => Satuan::latest()->get(),
        ];

        return view('satuan.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Satuan',
            'form' => $this->form,
        ];

        return view('satuan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_satuan' => 'required|unique:satuan,nama_satuan',
            'aktif' => 'required|in:Y,N',
        ]);

        Satuan::create($validasi);
        return redirect('/satuan')->with($this->alert->success('Data Satuan <b>Berhasil</b> Ditambah', 'Tambah Satuan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        $data = [
            'title' => 'Edit Data Satuan',
            'row' => $satuan,
            'form' => $this->form,
        ];

        return view('satuan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satuan $satuan)
    {
        $validasi = $request->validate([
            'nama_satuan' => $request->nama_satuan != $satuan->nama_satuan ? 'required|unique:satuan,nama_satuan' : 'required',
            'aktif' => 'required|in:Y,N',
        ]);

        $satuan->update($validasi);
        return redirect('/satuan')->with($this->alert->success('Data Satuan <b>Berhasil</b> Diedit', 'Edit Satuan'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->destroy($satuan->id);
        return redirect('/satuan')->with($this->alert->success('Data Satuan <b>Berhasil</b> Dihapus', 'Hapus Satuan'));
    }
}
