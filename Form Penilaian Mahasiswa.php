<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penilaian Mahasiswa</title>
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Container utama -->
    <div class="container mt-4 mb-5 px-5">
        <!-- Card form input -->
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>
            <div class="card-body">
                <!-- Form input nilai mahasiswa -->
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" name="nim">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" name="kehadiran" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" name="tugas" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" name="uts" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" name="uas" min="0" max="100">
                    </div>
                    <div class="d-grid gap-2">
                        <!-- Tombol proses -->
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>
                </form>

                <?php
                // Cek apakah tombol proses ditekan
                if (isset($_POST['proses'])) {
                    // Ambil nilai dari input form
                    $nama       = $_POST['nama'];
                    $nim        = $_POST['nim'];
                    $kehadiran  = $_POST['kehadiran'];
                    $tugas      = $_POST['tugas'];
                    $uts        = $_POST['uts'];
                    $uas        = $_POST['uas'];

                    // Validasi: jika ada kolom kosong
                    if ($nama == "" || $nim == "" || $kehadiran == "" || $tugas == "" || $uts == "" || $uas == "") {
                        // Tampilkan pesan error jika form tidak lengkap
                        echo '<div class="alert alert-danger mt-3">Semua kolom wajib diisi.</div>';
                    } else {
                        // Hitung nilai akhir berdasarkan bobot
                        $nilai_akhir = ($kehadiran * 0.10) + ($tugas * 0.20) + ($uts * 0.30) + ($uas * 0.40);

                        // Tentukan grade berdasarkan nilai akhir
                        if ($nilai_akhir >= 85) {
                            $grade = 'A';
                        } elseif ($nilai_akhir >= 75) {
                            $grade = 'B';
                        } elseif ($nilai_akhir >= 65) {
                            $grade = 'C';
                        } elseif ($nilai_akhir >= 50) {
                            $grade = 'D';
                        } else {
                            $grade = 'E';
                        }

                        // Tentukan status kelulusan
                        if ($nilai_akhir >= 70 && $kehadiran >= 70) {
                            $status = '<span class="text-success fw-bold">LULUS</span>';
                            $card_color = 'success'; // Warna hijau jika lulus
                        } else {
                            $status = '<span class="text-danger fw-bold">TIDAK LULUS</span>';
                            $card_color = 'danger'; // Warna merah jika tidak lulus
                        }

                        // Tampilkan hasil penilaian dalam card Bootstrap
                        echo '
                        <div class="card mt-4 border-' . $card_color . '">
                            <div class="card-header bg-' . $card_color . ' text-white fw-bold">Hasil Penilaian</div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <strong>Nama: ' . htmlspecialchars($nama) . '</strong>
                                    <strong>NIM: ' . htmlspecialchars($nim) . '</strong>
                                </div>
                                <hr>
                                <p>Nilai Kehadiran: ' . $kehadiran . '%</p>
                                <p>Nilai Tugas: ' . $tugas . '</p>
                                <p>Nilai UTS: ' . $uts . '</p>
                                <p>Nilai UAS: ' . $uas . '</p>
                                <p><strong>Nilai Akhir: ' . number_format($nilai_akhir, 2) . '</strong></p>
                                <p>Grade: ' . $grade . '</p>
                                <p>Status: ' . $status . '</p>
                                <div class="d-grid mt-3">
                                    <!-- Tombol selesai -->
                                    <a href="" class="btn btn-' . $card_color . '">Selesai</a>
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
