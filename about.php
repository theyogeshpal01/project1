<?php 
$pageTitle = "About Us | LASA Consultants & Organisation";
$pageDesc = "Learn more about LASA Consultants & Organisation, our expertise, and why we are the preferred choice for integrated advisory services.";

ob_start();
?>
    <style>
        /* Premium About Page Styles */
        .about-hero {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1c2a4d 100%);
            padding: 120px 0 100px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 50% 50%, rgba(184, 134, 11, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .about-hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
            animation: fadeInUp 1s ease-out;
        }

        .about-hero .underline {
            width: 100px;
            height: 4px;
            background: var(--primary-color);
            margin: 0 auto 30px;
            border-radius: 2px;
            animation: scaleIn 1s ease-out 0.3s both;
        }

        .about-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 850px;
            margin: 0 auto;
            line-height: 1.6;
            font-weight: 300;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .content-section {
            padding: 100px 0;
            background: var(--bg-color);
        }

        .content-block {
            margin-bottom: 80px;
            opacity: 0;
            transform: translateY(30px);
            transition: var(--transition);
        }

        .content-block.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .content-block h2 {
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: 30px;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .content-block h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--primary-color);
        }

        .content-text {
            color: var(--text-color);
            line-height: 1.9;
            font-size: 1.05rem;
        }

        .content-text p {
            margin-bottom: 25px;
        }

        .intersection-grid, .why-choose-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 40px;
        }

        .check-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            font-size: 1.05rem;
            color: var(--text-color);
            padding: 15px;
            background: var(--card-bg);
            border-radius: 10px;
            transition: var(--transition);
            border: 1px solid var(--glass-border);
            border-left: 4px solid transparent;
        }

        .check-item:hover {
            transform: translateX(10px);
            background: var(--bg-color);
            box-shadow: var(--shadow);
            border-left-color: var(--primary-color);
        }

        .check-item i {
            color: var(--primary-color);
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .practice-areas {
            margin-top: 80px;
        }

        .practice-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .practice-card {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            color: var(--text-color);
            transition: var(--transition);
            border: 1px solid var(--glass-border);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .practice-card:hover {
            background: var(--secondary-color);
            color: #fff;
            border-color: var(--secondary-color);
            box-shadow: var(--shadow);
            transform: translateY(-8px) scale(1.02);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes scaleIn {
            from { transform: scaleX(0); }
            to { transform: scaleX(1); }
        }

        @media (max-width: 992px) {
            .intersection-grid, .why-choose-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .practice-grid {
                grid-template-columns: 1fr;
            }
            .about-hero h1 {
                font-size: 2.2rem;
            }
        }
    </style>
<?php 
$extraStyles = ob_get_clean();

ob_start();
?>
    <script>
        // Simple Intersection Observer for scroll animations
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.content-block').forEach(block => {
                observer.observe(block);
            });
        });
    </script>
<?php 
$extraScripts = ob_get_clean();

include 'header.php'; 
?>

    <!-- About Hero Section -->
    <section class="about-hero" style="margin-top: 80px;">
        <div class="container">
            <h1>LASA CONSULTANTS & ORGANISATION</h1>
            <div class="underline"></div>
            <p>Integrated Legal, Business, Strategic, Healthcare, Environmental & Skill Development Advisory</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="content-section">
        <div class="container">
            <!-- Who We Are -->
            <div class="content-block">
                <h2>Who We Are</h2>
                <div class="content-text">
                    <p>Lasa Consultants & Organisation is a Jaipur-based integrated consultancy and professional services organisation delivering legal, business, procurement, governance, healthcare, intellectual property, environmental and skill-development solutions across India.</p>
                    <p>LASA Consultants & Organisation delivers compliance-driven legal research, business consultancy, public procurement and GeM advisory, tender & bid support, infrastructure and healthcare project advisory, election campaign management with branding & promotions, intellectual property compliance, environmental & sustainability advisory, and industry-oriented education, training & placement solutions for individuals, startups, MSMEs, corporates, institutions, healthcare providers and government-linked projects across India.</p>
                    <p>Our solutions are legally sound, commercially viable, operationally executable, ethically compliant and sector-specific.</p>
                </div>
            </div>

            <!-- Intersection -->
            <div class="content-block">
                <h2>We operate at the intersection of:</h2>
                <div class="intersection-grid">
                    <div class="column">
                        <div class="check-item"><i class="fas fa-check"></i> Law & compliance</div>
                        <div class="check-item"><i class="fas fa-check"></i> Public procurement & GeM</div>
                        <div class="check-item"><i class="fas fa-check"></i> Healthcare & emergency services</div>
                        <div class="check-item"><i class="fas fa-check"></i> Trademark & intellectual property protection</div>
                        <div class="check-item"><i class="fas fa-check"></i> Education, training & workforce development</div>
                    </div>
                    <div class="column">
                        <div class="check-item"><i class="fas fa-check"></i> Business & corporate strategy</div>
                        <div class="check-item"><i class="fas fa-check"></i> Infrastructure & technical projects</div>
                        <div class="check-item"><i class="fas fa-check"></i> Elections, campaigns, branding & promotions</div>
                        <div class="check-item"><i class="fas fa-check"></i> Energy, environment & sustainability compliance</div>
                    </div>
                </div>
            </div>

            <!-- Why Choose LASA -->
            <div class="content-block" style="margin-top: 60px;">
                <h2>Why Choose LASA</h2>
                <div class="why-choose-grid">
                    <div class="column">
                        <div class="check-item"><i class="fas fa-check"></i> 10+ years of multidisciplinary experience</div>
                        <div class="check-item"><i class="fas fa-check"></i> Public procurement, GeM & tender expertise</div>
                        <div class="check-item"><i class="fas fa-check"></i> Election campaigns, branding & promotion consultancy</div>
                        <div class="check-item"><i class="fas fa-check"></i> Energy, water, air & environmental compliance advisory</div>
                        <div class="check-item"><i class="fas fa-check"></i> Industry-aligned training & placement ecosystem</div>
                        <div class="check-item"><i class="fas fa-check"></i> Transparent, scalable & retainer-friendly engagement models</div>
                    </div>
                    <div class="column">
                        <div class="check-item"><i class="fas fa-check"></i> Startup, MSME, enterprise & healthcare-focused advisory</div>
                        <div class="check-item"><i class="fas fa-check"></i> Hospital, ambulance & EMS compliance support</div>
                        <div class="check-item"><i class="fas fa-check"></i> Trademark, IPR & regulatory compliance support</div>
                        <div class="check-item"><i class="fas fa-check"></i> Ethics-driven, non-litigation consultancy model</div>
                        <div class="check-item"><i class="fas fa-check"></i> Pan-India senior expert & consultant network</div>
                    </div>
                </div>
            </div>

            <!-- Core Practice Areas -->
            <div class="practice-areas">
                <h2>Core Practice Areas</h2>
                <p style="margin-bottom: 30px; color: #666;">A quick view of our specialized services designed to drive growth and compliance.</p>
                <div class="practice-grid">
                    <div class="practice-card">Startup & Corporate Advisory</div>
                    <div class="practice-card">Taxation, GST & ITR Services</div>
                    <div class="practice-card">Tender, Bid & Procurement Advisory</div>
                    <div class="practice-card">GeM & e-Procurement Consultancy</div>
                    <div class="practice-card">Infrastructure & Project Advisory</div>
                    <div class="practice-card">Hospital, Healthcare & Ambulance Advisory</div>
                    <div class="practice-card">Election Campaign & Branding</div>
                    <div class="practice-card">Trademark & IPR Advisory</div>
                    <div class="practice-card">Energy & Sustainability Advisory</div>
                    <div class="practice-card">Compliance, Risk & Governance</div>
                    <div class="practice-card">Education & Training Academy</div>
                </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
