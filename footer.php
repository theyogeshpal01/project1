<!-- Newsletter -->
<section class="newsletter" style="background: var(--secondary-color); padding: 60px 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 30px;">
            <div style="color: white;">
                <h2 style="font-size: 2rem; margin-bottom: 5px;">Subscribe To Our Newsletter</h2>
                <p style="opacity: 0.7;">Stay ahead with expert insights on the latest industry trends.</p>
            </div>
            <form class="newsletter-form">
                <input type="email" placeholder="Your Email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-logo">
                <img src="lasa_logo_1778423166023.png" alt="LASA Logo">
                <p style="opacity: 0.7; font-size: 0.9rem;">
                    <?php echo $_ENV['APP_NAME'] ?? 'Lasa Consultants & Organisations'; ?></p>
                <p style="opacity: 0.7; font-size: 0.8rem; margin-top: 10px;">
                    <?php echo $_ENV['ADMIN_EMAIL'] ?? 'lasainfra@hotmail.com'; ?></p>
                <p style="opacity: 0.7; font-size: 0.8rem;">+91-9694919394</p>
                <p style="opacity: 0.7; font-size: 0.8rem;">Jaipur, Rajasthan - 302026</p>
            </div>

            <div class="footer-links">
                <h4>QUICK LINKS</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="services.php">Our Services</a></li>
                    <li><a href="academy.php">Training & Academy</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>RESOURCES</h4>
                <ul>
                    <li><a href="contact.php">Schedule Consultation</a></li>
                    <li><a href="insights.php">Insights & Blogs</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="upload.php">Upload PDF</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>OUR LOCATION</h4>
                <div style="width: 100%; height: 150px; background: #333; border-radius: 10px; overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d113911.33463893046!2d75.713888!3d26.912434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db6123830fd15%3A0x6fb525043f2f845a!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1715360000000!5m2!1sen!2sin"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
        <!-- <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $_ENV['APP_NAME'] ?? 'Lasa Consultants & Organizations'; ?>. All rights reserved.</p>
            </div> -->

    </div>
</footer>

<!-- Processing Overlay (Global) -->
<div id="processing-overlay">
    <div class="loader-container" style="text-align: center;">
        <div class="main-loader"
            style="width: 100px; height: 100px; border: 5px solid rgba(184, 134, 11, 0.2); border-top: 5px solid var(--primary-color); border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 30px;">
        </div>
        <div class="pulse-icon"
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); margin-top: -15px;">
            <i class="fas fa-file-pdf"
                style="font-size: 2.5rem; color: var(--primary-color); animation: pulse 1.5s infinite;"></i>
        </div>
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 10px; color: white;">Reading & Converting PDF...
        </h2>
        <p id="status-text" style="opacity: 0.8; font-size: 1.1rem; letter-spacing: 1px; color: white;">Analyzing
            Contract Structure</p>
        <div class="progress-bar-wrap"
            style="width: 300px; height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; margin: 30px auto; overflow: hidden;">
            <div id="progress-fill"
                style="width: 0%; height: 100%; background: var(--primary-color); transition: width 0.3s ease;"></div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="script.js"></script>
<?php if (isset($extraScripts))
    echo $extraScripts; ?>
</body>

</html>