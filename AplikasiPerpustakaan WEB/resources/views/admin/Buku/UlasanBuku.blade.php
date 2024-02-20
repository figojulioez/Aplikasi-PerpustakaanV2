@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pengembalian Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="container-fluid justify-content-center d-flex p-2">
    <img src="{{ asset('storage/' . $buku->foto) }}" width="250" alt="">
    <table class="table w-50 mb">
      <tr>
        <td>Buku ID</td><td>: {{$buku->bukuId}}</td>
      <tr>
      <tr>
        <td>Judul</td><td>: {{$buku->judul}}</td>
      <tr>
      <tr>
        <td>Penulis</td><td>: {{ $buku->penulis }}</td>
      <tr>
      <tr>
        <td>Tahun Terbit</td><td>: {{ $buku->tahunTerbit }}</td>
      <tr>
      <tr>
        <td>Kategori</td><td>: {{ $buku->kategori->namaKategori }}</td>
      <tr>
      <tr>
        <td>Rating</td><td>: {{ $rating }} dari 5</td>
      <tr>
    </table>
  </div>

@foreach($ulasan as $ul)
  <div class="card mt-3 mb-2" >
    <div class="card-header d-flex justify-content-between text-light" style="background-color: #198754">
        <h5>{{ $ul->user->email }}</h5>
        <p>{{ $ul->created_at }}</p>
    </div>
    <div class="card-body">
        <p class="card-text">{{$ul->ulasan}}</p>
    </div>
  </div>
@endforeach
</main>
<script type="text/javascript">

</script>

@endSection