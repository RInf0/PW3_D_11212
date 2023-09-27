<?php
session_start();

if (isset($_POST['delMenu'])) {

    $index = $_POST['index'];
    $namaMenu = $_SESSION['jmlMenu'][$index]["nama"];

    unset($_SESSION['jmlMenu'][$index]);

    // re-index array
    $_SESSION['jmlMenu'] = array_values($_SESSION['jmlMenu']);
    $_SESSION["success"] = "Berhasil menghapus menu " . $namaMenu;
}

header('Location: ./dashboard.php');
