<?php
include "db.php";

$status = '';
$error = '';

if (!isset($_GET['token']) || empty($_GET['token'])) {
    $error = "Token tidak valid. Silakan request CV terlebih dahulu.";
} else {
    $token = $_GET['token'];
    $stmt = $conn->prepare("SELECT * FROM cv_requests WHERE token=?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        $error = "Token tidak ditemukan. Link mungkin sudah tidak berlaku.";
    } else {
        $status = $data['status'];
    }
}

if ($status === 'approved' && isset($_GET['download'])) {
    $cvPath = __DIR__ . '/assets/cv/cv_artham.pdf';
    if (file_exists($cvPath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="CV_Artham.pdf"');
        header('Content-Length: ' . filesize($cvPath));
        readfile($cvPath);
        exit;
    } else {
        $error = "File CV belum tersedia. Silakan hubungi admin.";
        $status = 'approved';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Download CV — Artham Portfolio</title>
  <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>

  <div class="request-page">
    <div class="request-card" style="text-align:center;">

      <?php if ($error): ?>
        <h2>❌ Error</h2>
        <p class="request-subtitle"><?php echo htmlspecialchars($error); ?></p>
        <a href="request_cv.php" class="submit-btn" style="display:inline-block; text-decoration:none; margin-top:16px;">Request CV</a>

      <?php elseif ($status === 'pending'): ?>
        <h2>⏳ Menunggu Approval</h2>
        <p class="request-subtitle">
          Request CV kamu masih dalam review. Silakan cek kembali nanti menggunakan link yang sama.
        </p>
        <div style="padding:20px; background:rgba(255,186,0,0.08); border:1px solid rgba(255,186,0,0.15); border-radius:12px; margin:16px 0;">
          <p style="color:#ffba00; font-size:0.85rem;">Status: <strong>Pending</strong></p>
        </div>

      <?php elseif ($status === 'approved'): ?>
        <h2>✅ Disetujui!</h2>
        <p class="request-subtitle">
          Request CV kamu telah disetujui! Klik tombol di bawah untuk mendownload.
        </p>
        <a href="download_cv.php?token=<?php echo htmlspecialchars($token); ?>&download=1" class="cv-btn" style="display:inline-flex; margin-top:16px;">
          📥 Download CV
        </a>

      <?php elseif ($status === 'rejected'): ?>
        <h2>🚫 Ditolak</h2>
        <p class="request-subtitle">
          Maaf, request CV kamu ditolak. Silakan hubungi saya jika ada pertanyaan.
        </p>

      <?php endif; ?>

      <a href="index.php" class="back-link" style="margin-top:24px;">← Kembali ke Portfolio</a>
    </div>
  </div>

</body>
</html>
