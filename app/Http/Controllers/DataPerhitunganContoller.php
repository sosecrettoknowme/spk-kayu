<?php
// aaaaaaaaaaaaaaaa    aaaaaaaaaaaaaaaaaaaaaaaa    aaaaaaaaaaaaaaaaaaaaaaaaaa
namespace App\Http\Controllers;
use App\Models\DataPenilaian;
use App\Models\Kriteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
// use PDF;



class DataPerhitunganContoller extends Controller
{   
    public function index()
    {
        
        $penilaians = DataPenilaian::with('alternative.subKriteria')->get();
        $kriterias = Kriteria::all();
        $alternatives = $penilaians->pluck('alternative')->unique();
    
        return view('dashboard.dataperhitungan.index', compact('alternatives', 'kriterias', 'penilaians'));
    }

    // public function processData(Request $request)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     $penilaians = DataPenilaian::with('alternative.subKriteria')
    //         ->whereBetween('tanggal_penilaian', [$startDate, $endDate])
    //         ->get();

    //     $kriterias = Kriteria::all();
    //     $alternatives = $penilaians->pluck('alternative')->unique();
    //     return view('dashboard.dataperhitungan.index', compact('kriterias', 'alternatives'));
    // }

    public function processData(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $penilaians = DataPenilaian::with('alternative.subKriteria')
        ->where('tanggal_penilaian', '>=', $startDate)
        ->where('tanggal_penilaian', '<=', $endDate)
        ->get();

    $kriterias = Kriteria::all();
    $alternatives = $penilaians->pluck('alternative')->unique();
    return view('dashboard.dataperhitungan.index', compact('kriterias', 'alternatives'));
}

  



    // ...
   

    



}