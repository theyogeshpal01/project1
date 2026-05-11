<?php
// admin/settings.php
require_once 'layout.php';

ob_start();
?>

<div class="data-box" style="padding: 40px; text-align: center;">
    <div style="font-size: 4rem; color: #eee; margin-bottom: 20px;">
        <i class="fas fa-tools"></i>
    </div>
    <h2 style="color: #0B132B; margin-bottom: 10px;">Portal Settings</h2>
    <p style="color: #888; max-width: 400px; margin: 0 auto 30px;">This module is under development. Soon you will be able to manage users, site configurations, and notification settings from here.</p>
    <a href="index.php" class="btn-insights" style="display: inline-block;">Back to Dashboard</a>
</div>

<?php
$content = ob_get_clean();
render_admin_layout($content, 'Settings');
?>
