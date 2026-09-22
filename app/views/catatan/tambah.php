<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // include "app/views/components/nav.php";
    ?>

    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <h2>Tambah Catatan Baru</h2>
            <a href="index.php?act=catatan" class="btn btn-primary">Kembali</a>

            <?php if (isset($_SESSION['error_msg'])): ?>
                <div class="error-message" style="margin-top: 15px;">
                    <?= $_SESSION['error_msg']; ?>
                </div>
                <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>

            <form action="index.php?act=catatan-tambah-proses" method="POST" style="margin-top:20px;">

                <div class="form-group">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">
                        Judul Catatan
                    </label>
                    <input type="text" 
                           name="judul" 
                           class="form-control" 
                           placeholder="Masukkan judul..." 
                           required>
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">
                        Pilih Kategori
                    </label>
                    <select name="kategori_id" class="form-control">
                        <option value="">-- Tanpa Kategori --</option>
                        <?php if (isset($data_kategori) && count($data_kategori) > 0): ?>
                            <?php foreach ($data_kategori as $kat): ?>
                                <option value="<?= $kat['id']; ?>">
                                    <?= $kat['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">
                        Isi Catatan
                    </label>
                    <textarea name="isi" 
                              class="form-control" 
                              rows="5" 
                              placeholder="Tuliskan catatan Anda di sini..." 
                              required></textarea>
                </div>

                <button type="submit" style="padding: 5px;">
                    Simpan Catatan
                </button>

            </form>
        </div>
    </div>

</body>
</html>