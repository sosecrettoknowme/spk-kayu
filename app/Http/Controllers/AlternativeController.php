<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAlternativeRequest;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.alternative.index', [
            'alternatives' => Alternative::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.alternative.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'kode_alternative' => 'required',
           'nm_alternative' => 'required',
           'alamat' => 'required',
           'no_telp' => 'required'
         
        ]);

        Alternative::create($validatedData);

        return redirect('/dashboard/alternative')->with('success', 'Data Kriteria Baru Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlternativeRequest $request, Alternative $alternative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subKriteria = Alternative::findOrFail($id); // Gunakan model SubKriteria dengan benar

        $subKriteria->delete();

        return redirect()->route('alternative.index')->with('success', 'Alternative berhasil dihapus.');
    
    }
}
