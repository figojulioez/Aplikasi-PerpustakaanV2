@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pendataan Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <style type="text/css">
    input.form-control { 
      font-family:cursive; 
      border: 0px solid black;
      border-bottom: 1px solid black;
      font-size: 1rem;
    }
    label { font-family:body; font-size: 1rem; }


  </style>

  <div class="w3-container d-flex justify-content-start w-100">
   <div class="w-50">
    <form method="post" action="/pendataan-buku/kategori/{{ $kategoris->kategoriId }}" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"><b>Nama Kategori</b></label>
        <input autocomplete="off" required type="text" class="form-control" id="exampleFormControlInput1" placeholder="Kategori  ..." name="kategori" value="{{$kategoris->namaKategori}}">
      </div>

      <button type="submit" class="btn btn-success w-100">Simpan</button>
    </form>

    


  </div>

</div>
</main>


@endSection