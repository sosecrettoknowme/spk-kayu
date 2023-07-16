{{-- 
@extends('dashboard.layouts.main')

@section('container')

    <h1 class="text-center">Halaman Tambah Data Penilaian</h1>
    <p class="text-center">Alternative dinilai pada: {{ $alternative->datapenilaian->created_at->format('Y-m-d') }}</p>
    <form action="{{ route('dashboard.datapenilaian.store', $alternative->id) }}" method="POST">
        @csrf

        @php
            $kriteriaIds = [];
        @endphp

        @foreach ($subkriterias as $subkriteria)
            @if (!in_array($subkriteria->kriteria->id, $kriteriaIds))
                @php
                    $kriteriaIds[] = $subkriteria->kriteria->id;
                @endphp

                <div class="mb-3">
                    <label for="{{ $subkriteria->kriteria->id }}" class="form-label">
                        {{ $subkriteria->kriteria->kode . ' ' . $subkriteria->kriteria->nm_kriteria }}
                    </label>
                    <select class="form-select" name="subkriteria_id[]">
                        @foreach ($subkriteria->kriteria->subkriteria as $subkriteriaItem)
                            <option value="{{ $subkriteriaItem->id }}">{{ $subkriteriaItem->nm_subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        @endforeach

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
@endsection --}}

@extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Halaman Tambah Data Penilaian</h1>
    {{-- @if ($alternative->datapenilaian)
        <p class="text-center">Alternative dinilai pada: {{ $alternative->datapenilaian->created_at->format('Y-m-d') }}</p>
    @else
        <p class="text-center">Tekan Tombol Submit Maka Tanggal Penilaian Di Isi Secara Otomatis</p>
    @endif --}}
    <form action="{{ route('dashboard.datapenilaian.store', $alternative->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_penilaian" class="form-label">Kode Penilaian</label>
            <input type="text" class="form-control" id="kode_penilaian" name="kode_penilaian">
        </div>
        @php
            $kriteriaIds = [];
        @endphp

        @foreach ($subkriterias as $subkriteria)
            @if (!in_array($subkriteria->kriteria->id, $kriteriaIds))
                @php
                    $kriteriaIds[] = $subkriteria->kriteria->id;
                @endphp

                <div class="mb-3">
                    <label for="{{ $subkriteria->kriteria->id }}" class="form-label">
                        {{ $subkriteria->kriteria->kode . ' ' . $subkriteria->kriteria->nm_kriteria }}
                    </label>
                    <select class="form-select" name="subkriteria_id[]">
                        @foreach ($subkriteria->kriteria->subkriteria as $subkriteriaItem)
                            <option value="{{ $subkriteriaItem->id }}">{{ $subkriteriaItem->nm_subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        @endforeach

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
@endsection

