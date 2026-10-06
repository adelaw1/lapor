<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data Toko',
            'rows' => Toko::latest()->get(),
        ];

        return view('toko.main', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Toko',
            'form' => $this->form,
        ];

        return view('toko.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_toko' => 'required|unique:toko,nama_toko',
            'aktif' => 'required|in:Y,N',
        ]);

        Toko::create($validasi);
        return redirect('/toko')->with($this->alert->success('Data Toko <b>Berhasil</b> Ditambah', 'Tambah Data Toko'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Toko $toko)
    {
        $data = [
            'title' => 'Edit Data Toko',
            'row' => $toko,
            'form' => $this->form,
        ];

        return view('toko.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Toko $toko)
    {
        $validasi = $request->validate([
            'nama_toko' => ($request->nama_toko != $toko->nama_toko) ? 'required|unique:toko,nama_toko' : 'required',
            'aktif' => 'required|in:Y,N',
        ]);

        $toko->update($validasi);
        return redirect('/toko')->with($this->alert->success('Data Toko <b>Berhasil</b> Diedit', 'Edit Data Toko'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Toko $toko)
    {
        $toko->destroy($toko->id);
        return redirect('/toko')->with($this->alert->success('Data Toko <b>Berhasil</b> Dihapus', 'Hapus Data Toko'));
    }
}
