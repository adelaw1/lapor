<?php

namespace App\Http\Controllers;

use App\Models\Honor;
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
        return redirect('/honor')->with($this->alert->success('Honorarium <b>Berhasil</b> Ditambah', 'Tambah Honorarium'));
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
        return redirect('/honor')->with($this->alert->success('Honorarium <b>Berhasil</b> Diedit', 'Edit Honorarium'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Honor $honor)
    {
        $honor->destroy($honor->id);
        return redirect('/honor')->with($this->alert->success('Honorarium <b>Berhasil</b> Dihapus', 'Hapus Honorarium'));
    }
}
