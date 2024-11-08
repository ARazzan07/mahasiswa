<?php

namespace App\Http\Controllers;

use App\Models\Mfakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Exports\FakultasExport;
use Maatwebsite\Excel\Facades\Excel;

class Cfakultas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Mfakultas::get();
        return view ('fakultas.index', compact('fakultas'));

        

    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fakultas.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fakultas'  => 'required',
            'prodi'     => 'required',
            'kaprodi'   => 'required',
            'foto'      => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $fotoPath = $request->file('foto')->store('public/foto');
        
        Mfakultas::create([
            'fakultas'  => $request->fakultas,
            'prodi'     => $request->prodi,
            'kaprodi'   => $request->kaprodi,
            'foto'      => $fotoPath, // Simpan path gambar ke kolom foto
        ]);


        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil
disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mfakultas $mfakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fakultas = Mfakultas::findOrFail($id);
        return view('fakultas.edit', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fakultas = Mfakultas::findOrFail($id);

        $request->validate([
            'fakultas' => 'required',
            'prodi' => 'required',
            'kaprodi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('foto')) {
            if ($fakultas->foto && Storage::exists($fakultas->foto)) {
                Storage::delete($fakultas->foto);
            }
    
            $fotoPath = $request->file('foto')->store('public/foto');
            $fakultas->foto = $fotoPath;
        }

        $fakultas->update([
            'fakultas' => $request->fakultas,
            'prodi' => $request->prodi,
            'kaprodi' => $request->kaprodi,
            'foto' => $fakultas->foto,
            
        ]);

        $fakultas->save();

        return redirect()->route('fakultas.index')->with('success', 'Data fakultas berhasil
disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fakultas = Mfakultas::findOrFail($id);
        $fakultas->delete();
        return redirect()->route('fakultas.index')->with('success', 'Data siswa berhasil
diupdate');
    }

    public function exportPdfFakultas()
    {
        $datas = Mfakultas::get(); // Retrieve data for the table
    
        // Load the view and pass data
        $pdf = PDF::loadView('pdf.fakultas', compact('datas'));
    
        // Return PDF download
        return $pdf->stream('table.pdf');
    }
    
        public function exportExcel()
    {
        return Excel::download(new FakultasExport, 'table.xlsx');
    }
}
