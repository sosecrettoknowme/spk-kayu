@extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Halaman Kriteria</h1>
    @if (session()->has('success'))
        <div class="alert alert-success col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="/dashboard/kriteria/create" class="btn btn-primary mb-3">Tambah Data Kriteria</a>
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Kriteria</th>
            <th>Bobot</th>
            <th>Jenis</th>
            <th>Action</th>
        </tr>
        @foreach ($kriterias as $kriteria)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kriteria->kode }}</td>
            <td>{{ $kriteria->nm_kriteria }}</td>
            <td>{{ $kriteria->bobot }}</td>
            <td>{{ $kriteria->jenis }}</td>
            <td>
                <form action="/dashboard/kriteria/{{ $kriteria->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" ></span>Hapus</button>
                </form>
              </td>
        </tr>
        @endforeach
      
    </table>
@endsection