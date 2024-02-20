@extends("template.main")
@section("content")

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2" style="font-family: cursive;font-weight: bold;">Pendataan Pengguna</h1>
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
    <form method="post" action="/pengguna" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label"><b>Username</b></label>
        <input autocomplete="off" required type="text" class="form-control @error('username') is-invalid @endError" id="exampleFormControlInput1" placeholder="Username  ..." name="username">
        @error('username')
        <span class="invalid-feedback"><b>{{ $message }}</b></span>
        @endError
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput2" class="form-label"><b>Email</b></label>
        <input autocomplete="off" required type="text" class="form-control @error('email') is-invalid @endError" id="exampleFormControlInput2" placeholder="Email  ..." name="email">
        @error('email')
        <span class="invalid-feedback"><b>{{ $message }}</b></span>
        @endError
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label"><b>Nama Lengkap</b></label>
        <input autocomplete="off" required type="text" class="@error('namaLengkap') is-invalid @endError form-control" id="exampleFormControlInput3" placeholder="Nama Lengkap  ..." name="namaLengkap">
        @error('namaLengkap')
        <span class="invalid-feedback"><b>{{ $message }}</b></span>
        @endError
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label"><b>Password</b></label>
        <input autocomplete="off" required type="password" class="form-control @error('password') is-invalid @endError" id="exampleFormControlInput3" placeholder="Password  ..." name="password">
        @error('password')
        <span class="invalid-feedback"><b>{{ $message }}</b></span>
        @endError
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput3" class="form-label"><b>Alamat</b></label>
        <textarea autocomplete="off" required class="form-control @error('alamat') is-invalid @endError" id="exampleFormControlInput3" placeholder="Alamat  ..." name="alamat"></textarea>
        @error('alamat')
        <span class="invalid-feedback"><b>{{ $message }}</b></span>
        @endError
      </div>
      

      <button type="submit" class="btn btn-success w-100">Simpan</button>
    </form>
  </div>



</div>
</main>

<script type="text/javascript">


</script>

@endSection