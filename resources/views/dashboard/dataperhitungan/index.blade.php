


 {{-- ///////////////////////////////////////////////// --}}
 
 @extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Halaman Data Perhitungan</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('data.process') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required class="form-control">
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary">Process Data</button>
                        <a href="{{ route('data.index') }}" class="btn btn-secondary">Show All</a>
                        <button class="btn btn-success" onclick="printTable()">Print</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <!-- Tabel menghitung matrix X sampai ke bawah -->
  
    <h3 class="mt-5">Menghitung Matriks (x)</h3 class="mt-5">
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Nama Alternative</th>
            @foreach ($kriterias as $kriteria)
                <th>{{ $kriteria->nm_kriteria }}</th>
            @endforeach
        </tr>
        @foreach ($alternatives as $alternative)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $alternative->nm_alternative }}</td>
                @foreach ($kriterias as $kriteria)
                    @foreach ($alternative->subKriteria as $subKriteria)
                        @if ($subKriteria->kriteria_id === $kriteria->id)
                            <td>{{ $subKriteria->nilai_subkriteria }}</td>
                        @endif
                    @endforeach
                @endforeach
            </tr>
        @endforeach
    </table>


{{-- Matik Normalisasi --}}

    <h3 class="mt-3">Matriks normalisasi</h3>

    <?php

    // Data tabel matriks X
    $dataMatrixX = [];
    foreach ($alternatives as $alternative) {
        $row = [];
        foreach ($kriterias as $kriteria) {
            foreach ($alternative->subKriteria as $subKriteria) {
                if ($subKriteria->kriteria_id === $kriteria->id) {
                    $row[] = $subKriteria->nilai_subkriteria;
                }
            }
        }
        $dataMatrixX[] = $row;
    }

    $rows = count($dataMatrixX);
    $cols = ($rows > 0) ? count($dataMatrixX[0]) : 0;

        // Menghitung matriks ternormalisasi
        $normalizedMatrix = [];
        for ($i = 0; $i < $rows; $i++) {
            $normalizedRow = [];
            for ($j = 0; $j < $cols; $j++) {
                $columnSum = 0;
                for ($k = 0; $k < $rows; $k++) {
                    $columnSum += $dataMatrixX[$k][$j] ** 2;
                }
                $denominator = sqrt($columnSum);
                $normalizedRow[] = round($dataMatrixX[$i][$j] / $denominator, 4);
            }
            $normalizedMatrix[] = $normalizedRow;
        }

    // Menampilkan matriks ternormalisasi dalam tabel
    echo '<table class="table table-striped">';
    echo '<tr>';
    echo '<th>No</th>';
    echo '<th>Nama Alternative</th>';
    foreach ($kriterias as $kriteria) {
        echo '<th>' . $kriteria->nm_kriteria . '</th>';
    }
    
    echo '</tr>';

    for ($i = 0; $i < $rows; $i++) {
        echo '<tr>';
        echo '<td>' . ($i + 1) . '</td>';
    //     foreach ($alternatives as $alt) {
    //     echo '<td>' . $alt->nm_alternative . '</td>';
    // }
        echo '<td>Alternative ' . ($i + 1) . '</td>';
        foreach ($normalizedMatrix[$i] as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';

    ?> 
{{-- ------------------------------------------------------------------------------------------------------------ --}}

 {{-- Matriks Normalisasi Terbobot --}}
 <h3>Matriks Normalisasi Terbobot</h3>
 <?php
 // Data tabel matriks X
 $dataMatrixX = [];
 foreach ($alternatives as $alternative) {
     $row = [];
     foreach ($kriterias as $kriteria) {
         foreach ($alternative->subKriteria as $subKriteria) {
             if ($subKriteria->kriteria_id === $kriteria->id) {
                 $row[] = $subKriteria->nilai_subkriteria;
             }
         }
     }
     $dataMatrixX[] = $row;
 }

 $rows = count($dataMatrixX);
 $cols = ($rows > 0) ? count($dataMatrixX[0]) : 0;

 // Menghitung matriks ternormalisasi terbobot
 $normalizedWeightedMatrix = [];
 for ($i = 0; $i < $rows; $i++) {
     $weightedRow = [];
     for ($j = 0; $j < $cols; $j++) {
         $columnSum = 0;
         for ($k = 0; $k < $rows; $k++) {
             $columnSum += $dataMatrixX[$k][$j] ** 2;
         }
         $denominator = sqrt($columnSum);
         $weightedRow[] = round($normalizedMatrix[$i][$j] * $kriterias[$j]->bobot, 4);
     }
     $normalizedWeightedMatrix[] = $weightedRow;
 }

 // Menampilkan matriks normalisasi terbobot dalam tabel
 echo '<table class="table table-striped">';
 echo '<tr>';
 echo '<th>No</th>';
 echo '<th>Nama Alternative</th>';
 foreach ($kriterias as $kriteria) {
     echo '<th>' . $kriteria->nm_kriteria . '</th>';
 }
 echo '</tr>';

 for ($i = 0; $i < $rows; $i++) {
     echo '<tr>';
     echo '<td>' . ($i + 1) . '</td>';
//      foreach ($alternatives as $alt) {
//      echo '<th>' . $alt->nm_alterntaive . '</th>';
//  }
     echo '<td>Alternative ' . ($i + 1) . '</td>';
     foreach ($normalizedWeightedMatrix[$i] as $value) {
         echo '<td>' . $value . '</td>';
     }
     echo '</tr>';
 }

 echo '</table>';

 ?>




{{-- 0000000000000000000000000000000 --}}
<!-- Tabel Nilai Yi -->
<h3>Tabel Nilai Yi</h3>
<table class="table table-striped">
    <tr>
        <th>No</th>
        <th>Nama Alternative</th>
        <th>Benefit ({{ implode(', ', $kriterias->where('jenis', 'benefit')->pluck('kode')->toArray()) }})</th>
        <th>Cost ({{ implode(', ', $kriterias->where('jenis', 'cost')->pluck('kode')->toArray()) }})</th>
        <th>Yi = Benefit - Cost  </th>
    </tr>
    @foreach ($alternatives as $alternative)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $alternative->nm_alternative }}</td>
            @php
                $benefitTotal = 0;
                $costTotal = 0;
                foreach ($alternative->subKriteria as $subKriteria) {
                    $kriteria = $subKriteria->kriteria;
                    $nilaiSubkriteria = $normalizedWeightedMatrix[$alternative->id - 1][$kriteria->id - 1];
                    if ($kriteria->jenis === 'benefit') {
                        $benefitTotal += $nilaiSubkriteria;
                    } else {
                        $costTotal += $nilaiSubkriteria;
                    }
                }
                $yi = $benefitTotal - $costTotal;
            @endphp
            <td>{{ $benefitTotal }}</td>
            <td>{{ $costTotal }}</td>
            <td>{{ $yi }}</td>
        </tr>
    @endforeach
</table>

{{-- 
id="peringkat-table --}}

{{-- Tabel Peringkat  --}}
<h3>Tabel peringkat</h3>
<table class="table table-striped"  id="peringkat-table" class="table table-striped">
        <tr>
            <th>Kode</th>
            <th>Nama Alternatif</th>
            <th>Alamat Alternatif</th>
            <th>No Telepon</th>
            <th>Total Nilai</th>
            <th>Rank</th>
        </tr>

        @php
            // Mengurutkan alternatif berdasarkan total nilai secara menurun
            $sortedAlternatives = $alternatives->sortByDesc(function($alternative) use ($normalizedWeightedMatrix) {
                $benefitTotal = 0;
                $costTotal = 0;
                foreach ($alternative->subKriteria as $subKriteria) {
                    $kriteria = $subKriteria->kriteria;
                    $nilaiSubkriteria = $normalizedWeightedMatrix[$alternative->id - 1][$kriteria->id - 1];
                    if ($kriteria->jenis === 'benefit') {
                        $benefitTotal += $nilaiSubkriteria;
                    } else {
                        $costTotal += $nilaiSubkriteria;
                    }
                }
                return $benefitTotal - $costTotal;
            });

            // Inisialisasi variabel rank
            $rank = 1;
        @endphp
        
        @foreach ($sortedAlternatives as $alternative)
        <tr>
            <td>{{ $alternative->kode_alternative  }}</td>
            <td>{{ $alternative->nm_alternative }}</td>
            <td>{{ $alternative->alamat }}</td>
            <td>{{ $alternative->no_telp }}</td>
            @php
            $benefitTotal = 0;
            $costTotal = 0;
            foreach ($alternative->subKriteria as $subKriteria) {
                $kriteria = $subKriteria->kriteria;
                $nilaiSubkriteria = $normalizedWeightedMatrix[$alternative->id - 1][$kriteria->id - 1];
                if ($kriteria->jenis === 'benefit') {
                    $benefitTotal += $nilaiSubkriteria;
                } else {
                    $costTotal += $nilaiSubkriteria;
                }
            }
            $yi = $benefitTotal - $costTotal;
            @endphp
            <td>{{ $yi }}</td>
            <td>{{ $rank }}</td>
        </tr>
        @php
            $rank++;
        @endphp
        @endforeach
    
</table>

<script>
   function printTable() {
    var printContent = document.getElementById("peringkat-table");
    var printWindow = window.open("", "_blank");
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Tabel Peringkat</title>');
    printWindow.document.write('<style>');
    printWindow.document.write(`
        /* Tambahkan gaya CSS Anda di sini */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        /* ... tambahkan gaya CSS lainnya sesuai kebutuhan Anda ... */
    `);
    printWindow.document.write('</style></head><body>');
    printWindow.document.write('<h1>Tabel Peringkat</h1>');
    printWindow.document.write(printContent.outerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>


@endsection