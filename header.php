<?php
require_once __DIR__ . '/vendor/autoload.php';

// Load .env variables
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : ($_ENV['APP_NAME'] ?? 'LASA Consultants & Organisation'); ?></title>
    <meta name="description" content="<?php echo isset($pageDesc) ? $pageDesc : 'Integrated Legal, Business, Strategic, Healthcare, Environmental & Skill Development Advisory.'; ?>">

    
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php if(isset($extraStyles)) echo $extraStyles; ?>
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <a href="index.php"><img src="lasa_logo_1778423166023.png" alt="LASA Logo"></a>
                </div>
                <?php 
                    $current_page = basename($_SERVER['PHP_SELF']); 
                ?>
                <ul class="nav-links">
                    <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">About Us</a></li>
                    <li><a href="services.php" class="<?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">Our Services</a></li>
                    <li><a href="academy.php" class="<?php echo ($current_page == 'academy.php') ? 'active' : ''; ?>">Academy</a></li>
                    <li><a href="upload.php" class="<?php echo ($current_page == 'upload.php') ? 'active' : ''; ?>">Upload PDF</a></li>
                    <li><a href="contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact Us</a></li>
                </ul>
                <div class="nav-actions">
                    <div class="theme-toggle" id="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </div>
                    <a href="insights.php" class="btn-insights desktop-only">Get Insights</a>
                    <div class="menu-toggle" id="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </nav>
        </div>
    </header>
