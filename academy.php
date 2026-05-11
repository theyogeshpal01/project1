<?php 
$pageTitle = "LASA Academy | Education, Training & Placement";
$pageDesc = "Bridging the gap between education and industry requirements with specialized training and placement facilitation.";

ob_start();
?>
    <style>
        :root {
            --primary-color: #B8860B;
            --primary-light: #D4AF37;
            --secondary-color: #0B132B;
            --text-color: #333333;
            --text-light: #666666;
            --bg-color: #FFFFFF;
            --card-bg: #F8F9FA;
            --white: #FFFFFF;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Hero Section */
        .academy-hero {
            background: linear-gradient(135deg, #0B132B 0%, #1c2a4d 100%);
            padding: 120px 0 100px;
            text-align: center;
            color: white;
            position: relative;
        }

        .academy-hero h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: capitalize;
            letter-spacing: 1px;
        }

        .academy-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Overview Section */
        .academy-section {
            padding: 80px 0;
            background: #fff;
        }

        .section-header {
            margin-bottom: 50px;
        }

        .section-header h2 {
            font-size: 2.2rem;
            color: #0B132B;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .section-header p {
            color: #666;
            max-width: 900px;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 80px;
        }

        .overview-card {
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #eee;
            transition: var(--transition);
        }

        .overview-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .overview-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            display: block;
        }

        .overview-card span {
            font-size: 0.9rem;
            font-weight: 600;
            color: #444;
            line-height: 1.4;
        }

        /* Training Programs Grid */
        .programs-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 80px;
        }

        .program-card {
            background: #fff;
            padding: 35px;
            border-radius: 15px;
            border: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .program-card:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-md);
        }

        .program-card i {
            font-size: 1.8rem;
            color: var(--primary-color);
            opacity: 0.8;
        }

        .program-card h4 {
            font-size: 1.15rem;
            color: #0B132B;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .sub-list {
            list-style: none;
            padding: 0;
            margin-top: 15px;
            border-top: 1px solid #f0f0f0;
            padding-top: 15px;
        }

        .sub-list li {
            font-size: 0.9rem;
            color: #555;
            padding: 4px 0;
            position: relative;
            padding-left: 18px;
        }

        .sub-list li::before {
            content: '•';
            color: var(--primary-color);
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        /* Placement Section */
        .placement-box {
            background: #f0f7ff;
            border-radius: 20px;
            padding: 50px;
            border: 1px solid rgba(0, 102, 255, 0.1);
        }

        .placement-box h2 {
            font-size: 2.2rem;
            color: #0B132B;
            margin-bottom: 10px;
        }

        .placement-box .note {
            font-style: italic;
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 30px;
            display: block;
        }

        .btn-apply {
            background: #B8860B;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 40px;
            transition: var(--transition);
        }

        .btn-apply:hover {
            background: #8c6d31;
            transform: translateY(-2px);
        }

        .opportunities h4 {
            font-size: 1.2rem;
            color: #0B132B;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .opp-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 40px;
        }

        .opp-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 15px;
        }

        .opp-item::before {
            content: '•';
            color: var(--primary-color);
            font-weight: bold;
        }

        @media (max-width: 992px) {
            .overview-grid {
                grid-template-columns: 1fr 1fr;
            }
            .opp-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .overview-grid, .programs-grid {
                grid-template-columns: 1fr;
            }
            .placement-box {
                padding: 30px 20px;
            }
        }
    </style>
<?php 
$extraStyles = ob_get_clean();

include 'header.php'; 
?>

    <!-- Academy Hero Section -->
    <section class="academy-hero">
        <div class="container">
            <h1>Education, Training, Hiring & Placement Academy</h1>
            <p>Bridging the gap between education and industry requirements</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="academy-section">
        <div class="container">
            
            <!-- Academy Overview -->
            <div class="section-header">
                <h2>Academy Overview</h2>
                <p>The LASA Academy bridges the gap between education, employability and industry requirements across legal, corporate, procurement, healthcare, infrastructure, election, IPR and environmental sectors.</p>
            </div>

            <div class="overview-grid">
                <div class="overview-card">
                    <i class="fas fa-book-reader"></i>
                    <span>Industry-aligned curriculum</span>
                </div>
                <div class="overview-card">
                    <i class="fab fa-instagram"></i> <!-- Using similar icon from screenshot -->
                    <span>Practical skill development</span>
                </div>
                <div class="overview-card">
                    <i class="fas fa-user-tie"></i>
                    <span>Expert-led workshops</span>
                </div>
                <div class="overview-card">
                    <i class="fas fa-globe"></i>
                    <span>Cross-sector employability</span>
                </div>
            </div>

            <!-- Training Programs -->
            <div class="section-header">
                <h2>Training Programs</h2>
            </div>

            <div class="programs-grid">
                <!-- Legal & Compliance -->
                <div class="program-card-wrapper">
                    <div class="program-card">
                        <i class="fas fa-balance-scale"></i>
                        <div>
                            <h4>Legal & Compliance Training</h4>
                            <ul class="sub-list">
                                <li>Legal Research & Writing</li>
                                <li>Contract Management & Drafting</li>
                                <li>Statutory Compliance & Audit</li>
                                <li>Corporate Governance</li>
                                <li>Civil & Criminal Litigation Support</li>
                                <li>Family & Succession Law Advisory</li>
                                <li>Labor & Industrial Law Compliance</li>
                                <li>Alternative Dispute Resolution (ADR)</li>
                                <li>Real Estate & Property Law Compliance</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Corporate & Business -->
                <div class="program-card-wrapper">
                    <div class="program-card">
                        <i class="fas fa-briefcase"></i>
                        <div>
                            <h4>Corporate & Business Training</h4>
                            <ul class="sub-list">
                                <li>Strategic Business Planning</li>
                                <li>Public Procurement & GeM</li>
                                <li>Supply Chain & Operations Management</li>
                                <li>Risk Management & Mitigation</li>
                                <li>Financial Planning & Statutory Compliances</li>
                                <li>Human Resource Management & Policy Drafting</li>
                                <li>Corporate Social Responsibility (CSR)</li>
                                <li>Digital Transformation & IT Governance</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Facility, Infrastructure & Healthcare -->
                <div class="program-card-wrapper">
                    <div class="program-card">
                        <i class="fas fa-hospital"></i>
                        <div>
                            <h4>Facility, Infrastructure & Healthcare Training</h4>
                            <ul class="sub-list">
                                <li>Hospital Management & Operations</li>
                                <li>Healthcare Quality Standards (NABH/NABL)</li>
                                <li>Facility & Infrastructure Management</li>
                                <li>Biomedical Waste Management</li>
                                <li>Emergency Medical Services (EMS) Training</li>
                                <li>Patient Safety & Quality Care</li>
                                <li>Public Health Program Management</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Elections, Branding, IPR & Environment -->
                <div class="program-card-wrapper">
                    <div class="program-card">
                        <i class="fas fa-vote-yea"></i>
                        <div>
                            <h4>Elections, Branding, IPR & Environment Modules</h4>
                            <ul class="sub-list">
                                <li>Election Campaign Management & Strategy</li>
                                <li>Branding, Communication & PR</li>
                                <li>Intellectual Property Rights (IPR)</li>
                                <li>Environmental Impact Assessment (EIA)</li>
                                <li>Sustainability & Renewable Energy Advisory</li>
                                <li>Pollution Control & Waste Management</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Personal & Professional Development -->
                <div class="program-card-wrapper" style="grid-column: span 2;">
                    <div class="program-card">
                        <i class="fas fa-graduation-cap"></i>
                        <div>
                            <h4>Personal & Professional Development</h4>
                            <ul class="sub-list" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <li>Soft Skills & Communication Training</li>
                                <li>Leadership & Management Development</li>
                                <li>Emotional Intelligence & Workplace Wellness</li>
                                <li>Career Counseling & Placement Preparation</li>
                                <li>Ethics, Integrity & Professional Conduct</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hiring & Placement Services -->
            <div class="placement-box" id="placement">
                <h2>Hiring & Placement Services</h2>
                <span class="note">*Placement facilitation only. No employment guarantee.</span>
                
                <a href="#" class="btn-apply">Apply for Placement</a>

                <div class="opportunities">
                    <h4>Key Opportunities</h4>
                    <div class="opp-grid">
                        <div class="column">
                            <div class="opp-item">Industry-oriented placements</div>
                            <div class="opp-item">Healthcare, EMS & Infrastructure roles</div>
                        </div>
                        <div class="column">
                            <div class="opp-item">Legal, compliance, procurement & operations roles</div>
                            <div class="opp-item">Corporate hiring & manpower sourcing</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php include 'footer.php'; ?>
