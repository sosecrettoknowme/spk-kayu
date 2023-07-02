@extends('layouts.main')


@section('container')
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Jumbotron example · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
<img src="https://th.bing.com/th?id=OIP.9Kfei8YNK4k-AGqCxbjNFAHaCx&w=350&h=131&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" style="width: 100px">
        <p class="fs-4">SPK Pemilihan Supplier Bahan Baku Kayu Terbaik  </p>
      </a>
        <p class="fs-4" style="margin-left: 100px">Pada Toko Kayu Ijon Parabot Di Bungus Teluk Kabung </p>
    </header>

    <<div class="container">
        <div class="row justify-content-center ">
          <div class="col-md-10 ">
            <div class="p-3 mb-4 bg-light rounded-3">
              <div class="container-fluid py-3 ">
                <h1 class="display-5 fw-bold">Metode Yang Digunakan :</h1>
                <h3 class="fw-bold">MOORA</h3>
                <p class="fs-8">
                  Metode MOORA (Multi-Objective Optimization on the basis of Ratio Analysis) adalah metode pengambilan keputusan multi-kriteria yang digunakan untuk memilih alternatif terbaik berdasarkan serangkaian kriteria. Langkah-langkahnya meliputi menentukan kriteria, normalisasi matriks keputusan, menentukan bobot kriteria, membuat matriks keputusan terbobot, menghitung skor terbobot, menghitung solusi ideal positif dan negatif, menghitung jarak solusi, menghitung skor akhir, dan mengurutkan alternatif. Metode ini membantu pengambil keputusan dalam menilai dan membandingkan alternatif berdasarkan preferensi mereka terhadap kriteria yang relevan.
                </p>
               <a href="/login" class="btn btn-primary">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    <div class="row align-items-md-stretch">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
              <img src="{{ asset('images/1.jpg') }}" alt="" style="width: 450px; height:600px;">
              <h4 class="mt-5">Nama: Muhammad Afdal Rahman Dani</h4>
              <p class="mt-3">BP: 20101152610329</p>
              <p>Kelas: SPK-SI6</p>
            </div>
          </div>
          
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
            <img src="https://www.narapsikologi.com/wp-content/uploads/2021/12/logo-upi1.png" alt="" style="width: 500px">
          <h2 class="mt-5">About UPI YPTK PADANG</h2>
          <p>UPI YPTK Padang adalah sebuah universitas swasta di kota Padang, Sumatera Barat, Indonesia. Universitas ini memiliki beberapa fakultas dan program studi, termasuk Teknik dan Informatika, Ekonomi dan Bisnis, Ilmu Sosial dan Ilmu Politik, Keguruan dan Ilmu Pendidikan, serta Pertanian. Kampus ini dilengkapi dengan fasilitas seperti ruang kuliah, perpustakaan, laboratorium, pusat komputer, dan area olahraga. UPI YPTK Padang juga memiliki beragam kegiatan mahasiswa dan kerjasama dengan instansi dan perguruan tinggi lainnya. Informasi lebih rinci dapat ditemukan di situs resmi kampus.</p>
          <div class="accordion mt-5" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: antiquewhite">
                  VISI
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong> Visi UPI YPTK Padang:.</strong>
                  "Menjadi perguruan tinggi yang unggul dalam pengembangan ilmu pengetahuan, teknologi, dan seni, serta mampu menghasilkan lulusan yang berdaya saing, bermoral, dan berkualitas internasional."
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: antiquewhite">
                  MISI
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>Misi UPI YPTK Padang:</strong>

                  Menyelenggarakan pendidikan tinggi yang bermutu dan relevan dengan tuntutan dunia kerja.
                  Mengembangkan penelitian, pengembangan, dan penerapan ilmu pengetahuan, teknologi, dan seni yang berdampak positif pada masyarakat.
                  Mendorong pengabdian kepada masyarakat melalui program-program pengabdian yang bermanfaat dan berkelanjutan.
                  Menjalin kemitraan dan kerjasama dengan berbagai pihak, baik dalam maupun luar negeri, untuk meningkatkan mutu dan daya saing institusi.
                  Mengembangkan sumber daya manusia yang kompeten, inovatif, dan berintegritas.
                  Menjaga dan mengembangkan budaya akademik yang berkualitas dan berorientasi pada pelayanan.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2023
    </footer>
  </div>
</main>


    
  </body>
</html>

@endsection