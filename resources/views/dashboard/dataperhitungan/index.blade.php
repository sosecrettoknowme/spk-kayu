


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
                    <label for="start_date">Start Date :</label>
                    <input type="date" id="start_date" name="start_date" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="end_date">End Date :</label>
                    <input type="date" id="end_date" name="end_date" required class="form-control">
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary">Process Data</button>
                    <a href="{{ route('data.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
</div>

    
    
    <!-- Tabel menghitung matrix X sampai ke bawah -->
    <h3 class="mt-5">Menghitung Matriks (x)</h3>
    <table class="table table-striped">
        <tr>
            <th>Kode Penilaian</th>
            <th>Kode Alternative</th>
            <th>Nama Alternative</th>
            <?php foreach ($kriterias as $kriteria) : ?>
                <th><?php echo $kriteria->nm_kriteria; ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($alternatives as $alternative) : ?>
            <tr>
                <td><?php echo $alternative->dataPenilaian[0]->kode_penilaian; ?></td>
                <td><?php echo $alternative->kode_alternative; ?></td>
                <td><?php echo $alternative->nm_alternative; ?></td>
                <?php foreach ($alternative->subKriteria as $subKriteria) : ?>
                    <td><?php echo $subKriteria->nilai_subkriteria; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    
   {{-- Matik Normalisasi --}}
  {{-- Matriks normalisasi --}}
{{-- Matriks normalisasi --}}
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
// echo '<th>No</th>';
echo '<th>Kode Penilaian</th>';
echo '<th>Kode Alternative</th>';
echo '<th>Nama Alternative</th>';
foreach ($kriterias as $kriteria) {
    echo '<th>' . $kriteria->nm_kriteria . '</th>';
}
echo '</tr>';

$i = 1; // Nomor urut
foreach ($alternatives as $alternative) {
    echo '<tr>';
    // echo '<td>' . $i++ . '</td>';
    echo '<td>' . $alternative->dataPenilaian[0]->kode_penilaian . '</td>';
    echo '<td>' . $alternative->kode_alternative . '</td>';
    echo '<td>' . $alternative->nm_alternative . '</td>';

    foreach ($normalizedMatrix[$i-2] as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
?>




{{-- Matriks Normalisasi Terbobot --}}
<h3>Matriks Normalisasi Terbobot</h3>
<?php
// Menghitung matriks ternormalisasi terbobot
$normalizedWeightedMatrix = [];
for ($i = 0; $i < $rows; $i++) {
    $weightedRow = [];
    for ($j = 0; $j < $cols; $j++) {
        $columnSum = 0;
        for ($k = 0; $k < $rows; $k++) {
            $columnSum += $normalizedMatrix[$k][$j] ** 2;
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
echo '<th>Kode Penilaian</th>';
echo '<th>Kode Alternative</th>';
echo '<th>Nama Alternative</th>';
foreach ($kriterias as $kriteria) {
    echo '<th>' . $kriteria->nm_kriteria . '</th>';
}
echo '</tr>';

$i = 1; // Nomor urut
foreach ($alternatives as $alternative) {
    echo '<tr>';
    echo '<td>' . $i++ . '</td>';
    echo '<td>' .  $alternative->dataPenilaian[0]->kode_penilaian . '</td>';
    echo '<td>' . $alternative->kode_alternative . '</td>';
    echo '<td>' . $alternative->nm_alternative . '</td>';
    
    foreach ($normalizedWeightedMatrix[$i-2] as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
?>



<!-- Tabel Nilai Yi -->
<h3>Tabel Nilai Yi</h3>
<table class="table table-striped">
    <tr>
        <th>No</th>
        <th>Kode Penilaian</th>
        <th>Kode Alternative</th>
        <th>Nama Alternative</th>
        <th>Benefit ({{ implode(', ', $kriterias->where('jenis', 'benefit')->pluck('kode')->toArray()) }})</th>
        <th>Cost ({{ implode(', ', $kriterias->where('jenis', 'cost')->pluck('kode')->toArray()) }})</th>
        <th>Yi = Benefit - Cost</th>
    </tr>
    @foreach ($alternatives as $alternative)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $alternative->dataPenilaian[0]->kode_penilaian }}</td>
            <td>{{ $alternative->kode_alternative }}</td>
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




{{-- Tabel Peringkat  --}}
<h3>Tabel peringkat</h3>
<table class="table table-striped" id="peringkat-table">
    <tr>
        <th>Tanggal Penilaian</th>
        <th>Kode Penilaian</th>
        <th>Kode Alternative</th>
        <th>Nama Alternative</th>
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
        <td>{{ $alternative->dataPenilaian[0]->tanggal_penilaian }}</td>
        <td>{{ $alternative->dataPenilaian[0]->kode_penilaian }}</td>
        <td>{{ $alternative->kode_alternative }}</td>
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
        <td>{{ $yi }}</td>
        <td>{{ $rank }}</td>
    </tr>
    @php
        $rank++;
    @endphp
    @endforeach
</table>


{{-- PDF --}}
{{-- PDF --}}
<!-- Tombol Cetak -->
<button onclick="printTables()" class="btn btn-success">Cetak Tabel</button>

<!-- JavaScript untuk mencetak tabel -->
<script>
    function printTables() {
        var printContent = document.createElement('div');

        // Tanggal cetak
        var currentDate = new Date();
        var formattedDate = currentDate.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Kop
        var header = document.createElement('div');
        header.innerHTML = `
            <div style="text-align: center; padding: 20px;">
                <img src="https://i.ytimg.com/vi/edNU9WTrTgE/maxresdefault.jpg" alt="Logo" width="250" height="100">
                <br>
                <h1 style="margin: 10px 0; color: #333;">Toko Kayu Ijon Parabot</h1>
                <h1 style="margin: 10px 0; color: #333;">SPK Pemilihan Supplier Bahan Baku Kayu Terbaik</h1>
                <h2 style="margin: 5px 0; color: #555;">jln Koto Gadang Kec. Bungus Teluk Kabung Kota Padang</h2>
                <p style="margin: 2px 0; color: #777;">Telp: 123-456789 | Email: ijonkayu@gmail.com</p>
                <div style="margin-top: 10px;">
                    <a href="#" target="_blank"><img src="https://th.bing.com/th?id=OIP.WB6Ne8MAnNUxeMdq-FCm3wHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" alt="WhatsApp" width="32" height="32"></a>
                    <a href="#" target="_blank"><img src="https://th.bing.com/th/id/OIP.FeiwIhdK4TXLrzd8lVqm7wHaHa?w=218&h=218&c=7&r=0&o=5&dpr=1.2&pid=1.7" alt="Instagram" width="32" height="32"></a>
                    <a href="#" target="_blank"><img src="https://th.bing.com/th/id/OIP.P3GJZi8Z-DGPx1JS3u5yOgHaGl?w=217&h=192&c=7&r=0&o=5&dpr=1.2&pid=1.7" alt="Twitter" width="32" height="32"></a>
                </div>
            </div>
            <hr style="border-top: 2px solid #333;">
            <p style="text-align: right; margin: 0; color: #555;">${formattedDate}</p>
        `;
        printContent.appendChild(header);

        // Tabel Peringkat
        var peringkatTable = document.getElementById('peringkat-table').cloneNode(true);
        var peringkatTitle = document.createElement('h3');
        peringkatTitle.innerText = 'Tabel Peringkat';
        printContent.appendChild(peringkatTitle);
        printContent.appendChild(peringkatTable);

        // Tanda tangan dan Nama Pemilik
        var signature = document.createElement('div');
        signature.innerHTML = `
        <br>
        <br>
            <div style="text-align: center; margin-right: 400px;">
                <p style="margin: 5px 0; color: #555;">${formattedDate}</p>
                <br>
                <br>
                <br>
                <p style="margin: 5px 0; color: #555;">Ijon Putra</p>
            </div>
        `;
        printContent.appendChild(signature);

        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>IJON PARABOT</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            /* Tambahkan gaya CSS Anda di sini */
            body {
                font-family: Arial, sans-serif;
                background-image: url('https://wallpapercave.com/wp/wp6910331.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                padding: 20px;
            }
            h1, h2, h3 {
                text-align: center;
                margin: 10px 0;
            }
            p {
                text-align: center;
                margin: 5px 0;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
            }
            th, td {
                border: 1px solid #ccc;
                padding: 8px;
                text-align: left;
            }
            hr {
                margin: 10px 0;
                border: none;
                border-top: 1px dashed #ccc;
                background-color: transparent;
            }
            /* ... tambahkan gaya CSS lainnya sesuai kebutuhan Anda ... */
        `);
        printWindow.document.write('</style></head><body>');
        printWindow.document.write(printContent.innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>


@endsection