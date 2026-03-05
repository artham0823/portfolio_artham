<?php
session_start();
include "db.php";

$success = false;
$error = '';
$token = '';

if (isset($_POST['submit'])) {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $reason = trim($_POST['reason']);

    if (empty($name) || empty($email) || empty($reason)) {
        $error = "Semua field harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        $token = bin2hex(random_bytes(32));
        
        $stmt = $conn->prepare("INSERT INTO cv_requests (name, email, reason, token) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $reason, $token);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Request CV — Artham Portfolio</title>
  <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>

  <div class="request-page">
    <div class="request-card">
      <?php if ($success): ?>
        <h2>✅ Request Terkirim!</h2>
        <p class="request-subtitle">
          Terima kasih! Request CV kamu sudah dikirim dan akan saya review.
          Simpan link di bawah ini untuk mengecek status dan mendownload CV setelah diapprove:
        </p>
        <div class="success-msg" style="word-break:break-all;">
          <a href="download_cv.php?token=<?php echo $token; ?>" style="color:#4cdf85; text-decoration:underline;">
            download_cv.php?token=<?php echo $token; ?>
          </a>
        </div>
        <p style="color: var(--text-dim); font-size: 0.8rem; text-align:center; margin-top:12px;">
          ⚠️ Bookmark atau salin link ini — kamu akan membutuhkannya nanti.
        </p>
        <a href="index.php" class="back-link">← Kembali ke Portfolio</a>
      <?php else: ?>
        <h2>📄 Request CV</h2>
        <p class="request-subtitle">
          Isi form di bawah untuk request CV saya. Setelah saya approve, kamu bisa mendownloadnya.
        </p>

        <?php if ($error): ?>
          <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama kamu" required
              value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email@contoh.com" required
              value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
          </div>

          <div class="form-group">
            <label for="reason">Alasan Request</label>
            <textarea id="reason" name="reason" placeholder="Kenapa kamu ingin melihat CV saya?" required><?php echo isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : ''; ?></textarea>
          </div>

          <button type="submit" name="submit" class="submit-btn">Kirim Request</button>
        </form>

        <a href="index.php" class="back-link">← Kembali ke Portfolio</a>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
