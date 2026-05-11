<?php 
$pageTitle = "Contact Us | LASA Consultants & Organisation";
$pageDesc = "Get in touch with LASA Consultants & Organisation for integrated legal, business, and strategic advisory services.";

ob_start();
?>
    <style>
        :root {
            --primary-color: #B8860B;
            --primary-light: #D4AF37;
            --secondary-color: #0B132B;
            --form-bg: #0B132B; /* Dark navy for form card */
            --submit-btn: #C1E1A6; /* Lime green from screenshot */
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        .contact-hero {
            background: linear-gradient(135deg, #0B132B 0%, #1c2a4d 100%);
            padding: 100px 0 80px;
            text-align: center;
            color: white;
            position: relative;
        }

        .contact-hero h1 {
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .contact-hero .underline {
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            margin: 0 auto 30px;
        }

        .contact-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Contact Content */
        .contact-section {
            padding: 100px 0;
            background: #fff;
        }

        .contact-layout {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 80px;
            align-items: flex-start;
        }

        .reach-out h2 {
            font-size: 2.2rem;
            color: #0B132B;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .reach-out p {
            color: #555;
            line-height: 1.8;
            margin-bottom: 40px;
            font-size: 1.05rem;
        }

        .info-block h3 {
            font-size: 1.2rem;
            color: #0B132B;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .info-item {
            margin-bottom: 25px;
        }

        .info-item strong {
            display: block;
            font-size: 0.9rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .info-item span {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .info-item .address {
            color: #555;
            font-weight: 500;
        }

        /* Contact Form Card */
        .contact-card {
            background: var(--form-bg);
            padding: 50px;
            border-radius: 15px;
            color: white;
            box-shadow: var(--shadow-lg);
            margin-top: -120px; /* Overlap with hero */
            position: relative;
            z-index: 10;
        }

        .contact-card h3 {
            font-size: 1.8rem;
            margin-bottom: 35px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            opacity: 0.7;
            margin-bottom: 8px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 10px 0;
            color: white;
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-bottom-color: var(--primary-color);
        }

        .btn-send {
            width: 100%;
            background: var(--submit-btn);
            color: #0B132B;
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
        }

        .btn-send:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            filter: brightness(1.1);
        }

        @media (max-width: 992px) {
            .contact-layout {
                grid-template-columns: 1fr;
                gap: 50px;
            }
            .contact-card {
                margin-top: 0;
            }
        }
    </style>
<?php 
$extraStyles = ob_get_clean();

include 'header.php'; 
?>

    <!-- Contact Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1>Contact Us</h1>
            <div class="underline"></div>
            <p>Get in touch with our team for consultancy and support</p>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-layout">
                
                <!-- Reach Out Info -->
                <div class="reach-out">
                    <h2>Reach Out</h2>
                    <p>Ready to partner with Lasa for your legal talent and consulting needs? Contact us today to explore how we can support your growth and success.</p>
                    
                    <div class="info-block">
                        <h3>Contact Information</h3>
                        
                        <div class="info-item">
                            <strong>Email</strong>
                            <span>lasainfra@hotmail.com</span>
                        </div>
                        
                        <div class="info-item">
                            <strong>Phone</strong>
                            <span>+91-9694919394</span>
                        </div>
                        
                        <div class="info-item">
                            <strong>Address</strong>
                            <span class="address">Jaipur, Rajasthan - 302026</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-card">
                    <h3>Send us a message</h3>
                    <form action="process-contact.php" method="POST">
                        <div class="form-group">
                            <label>Organization Name*</label>
                            <input type="text" name="org_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address*</label>
                            <input type="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone">
                        </div>
                        
                        <div class="form-group">
                            <label>Subject*</label>
                            <input type="text" name="subject" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Message*</label>
                            <textarea name="message" rows="4" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-send">Send Message →</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
