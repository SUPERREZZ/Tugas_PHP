<?php
setcookie("user", "", time() + 3600);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Luas Persegi Panjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body>
    <form method="post" action="session.php" class="container mt-5">
        <p class="text-center fs-3">Program hitung Luas Persegi Panjang</p>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama </label>
            <input type="text" class="form-control" name="nama" id="nama" required />
        </div>
        <div class="mb-3">
            <label for="panjang" class="form-label">Panjang</label>
            <input type="number" class="form-control" id="panjang" name="panjang" />
        </div>
        <div class="mb-3">
            <label for="lebar" class="form-label">Lebar</label>
            <input type="number" inputmode="numeric" class="form-control" name="lebar" id="lebar" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>