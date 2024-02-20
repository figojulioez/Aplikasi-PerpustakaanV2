@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pendataan Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="accordion accordion-flush w-100" id="accordionFlushExample">
    <div class="accordion-item show">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Data Buku
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="w-100">


          <div class="w3-container d-flex justify-content-between w-100">
           <div class="w-100 mt-3">
            <form class="d-flex" role="search">
              <input class="form-control w-100" type="search" value="{{ (request()->exists('key'))? request('key'):'' }}" placeholder="Pencarian buku ..." aria-label="Search" name="key" autocomplete="off">
              <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>


            <div class="d-flex w-100">
              <a href="./pendataan-buku/create" class="btn btn-primary mt-2"><i class="fa-solid fa-plus me-2"></i> Tambah Data Buku</a>

            </div>

            <div class="w-100" style="overflow-x: auto;">
              <table class="table table-bordered mt-4 text-center">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">Buku Id</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">Judul</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Harga Denda</th>
                    <th scope="col">Lihat Ulasan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($bukus as $buku)
                  <tr>
                    <td>{{ $buku->bukuId }}</td>
                    <!-- <td><img src="{{ asset('storage/' . $buku->foto) }}" height="50"></td> -->
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->kategori->namaKategori }}</td>
                    <td>{{ $buku->tahunTerbit }}</td>
                    <td>Rp. {{ $buku->harga }}</td>
                    <td> <a href="ulasan/{{ $buku->bukuId }}" class="btn btn-success">Lihat Ulasan</a></td>
                    <td class="d-flex justify-content-between">
                      <a href="/pendataan-buku/{{ $buku->bukuId }}/edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                      <a class="btn btn-danger delete" href="#" onclick="deleteData(this)" data-bs-toggle="modal" data-delete="{{ $buku->bukuId }}" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="container-fluid justify-content-end d-flex mt-4 mb-3">
              {{ $bukus->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
          Data Kategori
        </button>
      </h2>
      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
        <div class="w-100">

          <div class="w3-container  d-flex justify-content-between w-100">
           <div class="w-100">

            @if( session()->has('error') )
            <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
              <strong>{{ session('error') }}</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endIf

            <form class="d-flex  mt-4 w-100" role="search">
              <input class="form-control w-100" type="search" value="{{ (request()->exists('searchKateg'))? request('searchKateg'):'' }}" placeholder="Pencarian kategori ..." aria-label="Search" name="searchKateg" autocomplete="off">
              <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>


            <div class="d-flex w-100">
              <a href="./pendataan-buku/kategori" class="btn btn-warning mt-2 ms-2"><i class="fa-solid fa-plus me-2"></i> Tambah Kategori</a>
            </div>


            <div class="w-100" style="overflow-x: auto;">
              <table class="table table-bordered mt-4 text-center">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">Kategori ID</th>
                    <th scope="col">Nama Kategori</th>
                    <th style="width: 15%;" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($kategoris as $kategori)
                  <tr>
                    <td>{{ $kategori->kategoriId }}</td>
                    <td>{{ $kategori->namaKategori }}</td>
                    <td class="d-flex justify-content-between">
                      <a href="/pendataan-buku/kategori/{{ $kategori->kategoriId }}/edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                      <a class="btn btn-danger delete" href="#" onclick="deleteKategori(this)" data-bs-toggle="modal" data-delete="{{ $kategori->kategoriId }}" data-bs-target="#exampleModal2"><i class="fa-solid fa-trash"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="container-fluid justify-content-end d-flex mt-4 mb-3">
              {{ $kategoris->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.Buku.komponen.modalDelete')
    @include('admin.Buku.komponen.modalKategoriDelete')

  </main>


  @endSection