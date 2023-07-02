@extends('dashboard.layouts.main')

@section('container')
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Edit Kriteria</h1>
   </div>

  
   <div class="col-lg-8">
    <form method="post" action="/dashboard/kriteria/{{ $kriteria->id }}" class="mb-5">
     @method('put')
     @csrf
     <div class="mb-3">
       <label for="kode" class="form-label">Name Sub Kriteria</label>
       <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" required autofocus value="{{ old('kode', $kriteria->kode) }}">
       @error('kode')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
       @enderror
     </div>
     <div class="mb-3">
       <label for="nm_kriteria" class="form-label">Name Kriteria</label>
       <input type="text" class="form-control @error('nm_kriteria') is-invalid @enderror" id="nm_kriteria" name="nm_kriteria" required autofocus value="{{ old('nm_kriteria', $kriteria->nm_kriteria) }}">
       @error('nm_kriteria')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
       @enderror
     </div>
     <div class="mb-3">
       <label for="bobot" class="form-label">Bobot</label>
       <input type="text" class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot" required autofocus value="{{ old('bobot', $kriteria->bobot) }}">
       @error('bobot')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
       @enderror
     </div>
     <div class="mb-3">
       <label for="jenis" class="form-label">Name Sub Kriteria</label>
       <input type="text" class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required autofocus value="{{ old('jenis', $kriteria->jenis) }}">
       @error('jenis')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
       @enderror
     </div>
     <div class="mb-3">
       <label for="nm_subkriteria" class="form-label">Name Sub Kriteria</label>
       <input type="text" class="form-control @error('nm_subkriteria') is-invalid @enderror" id="nm_subkriteria" name="nm_subkriteria" required autofocus value="{{ old('nm_subkriteria', $kriteria->nm_subkriteria) }}">
       @error('nm_subkriteria')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
       @enderror
     </div>

     <div class="mb-3">
       <label for="nilai_subkriteria" class="form-label">Nilai Sub Kriteria</label>
       <input type="text" class="form-control  @error('nilai_subkriteria') is-invalid @enderror" id="nilai_subkriteria" name="nilai_subkriteria" required value="{{ old('nilai_subkriteria', $kriteria->nilai_subkriteria) }}">
       @error('nilai_subkriteria')
       <div class="invalid-feedback">
         {{ $message }}
       </div>
       @enderror
     </div>     
     <button type="submit" class="btn btn-primary">Update Pasien</button>
   </form>
</div>
@endsection