<?php
// admin/contacts.php
require_once 'layout.php';

$contacts_file = '../contacts.json';
$submissions = [];
if (file_exists($contacts_file)) {
    $submissions = json_decode(file_get_contents($contacts_file), true);
}
if (!is_array($submissions)) $submissions = [];

ob_start();
?>

<style>
    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        padding: 40px;
        border-radius: 15px;
        max-width: 700px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    .btn-action {
        color: var(--primary-color);
        cursor: pointer;
        font-weight: 600;
    }
</style>

<div class="data-box">
    <div class="data-box-header">
        <h2 style="font-size: 1.1rem; font-weight: 700;">All Submissions</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Organization</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($submissions) > 0): ?>
                <?php foreach($submissions as $s): ?>
                    <tr>
                        <td><?php echo date('d M Y, H:i', strtotime($s['date'])); ?></td>
                        <td><strong><?php echo $s['org_name']; ?></strong></td>
                        <td><?php echo $s['email']; ?></td>
                        <td><?php echo $s['subject']; ?></td>
                        <td>
                            <span class="btn-action" onclick='viewMessage(<?php echo json_encode($s); ?>)'>View Details</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #aaa;">No submissions found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="messageModal" class="modal">
    <div class="modal-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <h2 id="modalTitle" style="margin: 0; color: #0B132B;"></h2>
            <span style="cursor: pointer; font-size: 1.5rem;" onclick="closeModal()">&times;</span>
        </div>
        <div id="modalBody" style="line-height: 1.8; color: #444;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                <div>
                    <p style="margin: 0; font-size: 0.8rem; color: #888; text-transform: uppercase;">Organization</p>
                    <p id="modalOrg" style="margin: 0; font-weight: 700; color: #0B132B;"></p>
                </div>
                <div>
                    <p style="margin: 0; font-size: 0.8rem; color: #888; text-transform: uppercase;">Email Address</p>
                    <p id="modalEmail" style="margin: 0; font-weight: 700; color: var(--primary-color);"></p>
                </div>
                <div>
                    <p style="margin: 0; font-size: 0.8rem; color: #888; text-transform: uppercase;">Date Received</p>
                    <p id="modalDate" style="margin: 0; font-weight: 700;"></p>
                </div>
                <div>
                    <p style="margin: 0; font-size: 0.8rem; color: #888; text-transform: uppercase;">Subject</p>
                    <p id="modalSubject" style="margin: 0; font-weight: 700;"></p>
                </div>
            </div>
            <p style="margin: 0; font-size: 0.8rem; color: #888; text-transform: uppercase; margin-bottom: 10px;">Message Content</p>
            <div id="modalMessage" style="background: #f9f9f9; padding: 25px; border-radius: 10px; white-space: pre-wrap;"></div>
        </div>
    </div>
</div>

<script>
    function viewMessage(data) {
        document.getElementById('modalTitle').innerText = 'Inquiry Details';
        document.getElementById('modalOrg').innerText = data.org_name;
        document.getElementById('modalEmail').innerText = data.email;
        document.getElementById('modalSubject').innerText = data.subject;
        document.getElementById('modalDate').innerText = data.date;
        document.getElementById('modalMessage').innerText = data.message;
        document.getElementById('messageModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('messageModal').style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('messageModal')) {
            closeModal();
        }
    }
</script>

<?php
$content = ob_get_clean();
render_admin_layout($content, 'All Submissions');
?>
