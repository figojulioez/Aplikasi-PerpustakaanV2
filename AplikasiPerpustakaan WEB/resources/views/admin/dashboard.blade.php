@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="w3-row-padding w3-margin-bottom">

    @can('admin')
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{ $pengguna }}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4 class="mt-2">Akun</h4>
      </div>
    </div>
    @endCan

    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-book w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{ $buku }}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4 class="mt-2">Buku</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-arrow-right-from-bracket w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>{{ $peminjaman }}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4 class="mt-2">Pinjam</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-arrow-right-from-bracket w3-xxxlarge" style="transform: rotate(180deg);"></i></div>
        <div class="w3-right">
          <h3>{{ $pengembalian }}</h3>
        </div>
        <div class="w3-clear"></div>
        <h4 class="mt-2">Kembali</h4>
      </div>
    </div>
  </div>

  <div class="w3-container d-flex justify-content-between w-100">
    <div class="col-sm-3 mt-3">
    </div>
  </div>
  <footer class="w3-padding-32 w3-center w3-margin-top">
    <h6 class="text-bold">Alamanda Regency Jalan Cendana Blok C2 No. 9 Kelurahan Karang Satria Kecamatan Tambun Utara</h6>
  </footer>

</div>
</main>
@endSection