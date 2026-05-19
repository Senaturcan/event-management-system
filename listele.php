<?php 
include "db.php"; 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<h2 class="text-center mb-4">Film Listesi</h2>

<?php
if (isset($_GET['mesaj'])) {
    if ($_GET['mesaj'] == "eklendi") {
        echo "<div class='alert alert-success text-center'>Film eklendi!</div>";
    } elseif ($_GET['mesaj'] == "silindi") {
        echo "<div class='alert alert-danger text-center'>Film silindi!</div>";
    } elseif ($_GET['mesaj'] == "guncellendi") {
        echo "<div class='alert alert-warning text-center'>Film güncellendi!</div>";
    }
}
?>

<form method="GET" class="mb-4">
    <div class="row w-75 mx-auto">
        
        <div class="col">
            <input type="text" name="search" class="form-control" placeholder="Film ara...">
        </div>

        <div class="col">
            <select name="status" class="form-control">
                <option value="">Tümü</option>
                <option value="İzledim">İzledim</option>
                <option value="İzleyeceğim">İzleyeceğim</option>
            </select>
        </div>

        <div class="col">
            <button class="btn btn-primary w-100">Filtrele</button>
        </div>

    </div>
</form>

<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>Ad</th>
        <th>Tür</th>
        <th>Kategori</th>
        <th>Yıl</th>
        <th>Durum</th>
        <th>İşlem</th>
    </tr>

<?php
$search = isset($_GET['search']) ? $_GET['search'] : "";
$status = isset($_GET['status']) ? $_GET['status'] : "";

$sql = "SELECT * FROM movies WHERE 1";

if ($search != "") {
    $sql .= " AND title LIKE '%$search%'";
}

if ($status != "") {
    $sql .= " AND status='$status'";
}

$result = $baglanti->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['type']}</td>
            <td>{$row['genre']}</td>
            <td>{$row['year']}</td>
            <td>{$row['status']}</td>
            <td>
                <a href='duzenle.php?id={$row['id']}' class='btn btn-warning btn-sm'>Düzenle</a>
                <a href='sil.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Silmek istediğine emin misin?')\">Sil</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>Kayıt yok</td></tr>";
}
?>

</table>