<?php 
include 'koneksi.php';

if(isset($_POST['tambah'])){
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $sandi = mysqli_real_escape_string($koneksi, $_POST['sandi']);
    
    if(!empty($nama) && !empty($sandi)){
        mysqli_query($koneksi, "INSERT INTO users (nama, sandi) VALUES('$nama', '$sandi')");
        echo "<p style='color:green;'>Data berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color:red;'>Data tidak boleh kosong!</p>";
    }
}

if(isset($_GET['hapus'])){
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM users WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Railway</title>
</head>
<body>
    <h2>Tambah Data</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="password" name="sandi" placeholder="Sandi" required>
        <button type="submit" name="tambah">Simpan</button>
    </form>

    <h2>Data Users</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Sandi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM users");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $d['id']; ?></td>
            <td><?php echo $d['nama']; ?></td>
            <td><?php echo str_repeat('*', strlen($d['sandi'])); ?></td>
            <td>
                <a href="index.php?hapus=<?php echo $d['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
