@extends('dashboard.layouts.main')
<style>
  body {
   background-image: url('https://www.pexels.com/photo/gray-and-white-wallpaper-1103970/'); /* Ganti 'nama-file-gambar.png' dengan path atau URL ke gambar latar belakang Anda */
   background-size: cover; /* Untuk memastikan gambar latar belakang mencakup seluruh area body */
 }
 .gambar {
  height: 100vh;
 }
</style>
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2 text-center">Welcome Back. {{ auth()->user()->name }}</h1>
</div>
<div class="container-fluid">
  <img src="/images/d1.jpg" class="img-fluid gambar" alt="...">
</div>
@endsection