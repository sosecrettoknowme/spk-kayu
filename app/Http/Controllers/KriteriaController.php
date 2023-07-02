<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kriteria.index', [
            'kriterias' => Kriteria::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kriteria.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required',
            'nm_kriteria' => 'required',
            'bobot' => 'required',
            'jenis' => 'required',
            'nm_subkriteria' => '',
            'nilai_subkriteria' => ''
        ]);

        Kriteria::create($validatedData);

        return redirect('/dashboard/kriteria')->with('success', 'Data Kriteria Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        return view('dashboard.kriteria.edit', [
            'kriteria' => $kriteria
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $rules = [
            'kode' => 'required',
            'nm_kriteria' => 'required',
            'bobot' => 'required',
            'jenis' => 'required',
            'nm_subkriteria' => 'required',
            'nilai_subkriteria' => 'required'
        ];

        $validatedData = $request->validate($rules);


        Kriteria::where('id', $kriteria->id)
                ->update($validatedData);

        return redirect('/dashboard/kriteria')->with('success', 'Data Dokter Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id); // Gunakan model SubKriteria dengan benar

        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'kriteria berhasil dihapus.');

    }
}
