<?php

namespace App\Http\Controllers;

use App\Models\Mmahasiswa;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Mmahasiswa $mmahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mmahasiswa $mmahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mmahasiswa $mmahasiswa)
    {
        //
    }
}
