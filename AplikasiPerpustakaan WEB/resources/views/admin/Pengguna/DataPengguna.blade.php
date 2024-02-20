@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pendataan Pengguna</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
  </div>

  <div class="accordion accordion-flush w-100" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Data Petugas
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="w-100">

          <div class="w3-container  d-flex justify-content-between w-100">
           <div class="w-100">
            <form class="d-flex  mt-4 w-100" role="search">
              <input class="form-control w-100" type="search" value="{{ (request()->exists('petugas'))? request('petugas'):'' }}" placeholder="Pencarian petugas ..." aria-label="Search" name="petugas" autocomplete="off">
              <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>


            <div class="d-flex w-100">
              <a href="./pengguna/create" class="btn btn-primary mt-2"><i class="fa-solid fa-plus me-2"></i> Tambah Data Petugas</a>

            </div>

            <div class="w-100" style="overflow-x: auto;">
              <table class="table table-bordered mt-4 text-center">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">User Id</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">Email</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Role</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($petugass as $user)
                  <tr>
                    <td>{{ $user->userId }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->namaLengkap }}</td>
                    <td>{{ ($user->role == 2)? 'Petugas':'Peminjam' }}</td>
                    <td>{{ ($user->alamat) }}</td>
                    <td><a class="btn {{ ($user->role == 3)? 'disabled':'' }} btn-danger delete" href="#" data-bs-toggle="modal" data-delete="{{ $user->userId }}" data-bs-target="#exampleModal" onclick="hapusPengguna(this)"><i class="fa-solid fa-trash"></i></a></td>

                  </tr>
                  @endForeach
                </tbody>
              </table>
            </div>
            <div class="container-fluid justify-content-end d-flex mt-4 mb-3">
              {{ $petugass->links() }}
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
          Data Peminjam
        </button>
      </h2>
      <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
        <div class="w-100">

          <div class="w3-container  d-flex justify-content-between w-100">
           <div class="w-100">
            <form class="d-flex  mt-4 w-100" role="search">
              <input class="form-control w-100" type="search" value="{{ (request()->exists('peminjam'))? request('peminjam'):'' }}" placeholder="Pencarian peminjam ..." aria-label="Search" name="peminjam" autocomplete="off">
              <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>


            <div class="d-flex w-100">

            </div>

            <div class="w-100" style="overflow-x: auto;">
              <table class="table table-bordered mt-4 text-center">
                <thead>
                  <tr class="bg-dark text-light">
                    <th scope="col">User Id</th>
                    <!-- <th scope="col">Foto</th> -->
                    <th scope="col">Email</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Role</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($peminjams as $user)
                  <tr>
                    <td>{{ $user->userId }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->namaLengkap }}</td>
                    <td>{{ ($user->role == 2)? 'Petugas':'Peminjam' }}</td>
                    <td>{{ ($user->alamat) }}</td>
                    <td><a class="btn {{ ($user->role == 3)? 'disabled':'' }} btn-danger delete" href="#" data-bs-toggle="modal" data-delete="{{ $user->userId }}" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></a></td>

                  </tr>
                  @endForeach
                </tbody>
              </table>
            </div>
            <div class="container-fluid justify-content-end d-flex mt-4 mb-3">
              {{ $peminjams->links() }}
            </div>
          </div>

        </div>
      </div>  
    </div>
  </div>
</div>

@include('admin.Pengguna.komponen.modalDelete')



</main>


@endSection