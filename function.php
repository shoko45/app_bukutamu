<?php
//panggil file koneksi.php
require_once('koneksi.php');

//membuat query ke / dari database
function query($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
// function tambah data
function tambah_tamu($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_tamu"]);
    $tanggal    = date("Y-m-d");
    $nama_tamu  = htmlspecialchars($data["nama_tamu"]);
    $alamat     = htmlspecialchars($data["alamat"]);
    $no_hp      = htmlspecialchars($data["no_hp"]);
    $bertemu    = htmlspecialchars($data["bertemu"]);
    $kepentingan= htmlspecialchars($data["kepentingan"]);

    $query = "INSERT INTO bukutamu VALUES ('$kode','$tanggal','$nama_tamu','$alamat','$no_hp','$bertemu','$kepentingan')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function ubah_tamu($data)
{
    global $koneksi;

    $kode            = htmlspecialchars($data["id_tamu"]);
    $tanggal         = date("Y-m-d");
    $nama_tamu       = htmlspecialchars($data["nama_tamu"]);
    $alamat          = htmlspecialchars($data["alamat"]);
    $no_hp           = htmlspecialchars($data["no_hp"]);
    $bertemu         = htmlspecialchars($data["bertemu"]);
    $kepentingan     = htmlspecialchars($data["kepentingan"]);

    $query = "UPDATE bukutamu SET
    id_tamu    = '$kode',
    tanggal  = '$tanggal',
    nama_tamu   = '$nama_tamu',
    alamat   = '$alamat',
    no_hp   = '$no_hp',
    bertemu   = '$bertemu'
  WHERE kepentingan = '$kepentingan'";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

function hapus_tamu($id) {
    global $koneksi;

    $query = "DELETE FROM bukutamu WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tambah_user($data)
{
    global $koneksi;

    $kode            = htmlspecialchars($data["id_user"]);
    $username      = htmlspecialchars($data["username"]);
    $password          = htmlspecialchars($data["password"]);
    $user_role         = htmlspecialchars($data["user_role"]);

    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    $query = "INSERT INTO users VALUES ('$kode', '$username', '$password_hash', '$user_role')";

    mysqli_query($koneksi,$query);

    return mysqli_affected_rows($koneksi);
}

// function ubah data tamu
function ubah_user($data)
{
    global $koneksi;

    $kode       = htmlspecialchars($data["id_user"]);
    $username   = htmlspecialchars($data["username"]);
    $user_role  = htmlspecialchars($data["user_role"]);

    $query = "UPDATE users SET
                username    = '$username',
                user_role   = '$user_role'
              WHERE id_user = '$kode'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
