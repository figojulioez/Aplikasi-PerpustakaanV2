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
    <form method="post" action="/pendataan-buku/{{ $buku->bukuId }}" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"><b>Judul</b></label>
        <input autocomplete="off" required type="text" class="form-control" id="exampleFormControlInput1" placeholder="Judul  ..." name="judul" value="{{ $buku->judul }}">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label"><b>Penulis</b></label>
        <input autocomplete="off" required type="text" class="form-control" id="exampleFormControlInput2" placeholder="Penulis  ..." name="penulis" value="{{ $buku->penulis }}">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label"><b>Tahun Terbit</b></label>
        <input autocomplete="off" required type="number" min="0" class="form-control" id="exampleFormControlInput3" placeholder="Tahun Terbit  ..." name="tahunTerbit" value="{{ $buku->tahunTerbit }}">
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput4" class="form-label"><b>Kategori</b></label>
        <select class="form-select" name="kategoriId" aria-label="Default select example">
          <option selected>Pilih kategori ...</option>

          @foreach($kategoris as $kategori)
            <option value="{{ $kategori->kategoriId }}" {{ ($buku->kategori->kategoriId == $kategori->kategoriId)? 'selected':''  }}>{{ $kategori->namaKategori }}</option>
          @endforeach

        </select>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label"><b>Foto <small class="text-danger">*Pasitikan foto berbentuk portrait</small></b></label>
        <input autocomplete="off" type="file" id="file" class="form-control @error('foto') is-invalid @endError" id="exampleFormControlInput2" placeholder="Penulis  ..." name="foto">
        @error('foto')
        <span class="invalid-feedback"><b>{{ $message }}</b></span>
        @endError
        <img src="{{ asset('storage/' . $buku->foto) }}" id="image" class="mt-2" width="150">



      </div>
      <button type="submit" class="btn btn-success w-100">Simpan</button>
    </form>

    


  </div>

</div>
</main>

<script type="text/javascript">

  document.getElementById('file').addEventListener('change', function (e) {

    const reader = new FileReader();

    reader.onloadend = () => {
      document.getElementById('image').setAttribute('src', reader.result);
    }

    reader.readAsDataURL(e.target.files[0]);
  });

</script>

@endSection