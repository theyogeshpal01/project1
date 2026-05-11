<?php 
$pageTitle = "Services & Practice Areas | LASA Consultants & Organisation";
$pageDesc = "Explore our specialized advisory services in Legal, Election Management, IPR, Healthcare, and Sustainability.";

ob_start();
?>
    <style>
        /* Hero Section */
        .services-hero {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #1c2a4d 100%);
            padding: 120px 0 100px;
            text-align: center;
            color: white;
            position: relative;
        }

        .services-hero h1 {
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .services-hero .underline {
            width: 100px;
            height: 4px;
            background: var(--primary-color);
            margin: 0 auto 30px;
        }

        .services-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Service Sections */
        .service-container {
            padding: 80px 0;
            background: var(--bg-color);
        }

        .service-block {
            margin-bottom: 100px;
            opacity: 0;
            transform: translateY(30px);
            transition: var(--transition);
        }

        .service-block.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .service-header {
            margin-bottom: 30px;
        }

        .service-header h2 {
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .service-header h3 {
            font-size: 1.1rem;
            color: var(--text-color);
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
        }

        .service-note {
            font-style: italic;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .service-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .elections-covered {
            background: var(--card-bg);
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--glass-border);
        }

        .elections-covered h4 {
            color: var(--text-color);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .elections-covered p {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* Key Services Box */
        .key-services-box {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 40px;
            border: 1px solid var(--glass-border);
            position: relative;
        }

        .key-services-box h4 {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .key-services-box h4::before {
            content: '';
            width: 5px;
            height: 20px;
            background: var(--primary-color);
            border-radius: 2px;
        }

        .services-list-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .service-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.95rem;
            color: var(--text-color);
            line-height: 1.5;
        }

        .service-item::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
            line-height: 1;
        }

        /* Sector styles */
        .sectors-info {
            margin-bottom: 25px;
            font-size: 1rem;
            color: var(--text-color);
        }

        .sectors-info strong {
            color: var(--primary-color);
        }

        @media (max-width: 992px) {
            .services-list-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .service-header h2 {
                font-size: 1.8rem;
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

            document.querySelectorAll('.service-block').forEach(block => {
                observer.observe(block);
            });
        });
    </script>
<?php 
$extraScripts = ob_get_clean();

include 'header.php'; 
?>

    <!-- Services Hero Section -->
    <section class="services-hero" style="margin-top: 80px;">
        <div class="container">
            <h1>Services & Practice Areas</h1>
            <div class="underline"></div>
            <p>Expert consultancy across legal, election management, IPR, and infrastructure sectors.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="service-container">
        <div class="container">
            
            <!-- Strategic & Election Campaign -->
            <div class="service-block">
                <div class="service-header">
                    <h2>Strategic & Election Campaign</h2>
                    <h3>Branding & Promotion Consultancy</h3>
                    <p class="service-note">Consulting & management support only. No political representation or solicitation.</p>
                </div>
                
                <div class="elections-covered">
                    <h4>Elections Covered</h4>
                    <p>Bar Councils, Trade Bodies, Chambers of Commerce, Cooperative Societies, Professional Councils, Associations, Unions, Federations, NGOs & Registered Societies.</p>
                </div>

                <div class="key-services-box">
                    <h4>Key Services</h4>
                    <div class="services-list-grid">
                        <div class="service-item">Election strategy & roadmap planning</div>
                        <div class="service-item">Booth / unit / district-wise planning</div>
                        <div class="service-item">Compliance-driven campaign execution</div>
                        <div class="service-item">Panel, meeting & rally coordination</div>
                        <div class="service-item">Stakeholder & voter data research</div>
                        <div class="service-item">Budget planning & fund utilization tracking</div>
                        <div class="service-item">Campaign branding, creatives & digital outreach</div>
                        <div class="service-item">Influencer & opinion leader mapping</div>
                    </div>
                </div>
            </div>

            <!-- Trademark & IPR Advisory -->
            <div class="service-block">
                <div class="service-header">
                    <h2>Trademark & Intellectual Property (IPR) Advisory</h2>
                    <p class="service-note">Documentation & coordination support only. Litigation through authorized professionals.</p>
                </div>

                <div class="key-services-box">
                    <h4>Key Services</h4>
                    <div class="services-list-grid">
                        <div class="service-item">Trademark search & classification advisory</div>
                        <div class="service-item">Reply drafting for objections & oppositions</div>
                        <div class="service-item">IP assignment & licensing documentation</div>
                        <div class="service-item">Trademark registration & renewal coordination</div>
                        <div class="service-item">Copyright registration advisory</div>
                        <div class="service-item">Brand protection strategy (non-litigous)</div>
                    </div>
                </div>
            </div>

            <!-- Energy, Environment & Sustainability -->
            <div class="service-block">
                <div class="service-header">
                    <h2>Energy, Environment & Sustainability Advisory</h2>
                    <div class="sectors-info">
                        <strong>Sectors:</strong> Industries, Hospitals, Infrastructure, Commercial Buildings, Government & Facility Projects.
                    </div>
                </div>

                <div class="key-services-box">
                    <h4>Key Services</h4>
                    <div class="services-list-grid">
                        <div class="service-item">Energy audit coordination</div>
                        <div class="service-item">Air & pollution compliance advisory</div>
                        <div class="service-item">Environmental impact documentation support</div>
                        <div class="service-item">Water audit & conservation advisory</div>
                        <div class="service-item">PCB compliance, CTE / CTO documentation</div>
                        <div class="service-item">ESG & Sustainability advisory</div>
                    </div>
                </div>
            </div>

            <!-- Hospital, Healthcare & Ambulance Services -->
            <div class="service-block">
                <div class="service-header">
                    <h2>Hospital, Healthcare & Ambulance Services Advisory</h2>
                    <h3>Hospital & Healthcare</h3>
                </div>

                <div class="key-services-box" style="margin-bottom: 40px;">
                    <h4>Key Services</h4>
                    <div class="services-list-grid">
                        <div class="service-item">Hospital registration & licensing advisory</div>
                        <div class="service-item">Fire, biomedical waste & pollution compliance</div>
                        <div class="service-item">Hospital SOPs & medico-legal formats</div>
                        <div class="service-item">Clinical Establishments Act compliance</div>
                        <div class="service-item">NABH / NABL documentation support (non-certifying)</div>
                        <div class="service-item">Healthcare GST & statutory compliance coordination</div>
                    </div>
                </div>

                <div class="service-header" style="margin-top: 60px;">
                    <h3>Ambulance & EMS</h3>
                </div>

                <div class="key-services-box">
                    <h4>Key Services</h4>
                    <div class="services-list-grid">
                        <div class="service-item">Ambulance registration & permit advisory</div>
                        <div class="service-item">State, PSU & NHM ambulance tender advisory</div>
                        <div class="service-item">SLA, penalty & contract compliance review</div>
                        <div class="service-item">Motor Vehicles Act & RTO compliance research</div>
                        <div class="service-item">GeM & e-procurement support for EMS</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php include 'footer.php'; ?>
