@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pengembalian Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="container-fluid p-2">
    <table class="table w-50 mb">
      <tr>
        <td>Kode Transaksi</td><td>: {{$peminjaman->transpinjam}}</td>
      <tr>
      <tr>
        <td>Nama</td><td>: {{$peminjaman->user->namaLengkap}}</td>
      <tr>
      <tr>
        <td>Email</td><td>: {{$peminjaman->user->email}}</td>
      <tr>
      <tr>
        <td>Alamat</td><td>: {{$peminjaman->user->alamat}}</td>
      <tr>
    </table>

<form method="post" action="/pengembalian/{{ $peminjaman->transpinjam }}">
@csrf
<?php $i = 0; ?>
@foreach($bukus as $buku)

    <div class="card mb-3 w-100" style="box-sizing: border-box;">
      <div class="row g-0">
        <div class="col-md-1">
          <img src="{{ asset('storage/' . $buku->buku->foto) }}"class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h6 class="card-title">{{$buku->buku->judul}}</h5>
              <select class="form-select" name="denda{{$i}}" aria-label="Default select example">
                <option selected disabled>Keterangan Buku</option>
                <option value="{{ 0 }}">Baik : Rp. 0,00</option>
                <option value="{{ $buku->buku->harga }}">Hilang : Rp. {{ $buku->buku->harga }}</option>
                <option value="{{ $buku->buku->harga / 100 * 70 }}">Rusak : Rp. {{ $buku->buku->harga / 100 * 70 }}</option>
              </select>

          </div>
        </div>
      </div>
    </div>
    <?php $i++; ?>
@endForeach
  <button type="submit" class="btn w-100 btn-success">Transaksi</button>

  </div>
</form>


</main>
<script type="text/javascript">
  $(".hilang").on('change', function (e) {
    const element = e.parentElement;
    if(e.target.value.length > 0) {
      e.target.parentElement.nextElementSibling.lastElementChild.setAttribute('disabled', true);
    } else {
      e.target.parentElement.nextElementSibling.lastElementChild.removeAttribute('disabled');
    }
  });

   $(".rusak").on('change', function (e) {
    const element = e.parentElement;
    if(e.target.value.length > 0) {
      e.target.parentElement.previousElementSibling.lastElementChild.setAttribute('disabled', true);
    } else {
      e.target.parentElement.previousElementSibling.lastElementChild.removeAttribute('disabled');
    }
  });

</script>

@endSection