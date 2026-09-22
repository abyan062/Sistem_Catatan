<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kelola kategori</title>
    <link rel="stylesheet" href="public/css/kategori.css">
    <style>
        body{
            display:block;
        }
    </style>
</head>
<body>
<?php include 'app/views/components/nav.php'?>
         <header class="navbar">
  
    <div class = "container" style="margin-top: 80px;">
        <div class="card">
            <h2>Daftar Kategori</h2>
            <a href="index.php?act=kategori-tambah" class="btn btn-primary">Tambah</a>
            <table border=1>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama kategori</th>
                        <th>Dibuat oleh</th>
                        <th style="text-align: center; width: 200px;">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['success_msg'])): ?>
                        <div>
                            <?= $_SESSION['success_msg'];?>
                        </div>
                        <?php
                         unset($_SESSION['success_msg']);
                        ?>
                    <?php endif; ?>

                    <?php 
                    $no = 1;
                    if (count($data_kategori) > 0) :
                     foreach($data_kategori as $row):?>
                        <tr>
                            <td style="text-align: center; width: 50px;">
                                <?= $no?>
                            </td>
                            <td>
                                <?= $row['nama_kategori']?>
                            </td>
                            <td>
                                <?= $row['nama_admin']?>
                            </td>
                            <td>
                                <a href="index.php?act=kategori-edit&id=<?= $row['id']?>" class="btn-orange">Edit</a>
                                <a href="index.php?act=kategori-hapus&id=<?= $row['id']?>" class="btn-red" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    $no++;
                    endforeach;?>

                    <?php else : ?>
                    <tr>
                        <td colspan="3" style="text-align:center;">Belum ada kategori</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="index.php?act=dashboard">kembali</a>
    </div>
</body>
</html>