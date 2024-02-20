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
  <script src="./js/bootstrap.bundle.min.js" integrity="sha384-b7JyLpeGgRvDUEKntU3YCBPyQx3bs+LwJ/5o4/1cBCXJusgur3A3l86QeuR5KzRk" crossorigin="anonymous"></script>

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

             <form method="post" action="./masuk" class="needs-validation">
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
              <input required type="email" class="form-control @error('email') is-invalid @endError" autocomplete="off" name="email" id="floatingEmail" placeholder="Email">
              <label for="floatingUsername">Email</label>

              @error('email')
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
              <input type="submit" style="font-family: math;font-weight: bold;" class="submit" value="Masuk" />
            </div>
            <div class="signin mt-4 text-center">
              <span
              >Belum Punya Akun? <a href="./buat">Buat akun</a></span
              >
            </div>

          </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
