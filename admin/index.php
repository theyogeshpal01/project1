<?php
// admin/index.php
require_once 'layout.php';

$contacts_file = '../contacts.json';
$submissions = [];
if (file_exists($contacts_file)) {
    $submissions = json_decode(file_get_contents($contacts_file), true);
}
if (!is_array($submissions)) $submissions = [];

$total = count($submissions);
$new = 0;
foreach($submissions as $s) if($s['status'] == 'new') $new++;

$uploads_file = '../uploads.json';
$uploads_count = 0;
if (file_exists($uploads_file)) {
    $history = json_decode(file_get_contents($uploads_file), true);
    if (is_array($history)) $uploads_count = count($history);
}

ob_start();
?>

<div class="admin-cards">
    <div class="card">
        <div>
            <p style="color: #888; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 5px;">Total Messages</p>
            <h3 style="font-size: 2rem; margin: 0;"><?php echo $total; ?></h3>
        </div>
        <div class="card-icon" style="background: #e1f5fe; color: #0288d1;">
            <i class="fas fa-envelope-open-text"></i>
        </div>
    </div>
    <div class="card">
        <div>
            <p style="color: #888; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 5px;">Pending Inquiries</p>
            <h3 style="font-size: 2rem; margin: 0;"><?php echo $new; ?></h3>
        </div>
        <div class="card-icon" style="background: #fff8e1; color: #ffab00;">
            <i class="fas fa-clock"></i>
        </div>
    </div>
    <div class="card">
        <div>
            <p style="color: #888; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 5px;">PDF Uploads</p>
            <h3 style="font-size: 2rem; margin: 0;"><?php echo $uploads_count; ?></h3>
        </div>
        <div class="card-icon" style="background: #e8f5e9; color: #43a047;">
            <i class="fas fa-file-pdf"></i>
        </div>
    </div>
    <div class="card">
        <div>
            <p style="color: #888; font-size: 0.85rem; text-transform: uppercase; margin-bottom: 5px;">Conversion Rate</p>
            <h3 style="font-size: 2rem; margin: 0;">100%</h3>
        </div>
        <div class="card-icon" style="background: #f3e5f5; color: #7b1fa2;">
            <i class="fas fa-magic"></i>
        </div>
    </div>
</div>

<div class="data-box">
    <div class="data-box-header">
        <h2 style="font-size: 1.1rem; font-weight: 700;">Recent Submissions</h2>
        <a href="contacts.php" style="color: var(--primary-color); font-weight: 600; font-size: 0.9rem;">View All &rarr;</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Organization</th>
                <th>Subject</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $recent = array_slice($submissions, 0, 5);
            if(count($recent) > 0): 
                foreach($recent as $s): 
            ?>
                <tr>
                    <td><?php echo date('d M, H:i', strtotime($s['date'])); ?></td>
                    <td><strong><?php echo $s['org_name']; ?></strong></td>
                    <td><?php echo $s['subject']; ?></td>
                    <td>
                        <span style="padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; background: #e1f5fe; color: #0288d1;">
                            <?php echo strtoupper($s['status']); ?>
                        </span>
                    </td>
                </tr>
            <?php 
                endforeach; 
            else: 
            ?>
                <tr>
                    <td colspan="4" style="text-align: center; padding: 40px; color: #aaa;">No recent activity.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
render_admin_layout($content, 'Dashboard Overview');
?>
