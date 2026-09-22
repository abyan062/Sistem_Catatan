<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <link rel="stylesheet" href="public/css/dashboard.css">
</head>
<body>
  <?php include 'app/views/components/nav.php'?>
    <!-- <nav class="navbar">
        <a class="navbar-brand" href="#"> Notes app></a>
        <a href="index.php?act=logout" class="btn btn-danger">logout</a>
    </nav>
    <div class="menu-kategori">
    <a href="index.php?act=kategori">Kategori</a>
    </div> -->
    <div class="container-dashboard">
        <div class="card">
            <h3>Selamat datang <?php echo $_SESSION['username'];?>!</h3>
            <p>Ini halaman dashboard admin.</p>
        </div>
    </div>
</body>
</html>