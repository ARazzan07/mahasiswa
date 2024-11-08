<?php

namespace App\Http\Controllers;

use App\Models\Mmahasiswa;
use App\Models\Mfakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Exports\TableExport;
use Maatwebsite\Excel\Facades\Excel;


class Cmahasiswa extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mmahasiswa::with('fakultas')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
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
        $request->validate([
            'nim'           => 'required',
            'nama'          => 'required',
            'foto'          => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'fakultas_id'   => 'required',
        ]);

        $fotoPath = $request->file('foto')->store('public/foto');

        Mmahasiswa::create([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'foto'          => $fotoPath,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'fakultas_id'   => $request->fakultas_id,

        ]); 

        $foto = $request->file('foto')->store('public/foto');

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

        $request->validate([
            'nim'           => 'required',
            'nama'          => 'required',
            'foto'          => 'image|mimes:jpeg,png,jpg,gif,svg',
            'jenis_kelamin' => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'fakultas_id'   => 'required',
        ]);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && Storage::exists($mahasiswa->foto)) {
                Storage::delete($mahasiswa->foto);
            }
    
            $fotoPath = $request->file('foto')->store('public/foto');
            $mahasiswa->foto = $fotoPath;
        }

        $mahasiswa->update([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'foto'          => $mahasiswa->foto,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'fakultas_id'   => $request->fakultas_id,

        ]); 

        $mahasiswa->save();

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

    
    public function exportPdf()
    {
        $datas = DB::table('mahasiswa')
        ->leftJoin('fakultas', 'mahasiswa.fakultas_id', '=', 'fakultas.id')
        ->select('mahasiswa.*', 'fakultas.fakultas','fakultas.prodi','fakultas.kaprodi')
        ->get(); // Retrieve data for the table
    
        // Load the view and pass data
        $pdf = PDF::loadView('pdf.mahasiswa', compact('datas'))->setPaper('a4', 'landscape');
    
        // Return PDF download
        return $pdf->stream('table.pdf');
    }
    
        public function exportExcel()
    {
        return Excel::download(new TableExport, 'table.xlsx');
    }

}
