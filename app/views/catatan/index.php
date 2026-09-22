<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link rel="stylesheet" href="public/css/catatan.css">
</head>
<body>
    <?php include 'app/views/components/nav.php'?>  

<div class="container" style="margin-top: 80px;">
<div class="card">
<h2>Daftar Catatan</h2>

<a href="index.php?act=catatan-tambah" class="btn btn-primary">
    Tambah Catatan Baru
</a><br>

<?php if (isset($_SESSION['success_msg'])): ?>
    <div class="success-message">
        <?= htmlspecialchars($_SESSION['success_msg']); ?>
    </div>
<?php 
    unset($_SESSION['success_msg']); 
endif; 
?>

<div class="sticky-container">

<?php if (!empty($data_catatan)): ?>

    <?php foreach ($data_catatan as $row): ?>
        <div class="sticky-note">

            <h3 class="note-title">
                <?= htmlspecialchars($row['judul']) ?>
            </h3>

            <div class="note-body">
                <?= nl2br(htmlspecialchars($row['isi'])) ?>
            </div>

            <div class="note-meta">
                <strong>Kategori:</strong>
                <?= !empty($row['nama_kategori']) 
                    ? htmlspecialchars($row['nama_kategori']) 
                    : '<i>Tidak ada</i>' ?>
                <br>

                <strong>Oleh:</strong>
                <?= htmlspecialchars($row['nama_admin']) ?>
            </div>

            <div class="note-actions">
                <a href="index.php?act=catatan-edit&id=<?= $row['id'] ?>" 
                   class="btn-orange">Edit</a>

                <a href="index.php?act=catatan-hapus&id=<?= $row['id'] ?>" 
                   class="btn-red"
                   onclick="return confirm('Yakin ingin menghapus catatan ini?')">
                   Hapus
                </a>
            </div>

        </div>
    <?php endforeach; ?>

<?php else: ?>

    <p style="text-align:center; color:#777; width:100%;">
        Belum ada catatan.<br>
        Silakan tambah catatan baru!
    </p>

<?php endif; ?>

   <a href="index.php?act=dashboard">kembali</a>

</div>
</div>
</div>

</body>
</html>