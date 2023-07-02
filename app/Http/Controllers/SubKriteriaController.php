<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


            $kriterias = Kriteria::with('subkriteria')->get();

            return view('dashboard.subkriteria.index', compact('kriterias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $kriteria = Kriteria::findOrFail($id);

        return view('dashboard.subkriteria.create', compact('kriteria'));
    }

    public function store(Request $request, $id)
    {
        // Validasi input subkriteria
        $request->validate([
            'nm_subkriteria' => 'required',
            'nilai_subkriteria' => 'required',
        ]);

        // Simpan subkriteria ke dalam database
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->subkriteria()->create([
            'nm_subkriteria' => $request->nm_subkriteria,
            'nilai_subkriteria' => $request->nilai_subkriteria,
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubKriteria $subKriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subKriteria = SubKriteria::findOrFail($id); // Gunakan model SubKriteria dengan benar

        $subKriteria->delete();

        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil dihapus.');
    }
}   
