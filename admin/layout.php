<?php
// admin/layout.php
session_start();

// Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

function render_admin_layout($content, $page_title = 'Dashboard')
{
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?> | LASA Admin</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #B8860B;
                --primary-light: #D4AF37;
                --secondary-color: #0B132B;
                --sidebar-width: 280px;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                background: #f4f7f6;
                color: #333;
                font-family: 'Outfit', sans-serif;
                overflow-x: hidden;
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: #cbd5e0;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #a0aec0;
            }

            /* Sidebar Styles */
            .sidebar {
                width: var(--sidebar-width);
                background: #0B132B;
                color: white;
                position: fixed;
                height: 100vh;
                left: 0;
                top: 0;
                z-index: 1100;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                flex-direction: column;

            }

            .sidebar-header {
                padding: 30px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                text-align: center;
            }

            .sidebar-header img {
                height: 40px;
                margin-bottom: 10px;
            }

            .sidebar-header h2 {
                font-size: 0.85rem;
                letter-spacing: 2px;
                font-weight: 700;
                color: var(--primary-color);
                margin: 0;
                text-transform: uppercase;
            }

            .sidebar-menu {
                flex-grow: 1;
                flex-direction: column;
                justify-content: start;
                padding: 10px 0;
                overflow-y: auto;
            }

            .menu-item {
                padding: 14px 25px;
                width: 100%;
                display: flex;
                align-items: center;
                gap: 15px;
                color: rgba(255, 255, 255, 0.6);
                text-decoration: none;
                transition: all 0.2s ease;
                border-left: 3px solid transparent;
                font-size: 0.95rem;
            }

            .menu-item i {
                width: 20px;
                font-size: 1.1rem;
                text-align: center;
            }

            .menu-item:hover,
            .menu-item.active {
                color: white;
                background: rgba(255, 255, 255, 0.03);
                border-left-color: var(--primary-color);
            }

            .menu-item.active {
                background: rgba(184, 134, 11, 0.08);
                color: var(--primary-light);
            }

            /* Main Content Styles */
            .main-content {
                margin-left: var(--sidebar-width);
                flex-grow: 1;
                min-height: 100vh;
                transition: all 0.3s ease;
                width: calc(100% - var(--sidebar-width));
                padding: 30px;
            }

            .top-bar {
                background: white;
                padding: 15px 30px;
                margin: -30px -30px 30px -30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
                position: sticky;
                top: 0;
                z-index: 1000;
            }

            .top-bar h1 {
                font-size: 1.3rem;
                color: #0B132B;
                font-weight: 700;
                margin: 0;
            }

            .mobile-toggle {
                display: none;
                cursor: pointer;
                font-size: 1.4rem;
                color: #0B132B;
            }

            .user-profile {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
                background: #f0f2f5;
                color: var(--primary-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                font-size: 0.9rem;
                border: 1px solid #eee;
            }

            /* Dashboard Cards */
            .admin-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 25px;
                margin-bottom: 30px;
            }

            .card {
                background: white;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
                display: flex;
                align-items: center;
                justify-content: space-between;
                transition: transform 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .card-icon {
                width: 50px;
                height: 50px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
            }

            /* Generic Table Styles */
            .data-box {
                background: white;
                border-radius: 15px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
                overflow: hidden;
            }

            .data-box-header {
                padding: 25px 30px;
                border-bottom: 1px solid #f0f0f0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th {
                text-align: left;
                padding: 15px 30px;
                background: #fafafa;
                color: #888;
                font-size: 0.8rem;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            td {
                padding: 20px 30px;
                border-bottom: 1px solid #f8f8f8;
                font-size: 0.95rem;
                color: #444;
            }

            /* Responsive Utilities */
            @media (max-width: 992px) {
                .sidebar {
                    transform: translateX(-100%);
                }
                /* End Sidebar */
                .sidebar.open {
                    transform: translateX(0);
                }

                .main-content {
                    margin-left: 0;
                    width: 100%;
                }

                .mobile-toggle {
                    display: block;
                }
            }
        </style>
        <script>
            function toggleSidebar() {
                document.querySelector('.sidebar').classList.toggle('open');
            }
        </script>
    </head>

    <body>
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="../lasa_logo_1778423166023.png" alt="Logo">
                <h2>ADMIN PORTAL</h2>
            </div>
            <nav class="sidebar-menu">
                <a href="index.php" class="menu-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="contacts.php" class="menu-item <?php echo ($current_page == 'contacts.php') ? 'active' : ''; ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Submissions</span>
                </a>
                <a href="settings.php" class="menu-item <?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
                <a href="../index.php" class="menu-item">
                    <i class="fas fa-globe"></i>
                    <span>Live Site</span>
                </a>
            </nav>
            <div style="padding: 20px;">
                <a href="logout.php" class="menu-item"
                    style="background: rgba(255,255,255,0.05); border-radius: 10px; border: none;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <main class="main-content">
            <div class="top-bar">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div class="mobile-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h1><?php echo $page_title; ?></h1>
                </div>
                <div class="user-profile">
                    <span>Welcome, <strong>Admin</strong></span>
                    <div class="user-avatar">A</div>
                </div>
            </div>

            <?php echo $content; ?>
        </main>

        <script src="../script.js"></script>
    </body>

    </html>
    <?php
}
?>