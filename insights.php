<?php 
$pageTitle = "Insights & Blogs | LASA Consultants & Organisation";
$pageDesc = "Expert perspectives on law, business, governance, and compliance.";

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
        .insights-hero {
            background: linear-gradient(135deg, #0B132B 0%, #1c2a4d 100%);
            padding: 100px 0 80px;
            text-align: center;
            color: white;
        }

        .insights-hero h1 {
            font-size: clamp(2.5rem, 6vw, 3.5rem);
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .insights-hero .underline {
            width: 80px;
            height: 4px;
            background: var(--primary-color);
            margin: 0 auto 30px;
        }

        .insights-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 800px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* Blog Grid */
        .blog-section {
            padding: 80px 0;
            background: #fdfdfd;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .blog-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            border: 1px solid #eee;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .blog-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .blog-card:hover .blog-image img {
            transform: scale(1.1);
        }

        .blog-content {
            padding: 25px;
            flex-grow: 1;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .blog-tag {
            font-size: 0.75rem;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
        }

        .featured-tag {
            background: var(--primary-color);
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .read-time {
            font-size: 0.75rem;
            color: #aaa;
            margin-bottom: 15px;
            display: block;
        }

        .blog-card h3 {
            font-size: 1.3rem;
            color: #0B132B;
            margin-bottom: 15px;
            line-height: 1.4;
            font-weight: 700;
        }

        .blog-card p {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .blog-footer {
            padding: 0 25px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f5f5f5;
            padding-top: 15px;
        }

        .read-more {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .view-count {
            font-size: 0.75rem;
            color: #aaa;
        }

        @media (max-width: 992px) {
            .blog-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .blog-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
<?php 
$extraStyles = ob_get_clean();

include 'header.php'; 
?>

    <!-- Insights Hero -->
    <section class="insights-hero">
        <div class="container">
            <h1>INSIGHTS & BLOGS</h1>
            <div class="underline"></div>
            <p>Expert perspectives on law, business, governance, and compliance.</p>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="container">
            <div class="blog-grid">
                
                <!-- Blog 1 -->
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="modern_skyscraper_1778423370623.png" alt="Trademark & IP">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag">LASA Insights</span>
                            <span class="featured-tag">FEATURED</span>
                        </div>
                        <span class="read-time">1 min read</span>
                        <h3>Trademark & IP Compliance Updates</h3>
                        <p>Stay ahead with the latest updates on trademark registration, copyright laws, and IP protection strategies for your business.</p>
                    </div>
                    <div class="blog-footer">
                        <a href="#" class="read-more">read article &rarr;</a>
                        <span class="view-count">1 views</span>
                    </div>
                </article>

                <!-- Blog 2 -->
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="professionals_team_1778423276542.png" alt="Election Campaigns">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag">LASA Insights</span>
                            <span class="featured-tag">FEATURED</span>
                        </div>
                        <span class="read-time">1 min read</span>
                        <h3>Election Campaigns & Branding Insights</h3>
                        <p>Data-driven insights into modern election management, voter psychology, and political branding strategies.</p>
                    </div>
                    <div class="blog-footer">
                        <a href="#" class="read-more">read article &rarr;</a>
                        <span class="view-count">1 views</span>
                    </div>
                </article>

                <!-- Blog 3 -->
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="hero_office_1778423181445.png" alt="GeM & Tender">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag">LASA Insights</span>
                            <span class="featured-tag">FEATURED</span>
                        </div>
                        <span class="read-time">1 min read</span>
                        <h3>GeM & Tender Strategies</h3>
                        <p>Winning strategies for Government e-Marketplace bidding and public procurement tenders across various sectors.</p>
                    </div>
                    <div class="blog-footer">
                        <a href="#" class="read-more">read article &rarr;</a>
                        <span class="view-count">1 views</span>
                    </div>
                </article>

                <!-- Blog 4 -->
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="modern_skyscraper_1778423370623.png" alt="Startup Compliance">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span class="blog-tag">LASA Insights</span>
                            <span class="featured-tag">FEATURED</span>
                        </div>
                        <span class="read-time">1 min read</span>
                        <h3>Startup & Corporate Compliance Guides</h3>
                        <p>Essential guides for navigating the complex regulatory landscape for startups and corporates in India.</p>
                    </div>
                    <div class="blog-footer">
                        <a href="#" class="read-more">read article &rarr;</a>
                        <span class="view-count">1 views</span>
                    </div>
                </article>

            </div>
        </div>
    </section>

<?php include 'footer.php'; ?>
