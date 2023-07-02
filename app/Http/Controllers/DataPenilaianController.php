<?php

namespace App\Http\Controllers;

use App\Models\DataPenilaian;
use App\Models\Kriteria;
use App\Models\Alternative;;
use App\Http\Requests\UpdateDataPenilaianRequest;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $alternatives = Alternative::with('datapenilaian')->get();

        return view('dashboard.datapenilaian.index', compact('alternatives'));
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $alternative = Alternative::findOrFail($id);
        $subkriterias = SubKriteria::with('kriteria')->get();
        $editMode = $alternative->hasDataPenilaian();
        return view('dashboard.datapenilaian.create', compact('alternative', 'subkriterias', 'editMode'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $alternative = Alternative::findOrFail($id);
    
        // Validasi input
        $request->validate([
            'subkriteria_id' => 'required|array',
            'subkriteria_id.*' => 'exists:subkriterias,id',
        ]);
    
        // Simpan data penilaian
        foreach ($request->subkriteria_id as $subkriteriaId) {
            $dataPenilaian = new DataPenilaian();
            $dataPenilaian->alternative_id = $alternative->id;
            $dataPenilaian->subkriteria_id = $subkriteriaId;
            // Lakukan operasi penyimpanan lainnya jika ada
    

            // Set tanggal penilaian
        $dataPenilaian->tanggal_penilaian = Carbon::now();

            $dataPenilaian->save();
        }
    
        return redirect()->route('datapenilaian.index')->with('success', 'Subkriteria berhasil ditambahkan.');

    }
 
    
    /**
     * Display the specified resource.
     */
    public function show(DataPenilaian $dataPenilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataPenilaian $dataPenilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataPenilaianRequest $request, DataPenilaian $dataPenilaian)
    {
         // Validasi input
    // $request->validate([
    //     'nilai' => 'required|array',
    //     'nilai.*' => 'numeric',
    // ]);

    // // Update nilai penilaian
    // foreach ($request->nilai as $index => $nilai) {
    //     $dataPenilaian->nilai = $nilai;
    //     // Lakukan operasi penyimpanan lainnya jika ada

    //     $dataPenilaian->save();
    // }

    // return redirect()->route('datapenilaian.index')->with('success', 'Data penilaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPenilaian $dataPenilaian)
    {
        //
    }
}
