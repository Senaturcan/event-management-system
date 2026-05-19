<?php
include "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM movies WHERE id=$id";

    if ($baglanti->query($sql)) {
        header("Location: listele.php?mesaj=silindi");
        exit();
    } else {
        echo "Silme işlemi başarısız";
    }
} else {
    echo "ID bulunamadı";
}
?>