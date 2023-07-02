@extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Tambah Subkriteria</h1>

    <form action="{{ route('dashboard.subkriteria.store', $kriteria->id) }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="nm_subkriteria" class="form-label">Nama Subkriteria</label>
            <input type="text" name="nm_subkriteria" id="nm_subkriteria" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="nilai_subkriteria" class="form-label">Nilai Subkriteria</label>
            <input type="text" name="nilai_subkriteria" id="nilai_subkriteria" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
