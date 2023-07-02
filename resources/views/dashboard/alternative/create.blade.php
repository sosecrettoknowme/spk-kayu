@extends('dashboard.layouts.main')

@section('container')
   <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Tambah Alternative</h1>
   </div>

   <div class="col-lg-8">
       <form method="post" action="/dashboard/alternative" class="mb-5">
        @csrf

            <div class="mb-3">
                    <label for="nm_alternative"  class="form-label">Kode Alternative</label>
                    <input type="text" name="kode_alternative" class="form-control @error('kode_alternative') is-invalid @enderror" id="kode_alternative" placeholder="Kode Alternative" required value="{{ old('kode_alternative') }}">
                    @error('kode_alternative')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
            <div class="mb-3">
                    <label for="nm_alternative"  class="form-label">Nama Alternative</label>
                    <input type="text" name="nm_alternative" class="form-control @error('nm_alternative') is-invalid @enderror" id="nm_alternative" placeholder="Nama Alternative" required value="{{ old('nm_alternative') }}">
                    @error('nm_alternative')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
            <div class="mb-3">
                <label for="alamat"  class="form-label">Alamat Alternative</label>
                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat Alternative" required value="{{ old('alamat') }}">
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
        </div>
            <div class="mb-3">
                    <label for="no_telp"  class="form-label">No Telepon  Alternative</label>
                    <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="No Telepon Alternative" required value="{{ old('no_telp') }}">
                    @error('no_telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
            </div>
         
                <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
@endsection