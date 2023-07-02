{{-- @extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Halaman Sub Kriteria</h1>

    <h2>{{ $kriteria->kode }}</h2>

    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Nama Sub Kriteria</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
        @foreach ($kriteria->subkriteria as $subkriteria)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subkriteria->nm_subkriteria }}</td>
                <td>{{ $subkriteria->nilai_subkriteria }}</td>
                <td>Aksinya</td>
            </tr>
        @endforeach
    </table>
@endsection --}}

@extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Halaman Sub Kriteria</h1>
    @if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
        {{ session('success') }}
    </div>
  @endif
    @foreach ($kriterias as $kriteria)
        <h2>{{ $kriteria->kode .' '. $kriteria->nm_kriteria }}</h2>
<a href="{{ route('subkriteria.create', ['id' => $kriteria->id]) }}" class="btn btn-primary mb-3 ">Tambah Data</a>
        <table class="table table-striped mb-5">
            <tr>
                <th>No</th>
                <th>Nama Sub Kriteria</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
            @foreach ($kriteria->subkriteria as $subkriteria)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subkriteria->nm_subkriteria }}</td>
                    <td>{{ $subkriteria->nilai_subkriteria }}</td>
                    <td>
                        <form action="{{ route('subkriteria.destroy', $subkriteria->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus subkriteria ini?')" class="btn btn-danger rounded-circle">Hapus</button>
                        </form>
                        
                        
                    </td>
                </tr>
            @endforeach
        </table>
    @endforeach
@endsection

