<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: ./login.php");
    exit;
}

$detail = [
    "name" => "Grand Atma",
    "tagline" => "Hotel & Resort",
    "page_title" => "Grand Atma Hotel & Resort",
    "logo" => "./assets/images/crown.png"
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $detail["page_title"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
    <!--Icon Tab-->
    <link rel="icon" type="image/x-icon" href="<?php echo $detail["logo"]; ?>" />

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />

    <!--Poppins dari google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./assets/css/poppins.min.css">

    <link rel="stylesheet" href="./assets/css/style.css" />
    
    <!--Button Icon with font-awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

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
                <li class="nav-item"><a href="./dashboard.php" class="nav-link active">Admin Panel</a></li>
                <li class="nav-item"><a href="./processLogout.php" class="nav-link text-danger">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main style="padding-top: 84px;" class="container">
        <h1 class="mt-4 display-6 fw-bold">Tambah Menu</h1>

        <hr class="table-group-divider" />

        <form action="./processAddMenu.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <label class="form-label col-4 my-1" for="nama">Nama Makanan</label>
                <div class="col-8 my-1">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Makanan" required />

                </div>
                
                <label for="tipe" class="form-label col-4 my-1">kategori Makanan</label>
                <div class="col-8 my-1">
                    <select id="tipe" class="form-select" name="kategori" required>
                        <option value="" selected hidden disabled>Pilih Kategori</option>
                        <option value="Appetizers">Appetizers</option>
                        <option value="Main Courses">Main Courses</option>
                        <option value="Desserts">Dessert</option>
                    </select>
                </div>

                <label class="form-label col-4 my-1" for="harga">Harga Makanan (Rp)</label>
                <div class="col-8 my-1">
                    <input type="number" class="form-control col-4" id="harga" name="harga" placeholder="Harga Makanan (Rp)" required />
                </div>

                <label for="deskripsi" class="form-label col-4 my-1">Deskripsi</label>
                <div class="col-8 my-1">
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi" required></textarea>
                </div>

                <button type="submit" name="addMenu" class="btn btn-primary w-auto"><i class="fa-regular fa-floppy-disk fa-beat me-2" style="color: #ffffff;"></i>Simpan</button>
            </div>
        </form>
    </main>
    <script src="./assets/js/bootstrap.min.js"></script>
</body>

</html>