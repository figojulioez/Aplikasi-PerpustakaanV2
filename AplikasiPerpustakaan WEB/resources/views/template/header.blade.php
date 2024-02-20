    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        
        @can('admin')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('dashboard')) ? 'active':'' }}" aria-current="page" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('pendataan-buku') || Request::is('pendataan-buku/create')) ? 'active':'' }}" href="/pendataan-buku">
              <span data-feather="book"></span>
              Pendataan Buku
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('pengguna') || Request::is('pengguna/create')) ? 'active':'' }}" href="/pengguna">
              <span data-feather="user"></span>
              Pengguna
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('pengembalian') || Request::is('pengembalian/*')) ? 'active':'' }}" href="/pengembalian">
              <span data-feather="airplay"></span>
              Pengembalian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">
              <span data-feather="log-out"></span>
              Logout
            </a>
          </li>
         
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Laporan</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('laporan-peminjaman') || Request::is('laporan-peminjaman/*')) ? 'active':'' }}" href="/laporan-peminjaman">
              <span data-feather="file-text"></span>
              Laporan Peminjaman
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link  {{ (Request::is('laporan-pengembalian') || Request::is('laporan-pengembalian/*')) ? 'active':'' }}" href="/laporan-pengembalian">
              <span data-feather="file-text"></span>
              Laporan Pengembalian
            </a>
          </li>
        </ul>
        </ul>
        @endCan

         @can('petugas')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('petugas/dashboard')) ? 'active':'' }}" aria-current="page" href="/petugas/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('petugas/pendataan-buku'))? 'active':'' }}" href="/petugas/pendataan-buku">
              <span data-feather="book"></span>
              Pendataan Buku
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('petugas/pengembalian') || Request::is('petugas/pengembalian/*')) ? 'active':'' }}" href="/petugas/pengembalian">
              <span data-feather="airplay"></span>
              Pengembalian
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">
              <span data-feather="arrow-left"></span>
              Logout
            </a>
          </li>
          

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Laporan</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('petugas/laporan-peminjaman') || Request::is('petugas/laporan-peminjaman/*')) ? 'active':'' }}" href="/petugas/laporan-peminjaman">
              <span data-feather="file-text"></span>
              Laporan Peminjaman
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('petugas/laporan-pengembalian') || Request::is('petugas/laporan-pengembalian/*')) ? 'active':'' }}" href="/petugas/laporan-pengembalian">
              <span data-feather="file-text"></span>
              Laporan Pengembalian
            </a>
          </li>
        </ul>
        </ul>
        @endCan
        @can('peminjam')
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('dashboard')) ? 'active':'' }}" aria-current="page" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('peminjam/pendataan-buku'))? 'active':'' }}" href="/peminjam/pendataan-buku">
              <span data-feather="book"></span>
              Pendataan Buku
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout">
              <span data-feather="arrow-left"></span>
              Logout
            </a>
          </li>


          
        </ul>
        @endCan

      </div>
    </nav>