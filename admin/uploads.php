<?php
// admin/uploads.php
require_once 'layout.php';

$uploads_file = '../uploads.json';
$history = [];
if (file_exists($uploads_file)) {
    $history = json_decode(file_get_contents($uploads_file), true);
}
if (!is_array($history)) $history = [];

// Sort by date descending
usort($history, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

ob_start();
?>

<div class="data-box">
    <div class="data-box-header">
        <h2 style="font-size: 1.1rem; font-weight: 700;">PDF Upload History</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date Uploaded</th>
                <th>Original Filename</th>
                <th>System Filename</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($history) > 0): ?>
                <?php foreach($history as $h): ?>
                    <tr>
                        <td><?php echo date('d M Y, H:i', strtotime($h['date'])); ?></td>
                        <td><strong><?php echo htmlspecialchars($h['original_name']); ?></strong></td>
                        <td><small><?php echo htmlspecialchars($h['filename']); ?></small></td>
                        <td>
                            <span style="background: #C1E1A6; color: #0B132B; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700;">
                                <?php echo strtoupper($h['status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="../generate-excel.php?file=<?php echo urlencode($h['filename']); ?>" class="btn-action" style="text-decoration: none;">
                                <i class="fas fa-file-excel"></i> Re-Export
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #aaa;">No upload history found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
render_admin_layout($content, 'Upload History');
?>
