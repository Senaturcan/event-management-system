<?php
$baglanti = new mysqli("localhost", "root", "", "film_takip");

if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}
?>