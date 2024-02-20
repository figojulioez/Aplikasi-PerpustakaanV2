<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/login.css" />
  <link
  href="./css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
  crossorigin="anonymous"
  />

  <title>Login</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
      <div class="row">
        <div class="col-md-6 side-image" style="background-image: url('./img/bg.jpeg');">
          <!-------------      image     ------------->

          <div class="text">
          </div>
        </div>

        <div class="col-md-6 right">
          <div class="input-box">
            <header>Aplikasi Perpustakaan</header>

            <form method="post" action="./buat" class="needs-validation">
              @csrf

              <style type="text/css">
                input.form-control { 
                  font-family:cursive; 
                  border: 0px solid black;
                  border-bottom: 1px solid black;
                  font-size: 1rem;
                }
                label { font-family:body; }


              </style>


              <div class="form-floating mb-2">
                <input type="text" class="form-control @error('username') is-invalid @endError" autocomplete="off" name="username" id="floatingUsername" placeholder="Username" required>
                <label for="floatingUsername">Username</label>
                
                @error('username')
                <span class="invalid-feedback"><b>{{ $message }}</b></span>
                @endError

              </div>

              <div class="form-floating mb-2">
                <input required type="email" class="form-control @error('email') is-invalid @endError" autocomplete="off" name="email" id="floatingEmail" placeholder="Email">
                <label for="floatingUsername">Email</label>

                @error('email')
                <span class="invalid-feedback"><b>{{ $message }}</b></span>
                @endError

              </div>

              <div class="form-floating mb-2">
                <input required type="text" class="form-control @error('namaLengkap') is-invalid @endError" autocomplete="off" name="namaLengkap" id="floatingNamaLengkap" placeholder="NamaLengkap">
                <label for="floatingNamaLengkap">Nama Lengkap</label>

                @error('namaLengkap')
                <span class="invalid-feedback"><b>{{ $message }}</b></span>
                @endError

              </div>

              <div class="form-floating mb-2">
                <input required type="text" class="form-control @error('alamat') is-invalid @endError" autocomplete="off" name="alamat" id="floatingAlamat" placeholder="Alamat">
                <label for="floatingAlamat">Alamat</label>

                @error('alamat')
                <span class="invalid-feedback"><b>{{ $message }}</b></span>
                @endError

              </div>

              <div class="form-floating mb-2">
                <input required type="password" class="form-control @error('password') is-invalid @endError" autocomplete="off" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                
                @error('password')
                <span class="invalid-feedback"><b>{{ $message }}</b></span>
                @endError

              </div>

              <div class="input-field">
                <input required type="submit" style="font-family: math;font-weight: bold;" class="submit" value="Buat" />
              </div>

            </form>

            <div class="signin mt-2 text-center">
              <span
              >Sudah Punya Akun? <a href="./masuk">Masuk</a></span
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./js/bootstrap.bundle.min.js" integrity="sha384-b7JyLpeGgRvDUEKntU3YCBPyQx3bs+LwJ/5o4/1cBCXJusgur3A3l86QeuR5KzRk" crossorigin="anonymous"></script>

</body>
</html>
