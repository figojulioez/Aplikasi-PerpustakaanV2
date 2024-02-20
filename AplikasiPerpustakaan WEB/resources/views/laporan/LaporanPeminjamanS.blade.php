  <!DOCTYPE html>
  <html>
  <head>
    <title>Index</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://localhost/perpus/assets/css/w3school1.css">
    <link rel="stylesheet" href="http://localhost/perpus/assets/css/w3school2.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/perpus/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/perpus/assets/css/cssGabungan.css">

    <link rel="icon" type="image/x-icon" href="http://localhost/perpus/assets/img/logo_app.png">
    <script src="http://localhost/perpus/assets/js/jquery.js"></script>  

    <script src="http://localhost/perpus/assets/js/fontAwesome.js"></script>
  </head>
  <style type="text/css">
    * { font-family: Trebuchet MS; }
  </style>
  <body class="">

    <!-- header -->
    <div class="d-flex flex-rows py-1 mx-5" style="border-bottom: 1px solid black;">
      <div class="w-25 py-2 px-3">
      </div>
      <div class="text-center w-50">
        <h1 style="font-weight: bold">APLIKASI PERPUSTAKAAN</h1>
        <p>
          Alamanda Regency Jln. Cendana 1 No 9 Tambun Utara Kecamatan KarangSatria
        Kabupaten Bekasi JAWA BARAT - 17510</p>
      </div>
    </div>


    <div class="row mx-5"> 
      <div class="row mt-1">
        <h6 id="tanggal">Tanggal Cetak : Senin 25 November 2022</h6>
      </div>
<script type="text/javascript">
  arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
arrhari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
date = new Date();
hari = date.getDay();
tanggal = date.getDate();
bulan = date.getMonth();
tahun = date.getFullYear();
var t = "Tanggal Cetak : ";  
t += arrhari[hari]+", " +tanggal+ " " + arrbulan[bulan]+ " "+tahun;
const tangg = document.getElementById("tanggal");


tangg.innerHTML = t;


</script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
    <script type="text/javascript" src="{{ asset('js/fontAwesome.js') }}"></script>    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>


    <!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<main class="container-fluid">
    <h1 class="h2 text-center" style="font-family: cursive;font-weight: bold;">LAPORAN PEMINJAMAN</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="w3-container d-flex justify-content-between w-100">
   <div class="w-100 mt-3">

    <div class="w-100" style="overflow-x: auto;">
      <table class="table table-bordered mt-4 text-center">
        <thead>
          <tr class="bg-dark text-light">
            <th scope="col">PEMINJAMAN ID</th>
            <th scope="col">TRANS PINJAM</th>
            <th scope="col">USER ID</th>
            <th scope="col">BUKU ID</th>
            <th scope="col">TANGGAL PINJAM</th>
          </tr>
        </thead>
        <tbody>
          @foreach($peminjamans as $peminjam)
          <tr>
            <td scope="col">{{ $peminjam->peminjamanId }}</td>
            <td scope="col">{{ $peminjam->transpinjam }}</td>
            <td scope="col">{{ $peminjam->userId }}</td>
            <td scope="col">{{ $peminjam->bukuId }}</td>
            <td scope="col">{{ $peminjam->created_at }}</td>
          </tr>
          @endForeach
        </tbody>
      </table>
    </div>

  </div>
</div>
</div>
</div>
<div class="d-flex mx-5">
  <div class="w-75"></div>
 
  <div class="w-25">
    <span id="tes"></span>
    <br>
    <span>Mengetahui</span>
    <br>
    <span>Kepala Perpustakaan : </span>
    <br>
    <br>
    <br>
    <br>
    <p>({{ auth()->user()->namaLengkap }})</p>
  </div>

</div>
</main>
 <script type="text/javascript">
    arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    arrhari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
    date = new Date();
    hari = date.getDay();
    tanggal = date.getDate();
    bulan = date.getMonth();
    tahun = date.getFullYear();
    var t = "Bekasi, ";  
    t += arrhari[hari]+", " +tanggal+ " " + arrbulan[bulan]+ " "+tahun;
    const tans = document.getElementById("tes");


    tans.innerHTML = t;


  </script>
<script type="text/javascript">
  window.print();
</script>