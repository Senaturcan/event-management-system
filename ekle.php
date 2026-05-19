<?php include "db.php"; ?>

<h2>Film Ekle</h2>

<form method="POST">
    Film Adı: <input type="text" name="title"><br><br>
    Tür: <input type="text" name="type"><br><br>
    Kategori: <input type="text" name="genre"><br><br>
    Yıl: <input type="number" name="year"><br><br>

    Durum:
    <select name="status">
        <option>İzledim</option>
        <option>İzleyeceğim</option>
    </select><br><br>

    <button type="submit">Ekle</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST["title"];
    $type = $_POST["type"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];
    $status = $_POST["status"];

    if (empty($title) || empty($type) || empty($genre) || empty($year) || empty($status)) {
        echo "<div class='alert alert-danger'>Tüm alanları doldur!</div>";
    } else {
        $sql = "INSERT INTO movies (title, type, genre, year, status)
                VALUES ('$title', '$type', '$genre', '$year', '$status')";

        if ($baglanti->query($sql) === TRUE) {
            header("Location: listele.php?mesaj=eklendi"); 
            exit();
        } else {
            echo "<div class='alert alert-danger'>Hata oluştu!</div>";
        }
    }
}
?>