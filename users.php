<?php
include_once('templets/header.php');
?>
    
    <!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Data User</h1>

<?php
if (isset($_POST['simpan'])) {
  if (tambah_user($_POST) > 0) {
?>
    <div class="alert alert-success" role="alert">Data Berhasil disimpan!
    </div>
  <?php
  } else {  
  ?>
    <div class ="alert alert-danger" role="alert">Data Gagal disimpan!
    </div>  
<?php    
  }
}
?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahmodal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Data User</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>User Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>    
                                    <tbody>
                                        <?php 
                                        //
                                        $no = 1;
                                        //
                                        $users = query("SELECT * FROM users"); 
                                        foreach($users as $user) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?=$user['username']?></td>
                                            <td><?= $user['user_role']?></td>
                                              <td><a class="btn btn-success" href="edit-user.php?id=<?= $user['id_user']?>">Ubah</a>
                                              <a onclick="confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-danger" href="hapus-user.php?id=<? $user['id_user']?>">Hapus</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </div>
                 
    </div>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<!-- /.container-fluid -->

<?php 
//mengambil data barang dari tabel dengan kode
  $query = mysqli_query($koneksi, "SELECT max(id_user) as KodeTerbesar FROM users");
  $data = mysqli_fetch_array($query);
  $Kodeuser = $data['KodeTerbesar'];

  $urutan = (int) substr($Kodeuser, 3, 2);

  $urutan++;

  $huruf = "usr";
  $Kodeuser = $huruf . sprintf("%02s", $urutan);
?>

<!-- Modal -->
<div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method = "post" action="">
          <input type="hidden" name="id_user" id="id_user" value="<?= $Kodeuser ?>">
          <div class="form-group row">
            <label for="nama_user" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nama_user" name="username">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col col-form-label">password</label>
            <div class="col-sm-8">
              <textarea class="form-control" name="password" id="password"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="user_role" class="col-sm-3 col-form-label">User Role</label>
            <div class="col-sm-8">
                <select class="form-control" name="user_role" id="user_rolehttp://localhost:8080/buku-tamu/laporan.php">
                    <option value="admin">Administrator</option>
                    <option value="operator">Operator</option>
                </select>
          <div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              <button type="submit" name="simpan" class="btn btn-primary">simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
include_once('templets/footer.php');
?>