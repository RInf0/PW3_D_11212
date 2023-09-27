<?php
session_start();

if(!isset($_SESSION["user"])){
  header(" Location: ./login.php");
  exit;
}

if (!isset($_SESSION["jmlMenu"])) {
  $_SESSION["jmlMenu"] = [];
}

$detail = [
  "name" => "Grand Atma",
  "tagline" => "Hotel & Resort",
  "page_title" => "Admin Panel - Grand Atma Hotel & Resort",
  "logo" => "./assets/images/crown.png"
];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8"/>
  <title><?php echo $detail["page_title"]; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  
  <!-- Icon Tab -->
  <link rel="icon" href="<?php echo $detail["logo"]; ?>" type="image/x-icon"/>

  <!-- Bootstrap 5.3 CSS -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css"/>

  <!-- Poppins dari Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="./assets/css/poppins.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="./assets/css/style.css" />

  <style>
      .img-bukti-ngantor{
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
      }
  </style>
</head>

<body>
  <header class="fixed-top scrolled" id="navbar">
    <nav class="container nav-top py-2">
        <a href="./" class="rounded bg-white py-2 px-3 d-flex align-items-center nav-home-btn">
            <img src="<?php echo $detail["logo"]; ?>" class="crown-logo" />
            <div>
                <p class="mb-0 fs-5 fw-bold"><?php echo $detail["name"]; ?></p>
                <p class="small mb-0"><?php echo $detail["tagline"]; ?></p>
            </div>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="./" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Admin Panel</a></li>
            <li class="nav-item"><a href="./processLogout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </nav>
  </header>
  
  <main style="padding-top: 84px;" class="container">
    <h1 class="mt-5 mb-3 border-bottom fw-bold">Dashboard</h1>
    <?php if (isset($_SESSION["success"])) { ?>
      <div class="alert alert-success mb-4 text-start" role="alert"><strong>Berhasil!</strong> <?php echo $_SESSION["success"]; ?></div>
    <?php
      unset($_SESSION["success"]); //hapus error dari session
    } ?>

    <div class="row">
        <div class="col-lg-10">
            <div class="card card-body h-100 justify-content-center">
              <h4>Selamat datang,</h4>
              <h1 class="fw-bold display-6 mb-3"><?php echo $_SESSION["user"]["username"]; ?></h1>

              <p class="mb-0">Kamu sudah login sejak:</p>
              <p class="fw-bold lead mb-0"><?php echo $_SESSION["user"]["login_at"]; ?></p>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card card-body">
              <p>Bukti sedang ngantor:</p>
              <img
                  src="<?php echo $_SESSION["user"]["bukti_ngantor"]; ?>"
                  class="img-fluid rounded img-bukti-ngantor"
                  alt="Bukti ngantor (sudah dihapus)" />
            </div>
        </div>
    </div>
    
    <h1 class="mt-5 mb-3 border-bottom fw-bold">DAFTAR MENU MAKANAN</h1>
    <p class="mb-0">Grand Atma memiliki <strong><?php echo count($_SESSION['jmlMenu']) ?></strong> daftar menu makanan yang bisa dipesan.</p>
    <a href="./addMenu.php" class="btn btn-success"><i class="fa-regular fa-plus fa-spin me-2"></i>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
      </svg>
      Tambah Menu
    </a>

    <ul class="list-unstyled">
    <?php if(isset($_SESSION["jmlMenu"])){ ?>
      <?php foreach ($_SESSION['jmlMenu'] as $index => $menu) { ?>
        <li class="daftar-menu border rounded p-4 my-3">
          <div class="col-md-6 w-100">
            <div class="row g-0  overflow-hidden flex-md-row shadow-sm h-md-250 position-relative">
              <div class="col-auto d-none d-lg-block">
                <img class="img-menu" src="<?php echo $_SESSION["jmlMenu"][$index]["foodImg"]  ?>" alt="">
              </div>
              <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0"><?php echo $_SESSION["jmlMenu"][$index]["nama"] ?></h3>
                <br>
                <p class=" card-text mb-auto"> <?php echo $_SESSION["jmlMenu"][$index]["deskripsi"] ?></p>
                <br>
                <hr>
                <div class="d-flex">
                  <p>Kategori: </p>
                  <h5 class="fw-bolder px-2"> <?php echo $_SESSION["jmlMenu"][$index]["kategori"] ?></h5>
                  <p> Harga: </p>
                  <h5 class="fw-bolder px-2">Rp <?php echo $_SESSION["jmlMenu"][$index]["harga"] ?></h5>
                </div>
                <form action="./processDelMenu.php" method="POST">
                  <input type="hidden" name="index" value="<?php echo $index ?>" />
                  <button class="btn btn-danger" class="fa-regular fa-trash fa-spin me-2" name="delMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                    <span>Hapus</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </li>
        <?php } ?> <?php } ?>
    </ul>
  </main>

  <!-- Bootstrap 5.3 JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
</body>


</html>