<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

if (isset($_POST['action']) && isset($_POST['request_id'])) {
    $action = $_POST['action'];
    $request_id = (int)$_POST['request_id'];
    
    if ($action === 'approve' || $action === 'reject') {
        $status = ($action === 'approve') ? 'approved' : 'rejected';
        $stmt = $conn->prepare("UPDATE cv_requests SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $request_id);
        $stmt->execute();
        header("Location: dashboard.php?msg=" . $action . "d");
        exit;
    }
}

$total = $conn->query("SELECT COUNT(*) as c FROM cv_requests")->fetch_assoc()['c'] ?? 0;
$pending = $conn->query("SELECT COUNT(*) as c FROM cv_requests WHERE status='pending'")->fetch_assoc()['c'] ?? 0;
$approved = $conn->query("SELECT COUNT(*) as c FROM cv_requests WHERE status='approved'")->fetch_assoc()['c'] ?? 0;

$requests = $conn->query("SELECT * FROM cv_requests ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — Artham Portfolio</title>
  <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>

  <div class="dashboard-page">
    <div class="dash-header">
      <h1>📊 Dashboard Admin</h1>
      <div class="dash-actions">
        <a href="index.php">🏠 Portfolio</a>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </div>

    <div class="dash-content">
      <p style="color: var(--text-soft); margin-bottom: 30px;">
        Selamat datang, <strong style="color: var(--text-main);"><?php echo htmlspecialchars($_SESSION['admin']); ?></strong> 🎉
      </p>

      <?php if (isset($_GET['msg'])): ?>
        <div class="success-msg" style="max-width:400px; margin-bottom:20px;">
          Request berhasil di-<?php echo htmlspecialchars($_GET['msg']); ?>!
        </div>
      <?php endif; ?>

      <div class="dash-stats">
        <div class="stat-card">
          <div class="stat-number"><?php echo $total; ?></div>
          <div class="stat-label">Total Requests</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $pending; ?></div>
          <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?php echo $approved; ?></div>
          <div class="stat-label">Approved</div>
        </div>
      </div>

      <div class="dash-table-wrap">
        <h2>📋 CV Requests</h2>

        <?php if ($requests && $requests->num_rows > 0): ?>
        <table class="dash-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Alasan</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; while ($row = $requests->fetch_assoc()): ?>
            <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['email']); ?></td>
              <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                <?php echo htmlspecialchars($row['reason']); ?>
              </td>
              <td>
                <span class="status-badge <?php echo $row['status']; ?>">
                  <?php echo ucfirst($row['status']); ?>
                </span>
              </td>
              <td style="white-space:nowrap;"><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
              <td style="white-space:nowrap;">
                <?php if ($row['status'] === 'pending'): ?>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="action" value="approve" class="action-btn approve">✓ Approve</button>
                  </form>
                  <form method="POST" style="display:inline; margin-left:4px;">
                    <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="action" value="reject" class="action-btn reject">✗ Reject</button>
                  </form>
                <?php else: ?>
                  <span style="color: var(--text-dim); font-size:0.8rem;">—</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <?php else: ?>
          <div class="empty-state">
            <div class="empty-icon">📭</div>
            <p>Belum ada CV request.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</body>
</html>
