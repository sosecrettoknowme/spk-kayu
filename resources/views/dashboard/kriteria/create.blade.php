@extends('dashboard.layouts.main')

@section('container')
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Tambah Data Kriteria</h1>
   </div>

   <div class="col-lg-8">
       <form method="post" action="/dashboard/kriteria" class="mb-5">
        @csrf

            <div class="mb-3">
                    <label for="kode"  class="form-label">Kode Kriteria</label>
                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" id="kode" placeholder="Kode Kriteria" required value="{{ old('kode') }}">
                    @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>

            <div class="mb-3">
                    <label for="nm_kriteria"  class="form-label">Nama Kriteria</label>
                    <input type="text" name="nm_kriteria" class="form-control @error('nm_kriteria') is-invalid @enderror" id="nm_kriteria" placeholder="Nama Kriteria" required value="{{ old('nm_kriteria') }}">
                    @error('nm_kriteria')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                    <label for="bobot"  class="form-label">Bobot</label>
                    <input type="number" name="bobot" class="form-control @error('bobot') is-invalid @enderror" id="bobot" placeholder="Bobot" step="any" required value="{{ old('bobot') }}">
                    @error('bobot')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" name="jenis">
                        <option value="">===Pilih Jenis==</option>  
                        <option value="cost">Cost</option>  
                        <option value="benefit">Benefit</option>  
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
@endsection