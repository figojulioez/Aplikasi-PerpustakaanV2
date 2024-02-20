@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pengembalian Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="w-100">
    <form class="d-flex  mt-4 w-100 mb-5" role="search">
      <input class="form-control w-100" type="search" value="{{ (request()->exists('keyPengembalian'))? request('keyPengembalian'):'' }}" placeholder="Pencarian data pengembalian ..." aria-label="Search" name="keyPengembalian" autocomplete="off">
      <button class="btn btn-outline-success" type="submit">Cari</button>
    </form>
  </div>

  @foreach($peminjaman as $pinjam)
  <div class="card mb-3">
    <h5 class="card-header">{{$pinjam->transpinjam}}</h5>
    <div class="card-body">
      <h5 class="card-title">{{$pinjam->user->namaLengkap}}</h5>
      <p class="card-text">{{$pinjam->created_at}}</p>
      <a href="/pengembalian/{{ $pinjam->transpinjam }}" class="btn btn-primary">Lihat transaksi</a>
    </div>
  </div>
  @endForeach


  <div class="container-fluid justify-content-end d-flex mt-4 mb-3">
    {{ $peminjaman->links() }}
  </div>
</main>


@endSection