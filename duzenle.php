<?php include "db.php"; ?>

<?php
$id = $_GET['id'];

$sql = "SELECT * FROM movies WHERE id=$id";
$result = $baglanti->query($sql);
$row = $result->fetch_assoc();
?>

<h2>Film Güncelle</h2>

<form method="POST">
    Film Adı: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br><br>
    Tür: <input type="text" name="type" value="<?php echo $row['type']; ?>"><br><br>
    Kategori: <input type="text" name="genre" value="<?php echo $row['genre']; ?>"><br><br>
    Yıl: <input type="number" name="year" value="<?php echo $row['year']; ?>"><br><br>

    Durum:
    <select name="status">
        <option <?php if($row['status']=="İzledim") echo "selected"; ?>>İzledim</option>
        <option <?php if($row['status']=="İzleyeceğim") echo "selected"; ?>>İzleyeceğim</option>
    </select><br><br>

    <button type="submit" name="guncelle">Güncelle</button>
</form>

<?php
if (isset($_POST['guncelle'])) {

    $title = $_POST['title'];
    $type = $_POST['type'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];
    $status = $_POST['status'];

    if (empty($title) || empty($type) || empty($genre) || empty($year) || empty($status)) {
        echo "<div class='alert alert-danger'>Tüm alanları doldur!</div>";
    } else {
        $sql = "UPDATE movies SET 
            title='$title',
            type='$type',
            genre='$genre',
            year='$year',
            status='$status'
            WHERE id=$id";

        if ($baglanti->query($sql)) {
            header("Location: listele.php?mesaj=guncellendi");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Hata oluştu!</div>";
        }
    }
}
?>