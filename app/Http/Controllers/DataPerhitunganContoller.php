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
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $penilaians = collect(); // Membuat koleksi kosong untuk penilaians
        $kriterias = Kriteria::all();
        $alt = Alternative::all();
        $alternatives = collect(); // Membuat koleksi kosong untuk alternatives
        $normalizedMatrix = []; // Inisialisasi matriks normalisasi
        $normalizedWeightedMatrix = []; // Inisialisasi matriks normalisasi terbobot

        if ($startDate && $endDate) {
            // Validasi inputan tanggal
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            // Ambil data penilaian berdasarkan rentang tanggal
            $penilaians = DataPenilaian::with(['alternative.subKriteria' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_penilaian', [$startDate, $endDate]);
            }])
                ->whereHas('alternative.subKriteria', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('tanggal_penilaian', [$startDate, $endDate]);
                })
                ->get();

            $alternatives = $penilaians->pluck('alternative')->unique();

            // Menghitung matriks normalisasi dan matriks normalisasi terbobot berdasarkan data penilaian yang sesuai dengan rentang tanggal
            foreach ($penilaians as $penilaian) {
                $alternative = $penilaian->alternative;
                $row = [];
                $weightedRow = [];
                foreach ($kriterias as $kriteria) {
                    $nilaiSubkriteria = $alternative->subKriteria->where('kriteria_id', $kriteria->id)->first()->nilai_subkriteria;
                    $row[] = $nilaiSubkriteria;
                    $weightedRow[] = round($nilaiSubkriteria * $kriteria->bobot, 4);
                }
                $normalizedMatrix[] = $row;
                $normalizedWeightedMatrix[] = $weightedRow;
            }
        }

        return view('dashboard.dataperhitungan.index', compact('kriterias', 'alternatives', 'penilaians', 'startDate', 'endDate', 'normalizedMatrix', 'normalizedWeightedMatrix', 'alt'));
    }

    public function processData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $alt = Alternative::all();
        // Validasi inputan tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil data penilaian berdasarkan rentang tanggal
        $penilaians = DataPenilaian::with(['alternative.subKriteria' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal_penilaian', [$startDate, $endDate]);
        }])
            ->whereHas('alternative.subKriteria', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_penilaian', [$startDate, $endDate]);
            })
            ->get();

        if ($penilaians->isEmpty()) {
            $kriterias = Kriteria::all();
           
            $alternatives = collect(); // Membuat koleksi kosong untuk alternatives

            return view('dashboard.dataperhitungan.index', compact('kriterias', 'alternatives', 'startDate', 'endDate'));
        }

        $kriterias = Kriteria::all();
        $alternatives = $penilaians->pluck('alternative')->unique();

        return view('dashboard.dataperhitungan.index', compact('kriterias', 'alternatives', 'startDate', 'endDate', 'penilaians', 'alt'));
    }
}
    
  
//  akhir


    // ...
   

    


