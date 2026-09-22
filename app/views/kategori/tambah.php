<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <h2>Tambah kategori</h2>
            <a href="index.php?act=kategori" class="btn btn-primary">Kembali</a>

            <?php if (isset($_SESSION['error_msg'])):?>
                
                <div class="error_message">
                    <?= $_SESSION['error_msg']?>
                </div>
                <?php
                unset($_SESSION['error_msg']);
                ?>
                <?php endif; ?>
                <form action="index.php?act=kategori-tambah-proses" method="POST" style="margin-top:20px">
                    <input type="text" name="nama_kategori" placeholder="Nama Kategori Baru" required
                    style="width: 300px; padding:5px;">
                    <button type="submit" style="padding: 5px;">Tambah</button>
                </form>
        </div>
    </div>
</body>
</html>