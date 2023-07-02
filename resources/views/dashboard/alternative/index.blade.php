@extends('dashboard.layouts.main')

@section('container')
    <h1 class="text-center">Halaman Alternative</h1>
    @if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
        {{ session('success') }}
    </div>
  @endif
  <a href="/dashboard/alternative/create" class="btn btn-primary mb-3">Tambah Data Alternative</a>

    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th class="text-center">Nama Alternative</th>
            <th>Alamat Alternative</th>
            <th>No Telepon</th>
            <th>Action</th>
        </tr>
        @foreach ($alternatives as $alt)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $alt->nm_alternative }}</td>
            <td>{{ $alt->alamat }}</td>
            <td>{{ $alt->no_telp }}</td>
            <td>
                {{-- <a href="/alternative/{{ $alt->id }}" class="badge bg-info text-dark"><span data-feather="eye">Detail</span></a> --}}
                {{-- <a href="/dashboard/alternative/{{ $alt->id }}/edit" class="badge bg-warning text-dark"><span data-feather="edit">Edit</span></a> --}}
                <form action="/dashboard/alternative/{{ $alt->id }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle" ></span>Hapus</button>
              </form>
              </td>
        </tr>
        @endforeach
      
    </table>
@endsection