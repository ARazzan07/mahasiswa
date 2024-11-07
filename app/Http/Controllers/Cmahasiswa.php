<?php

namespace App\Http\Controllers;

use App\Models\Mmahasiswa;
use App\Models\Mfakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cmahasiswa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = DB::table('mahasiswa')
            ->leftJoin('fakultas', 'mahasiswa.fakultas_id', '=', 'fakultas.id')
            ->select('mahasiswa.*', 'fakultas.fakultas','fakultas.prodi','fakultas.kaprodi')
            ->get();
            return view ('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Mfakultas::all();
        return view('mahasiswa.tambah', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Mmahasiswa::create([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'fakultas_id'   => $request->fakultas_id,

        ]); 

        return redirect()->route('mahasiswa.index')->with('status', ['judul' => 'Berhasil', 'pesan' =>'Data berhasil disimpan', 'icon' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mmahasiswa $mmahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fakultas = Mfakultas::all();
        $mahasiswa = Mmahasiswa::where('id', $id)->first();
        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mahasiswa = Mmahasiswa::findOrFail($id);

        $mahasiswa->update([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'fakultas_id'   => $request->fakultas_id,

        ]); 

        return redirect()->route('mahasiswa.index')->with('status', ['judul' => 'Berhasil', 'pesan' =>'Data berhasil disimpan', 'icon' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mmahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data siswa berhasil
diupdate');
    }
}
