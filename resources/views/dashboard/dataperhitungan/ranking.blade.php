{{-- ranking.blade.php --}}
<table class="table table-striped">
    <tr>
        <th>Nama Alternatif</th>
        <th>Total Nilai</th>
        <th>Rank</th>
    </tr>

    @foreach ($sortedAlternatives as $alternative)
    <tr>
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
