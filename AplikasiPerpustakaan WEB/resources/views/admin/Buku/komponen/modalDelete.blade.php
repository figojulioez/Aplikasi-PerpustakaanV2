<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h5><i class="fa fa-trash text-danger w3-xxxlarge"></i></h5>
        <h6>Anda yakin mau menghapus item ini?</h6>
        <strong>Apabila anda menghapus item ini maka data Peminjaman, Pengembalian, UlasanBuku, KoleksiPribadi akan ikut terhapus</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
        <form id="formDeleteBuku" method="post">
          @method('delete')
          @csrf
        <button type="submit" class="btn btn-primary">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

  const deleteData = function (e) {
    const id = e.getAttribute('data-delete');
    document.getElementById('formDeleteBuku').setAttribute('action', `/pendataan-buku/${id}`);
  }

</script>