<?php
session_start();
if (isset($_POST["panjang"]) && isset($_POST["lebar"]) && isset($_POST["nama"])) {
    $_SESSION['panjang'] = $_POST["panjang"];
    $_SESSION['lebar'] = $_POST["lebar"];
    $nama = $_POST["nama"];
    $luas = hitung($_SESSION['panjang'], $_SESSION['lebar']);
    $_SESSION['luas'] = $luas;

    setcookie("user", $nama, time() + 3600);

    $history = isset($_COOKIE["history"]) ? json_decode($_COOKIE["history"], true) : [];

    $new_entry = [
        "no" => count($history) + 1,
        "nama" => $nama,
        "panjang" => $_SESSION['panjang'],
        "lebar" => $_SESSION['lebar'],
        "luas" => $_SESSION['luas']
    ];


    $history[] = $new_entry;

    setcookie("history", json_encode($history), time() + 3600);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if (isset($_POST['hapus_history'])) {
    setcookie("history", "", time() - 3600);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


function hitung($a, $b)
{
    return $a * $b;
}

$history = isset($_COOKIE["history"]) ? json_decode($_COOKIE["history"], true) : [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card-body shadow-lg" style="max-width: 32rem; border-radius: 12px;">
            <div class="card-header bg-primary text-white text-center"
                style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h3 class="mb-0">Hasil Perhitungan</h3>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <h6 class="text-muted">Nama Cookie:</h6>
                    <p class="fs-5 <?= isset($_COOKIE['user']) ? 'text-dark' : 'text-danger' ?>">
                        <?= $_COOKIE['user'] ?? 'Tidak Ada' ?>
                    </p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Panjang:</h6>
                    <p class="fs-5"><?= $_SESSION['panjang'] ?? '<span class="text-muted">-</span>' ?> cm</p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Lebar:</h6>
                    <p class="fs-5"><?= $_SESSION['lebar'] ?? '<span class="text-muted">-</span>' ?> cm</p>
                </div>
                <div class="mb-3">
                    <h6 class="text-muted">Luas:</h6>
                    <p
                        class="fs-5 <?= isset($_SESSION['luas']) && $_SESSION['luas'] ? 'text-success' : 'text-muted' ?>">
                        <?= isset($_SESSION['luas']) && $_SESSION['luas'] ? $_SESSION['luas'] . ' cm²' : '-' ?>
                    </p>
                </div>
            </div>
            <div class="card-footer bg-light text-center py-3"
                style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <form action="sessionf.php" method="get">
                    <button type="submit" class="btn btn-success btn-lg w-100">Kembali</button>
                </form>
            </div>
        </div>

        <!-- Riwayat -->
        <div class="card-body p-4">
            <h5 class="text-center mb-3">Riwayat Perhitungan</h5>
            <ul class="list-group">
                <?php if (!empty($history)): ?>
                <?php foreach ($history as $item): ?>
                <li class="list-group-item">
                    <strong><?= htmlspecialchars($item["no"]) ?>. <?= htmlspecialchars($item['nama']) ?></strong> :
                    Panjang = <?= htmlspecialchars($item['panjang']) ?> cm,
                    Lebar = <?= htmlspecialchars($item['lebar']) ?> cm,
                    Luas = <?= htmlspecialchars($item['luas']) ?> cm²
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                <li class="list-group-item text-muted">Belum ada riwayat perhitungan</li>
                <?php endif; ?>
            </ul>
            <form method="post" class="d-inline">
                <button type="submit" name="hapus_history" class="btn btn-danger btn-lg w-100 mb-2">Hapus Semua
                    Riwayat</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>