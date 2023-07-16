
 @extends('dashboard.layouts.main')

 @section('container')
     <h1 class="text-center">Halaman Penilaian</h1>
     @if (session()->has('success'))
         <div class="alert alert-success col-lg-10" role="alert">
             {{ session('success') }}
         </div>
     @endif
     <form action="{{ route('datapenilaian.destroyAll') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Semua Data Penilaian</button>
    </form>
    <br>
     <table class="table table-striped">
         <tr>
             <th>No</th>
             <th>Nama Alternative</th>
             <th>Aksi</th>
         </tr>
         @foreach ($alternatives as $alternative)
         <tr>
             <td>{{ $loop->iteration }}</td>
             <td>{{ $alternative->nm_alternative }}</td>
             <td>
                <a href="{{ route('datapenilaian.create', ['id' => $alternative->id]) }}" class="btn btn-primary mb-3">Input Data Penilaian</a>
               </td>
         </tr>
         @endforeach
       
     </table>
 @endsection