<?php
session_start();
include "config.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$nama = $pesawat = $kelas = "";
$harga = $jumlah = $total = 0;

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $kode = $_POST['kode'];
    $kelas = $_POST['kelas'];
    $jumlah = $_POST['jumlah'];

    if ($kode == "GRD") {
        $pesawat = "Garuda";
        if ($kelas == "Eksekutif")
            $harga = 1500000;
        elseif ($kelas == "Bisnis")
            $harga = 900000;
        else
            $harga = 500000;
    } elseif ($kode == "MPT") {
        $pesawat = "Merpati";
        if ($kelas == "Eksekutif")
            $harga = 1200000;
        elseif ($kelas == "Bisnis")
            $harga = 800000;
        else
            $harga = 400000;
    } else {
        $pesawat = "Batavia";
        if ($kelas == "Eksekutif")
            $harga = 1000000;
        elseif ($kelas == "Bisnis")
            $harga = 700000;
        else
            $harga = 300000;
    }

    $total = $harga * $jumlah;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tiket Online</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            padding: 25px;
            width: 380px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h3 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
        }

        input[type=text],
        select {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type=radio] {
            margin-right: 5px;
        }

        .radio-group {
            margin-bottom: 12px;
        }

        button,
        input[type=submit] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type=submit] {
            background: #16a34a;
            color: white;
        }

        input[type=submit]:hover {
            background: #15803d;
        }

        .batal {
            background: #dc2626;
            color: white;
        }

        .batal:hover {
            background: #b91c1c;
        }

        .hasil {
            margin-top: 15px;
            background: #f8fafc;
            padding: 12px;
            border-radius: 6px;
        }

        .hasil p {
            margin: 5px 0;
        }

        .logout {
            text-align: right;
            margin-bottom: 10px;
        }

        .logout a {
            text-decoration: none;
            color: #dc2626;
            font-size: 14px;
        }

        .hasil table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .hasil th {
            background: #2563eb;
            color: white;
            padding: 8px;
            text-align: left;
        }

        .hasil td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .hasil tr:nth-child(even) {
            background: #f1f5f9;
        }
    </style>
</head>

<body>

    <div class="card">

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>

        <h3>TIKET ONLINE</h3>

        <form method="post">
            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Kode Pesawat</label>
            <select name="kode">
                <option value="GRD">GRD - Garuda</option>
                <option value="MPT">MPT - Merpati</option>
                <option value="BTV">BTV - Batavia</option>
            </select>

            <label>Kelas</label>
            <div class="radio-group">
                <input type="radio" name="kelas" value="Eksekutif" checked> Eksekutif
                <input type="radio" name="kelas" value="Bisnis"> Bisnis
                <input type="radio" name="kelas" value="Ekonomi"> Ekonomi
            </div>

            <label>Jumlah Tiket</label>
            <select name="jumlah">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>

            <input type="submit" name="simpan" value="SIMPAN">
            <button type="button" class="batal" onclick="window.location.href=window.location.pathname">BATAL</button>
        </form>

        <?php if (isset($_POST['simpan'])): ?>
            <div class="hasil">
                <table>
                    <tr>
                        <th>Data</th>
                        <th>Keterangan</th>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td><?= $nama ?></td>
                    </tr>
                    <tr>
                        <td>Pesawat</td>
                        <td><?= $pesawat ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td><?= $kelas ?></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>Rp <?= number_format($harga, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><?= $jumlah ?></td>
                    </tr>
                    <tr>
                        <td><b>Total Bayar</b></td>
                        <td><b>Rp <?= number_format($total, 0, ',', '.') ?></b></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>