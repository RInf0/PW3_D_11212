<?php
session_start();
//cek login
if (!isset($_SESSION["user"])) {
    header("Location: ./login.php");
    exit;
}

if (isset($_POST["addMenu"])) {
    if($_POST["kategori"] == "Appetizers"){
        $kategori = "assets/images/appetizers.jpeg";
    }else if($_POST["kategori"] == "Main Courses"){
        $kategori = "assets/images/mainCourses.jpeg";
    }else if($_POST["kategori"] == "Desserts"){
        $kategori = "assets/images/desserts.jpeg";
    }
    
    $menu = [
        "nama" => $_POST["nama"],
        "foodImg" => $kategori,
        "kategori" => $_POST["kategori"],
        "harga" => $_POST["harga"],
        "deskripsi" => $_POST["deskripsi"],
    ];

    $_SESSION["jmlMenu"][]=$menu;

    $_SESSION["success"] = "Berhasil menyimpan menu " . $menu["nama"];
    header("Location: ./dashboard.php");
    exit;
}

if (isset($_POST['delete_all'])) {
    $_SESSION['jmlMenu'] = [];
    header("Location: ./dashboard.php");
}
?>