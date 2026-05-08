<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeopleDesk — The Future of Enterprise HCM</title>
    <meta name="description" content="PeopleDesk is the modern HR command center for high-performance teams.">
    
    <!-- Modular CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
</head>
<body>

    <!-- HEADER SECTION -->
    <nav class="navbar">
        <div class="container nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">P</div>
                PeopleDesk
            </a>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#showcase">Solutions</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#">Resources</a></li>
            </ul>
            <div class="nav-btns">
                <a href="{{ route('login') }}" class="btn btn-ghost">Log In</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Start Free Trial</a>
            </div>
        </div>
    </nav>

    <!-- MAIN BODY SECTION -->
    <header class="hero">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-tag animate-up">
                    <span class="live-dot" style="width:8px;height:8px;background:var(--accent);border-radius:50%;"></span>
                    PeopleDesk 2026 is now live
                </div>
                <h1 class="hero-h1 animate-up delay-1">Manage your workforce <span class="text-gradient">smarter.</span></h1>
                <p class="hero-p animate-up delay-2">Ditch the spreadsheets. PeopleDesk centralizes HR, payroll, and performance into one intelligent command center built for modern teams.</p>
                <div class="hero-btns animate-up delay-3">
                    <a href="{{ route('register') }}" class="btn btn-primary" style="padding:1rem 2.5rem; font-size:1.1rem;">Get Started Free →</a>
                    <a href="#" class="btn btn-ghost" style="padding:1rem 2rem; border:1px solid var(--gray-200);">▶ Watch Demo</a>
                </div>
                <div class="trusted-by animate-up delay-3" style="border:none; padding:0; opacity:0.6;">
                    <p style="font-size:0.85rem; font-weight:700; color:var(--gray-400); margin-bottom:1.5rem; text-transform:uppercase; letter-spacing:1px;">Trusted by 500+ Innovators</p>
                    <div style="display:flex; gap:2.5rem; flex-wrap:wrap;">
                        <span class="brand-logo" style="font-size:1.1rem;">TECHCO</span>
                        <span class="brand-logo" style="font-size:1.1rem;">FINOVA</span>
                        <span class="brand-logo" style="font-size:1.1rem;">BUILD.IO</span>
                        <span class="brand-logo" style="font-size:1.1rem;">SCALE</span>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="dashboard-preview">
                    <div style="display:flex; gap:8px; margin-bottom:20px;">
                        <div style="width:10px;height:10px;background:#ff5f57;border-radius:50%;"></div>
                        <div style="width:10px;height:10px;background:#ffbd2e;border-radius:50%;"></div>
                        <div style="width:10px;height:10px;background:#28c840;border-radius:50%;"></div>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:25px;">
                        <div style="background:var(--gray-50); padding:20px; border-radius:16px;">
                            <div style="font-size:0.7rem; color:var(--gray-400); font-weight:800; text-transform:uppercase; margin-bottom:5px;">Staff Active</div>
                            <div style="font-size:2rem; font-weight:800; color:var(--dark); font-family:var(--font-heading);">2,451</div>
                        </div>
                        <div style="background:var(--gray-50); padding:20px; border-radius:16px;">
                            <div style="font-size:0.7rem; color:var(--gray-400); font-weight:800; text-transform:uppercase; margin-bottom:5px;">Efficiency</div>
                            <div style="font-size:2rem; font-weight:800; color:var(--accent); font-family:var(--font-heading);">98.4%</div>
                        </div>
                    </div>
                    <div style="height:150px; background:var(--gray-50); border-radius:16px; padding:20px; display:flex; align-items:flex-end; gap:10px;">
                        <div style="flex:1; height:40%; background:var(--primary); border-radius:4px; opacity:0.3;"></div>
                        <div style="flex:1; height:60%; background:var(--primary); border-radius:4px; opacity:0.5;"></div>
                        <div style="flex:1; height:80%; background:var(--primary); border-radius:4px; opacity:0.7;"></div>
                        <div style="flex:1; height:95%; background:var(--primary); border-radius:4px;"></div>
                        <div style="flex:1; height:70%; background:var(--primary); border-radius:4px; opacity:0.6;"></div>
                        <div style="flex:1; height:50%; background:var(--primary); border-radius:4px; opacity:0.4;"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- FEATURES SECTION -->
    <section id="features" class="section-padding">
        <div class="container">
            <div class="features-header">
                <h2 class="hero-h1" style="font-size:3.5rem;">Everything you need to <span class="text-gradient type-features">scale your culture.</span></h2>
                <p class="hero-p" style="margin:0 auto;">Automate the boring stuff so you can focus on building a world-class team.</p>
            </div>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">📁</div>
                    <h3 class="feature-h3">Smart Recruitment</h3>
                    <p style="color:var(--gray-500); font-size:0.95rem;">Automate your hiring funnel with our advanced ATS integration and scoring engine.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3 class="feature-h3">Global Payroll</h3>
                    <p style="color:var(--gray-500); font-size:0.95rem;">One-click payroll that handles taxes, compliance, and benefits automatically across borders.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3 class="feature-h3">Real-time Analytics</h3>
                    <p style="color:var(--gray-500); font-size:0.95rem;">Visual insights into retention, diversity, and workforce costs at the touch of a button.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SHOWCASE SECTION -->
    <section id="showcase" class="container section-padding">
        <div class="showcase">
            <div class="showcase-grid">
                <div class="showcase-content">
                    <h2 class="animate-up">The mission-critical <br>HR command center.</h2>
                    <div class="showcase-list">
                        <div class="showcase-item animate-up">
                            <div class="item-num">1</div>
                            <div>
                                <h4 style="font-size:1.25rem; font-family:var(--font-heading); margin-bottom:0.5rem;">Automated Onboarding</h4>
                                <p style="color:var(--gray-400); font-size:0.9rem;">Go from hire to live in under 10 minutes with automated provisioning.</p>
                            </div>
                        </div>
                        <div class="showcase-item animate-up delay-1">
                            <div class="item-num">2</div>
                            <div>
                                <h4 style="font-size:1.25rem; font-family:var(--font-heading); margin-bottom:0.5rem;">Performance Intelligence</h4>
                                <p style="color:var(--gray-400); font-size:0.9rem;">Run 360° reviews that actually drive growth and employee output.</p>
                            </div>
                        </div>
                        <div class="showcase-item animate-up delay-2">
                            <div class="item-num">3</div>
                            <div>
                                <h4 style="font-size:1.25rem; font-family:var(--font-heading); margin-bottom:0.5rem;">Expense Management</h4>
                                <p style="color:var(--gray-400); font-size:0.9rem;">Integrated spending and reimbursements directly in your payroll flow.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-visual" style="display:flex; justify-content:center;">
                    <div class="dashboard-preview" style="transform:none; background:var(--grad-indigo); padding:10px; width:100%; max-width:450px;">
                        <div style="background:var(--dark); border-radius:18px; padding:30px; height:400px; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center;">
                            <div class="item-num" style="width:80px; height:80px; font-size:2rem; margin-bottom:2rem;">🚀</div>
                            <h3 style="font-size:2rem; font-family:var(--font-heading); margin-bottom:1rem;">Fast & Secure</h3>
                            <p style="color:var(--gray-400);">Enterprise-grade security meets consumer-grade simplicity.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING SECTION -->
    <section id="pricing" class="section-padding">
        <div class="container">
            <div class="features-header">
                <h2 class="hero-h1" style="font-size:3.5rem;">Fair pricing for <span class="text-gradient type-pricing">every stage.</span></h2>
                <p class="hero-p" style="margin:0 auto;">Simple, transparent plans that scale with your team.</p>
            </div>
            <div class="pricing-grid">
                <div class="price-card">
                    <h4 style="font-family:var(--font-heading); font-size:1.25rem;">Starter</h4>
                    <div class="price-val">$49<span>/mo</span></div>
                    <p style="color:var(--gray-500); margin-bottom:2rem; font-size:0.9rem;">Perfect for teams up to 25.</p>
                    <ul class="price-list">
                        <li><span class="check-icon">✓</span> Core HR & Directory</li>
                        <li><span class="check-icon">✓</span> Basic Attendance</li>
                        <li><span class="check-icon">✓</span> Standard Reporting</li>
                    </ul>
                    <a href="#" class="btn btn-ghost" style="border:1px solid var(--gray-200);">Get Started</a>
                </div>
                <div class="price-card featured">
                    <div class="price-badge">POPULAR</div>
                    <h4 style="font-family:var(--font-heading); font-size:1.25rem;">Growth</h4>
                    <div class="price-val">$149<span>/mo</span></div>
                    <p style="color:var(--gray-400); margin-bottom:2rem; font-size:0.9rem;">For teams scaling up to 100.</p>
                    <ul class="price-list">
                        <li><span class="check-icon">✓</span> Everything in Starter</li>
                        <li><span class="check-icon">✓</span> Advanced Payroll</li>
                        <li><span class="check-icon">✓</span> Performance Reviews</li>
                    </ul>
                    <a href="#" class="btn btn-primary" style="width:100%;">Start Free Trial</a>
                </div>
                <div class="price-card">
                    <h4 style="font-family:var(--font-heading); font-size:1.25rem;">Enterprise</h4>
                    <div class="price-val">Custom</div>
                    <p style="color:var(--gray-500); margin-bottom:2rem; font-size:0.9rem;">Unlimited scale & support.</p>
                    <ul class="price-list">
                        <li><span class="check-icon">✓</span> Dedicated Manager</li>
                        <li><span class="check-icon">✓</span> Custom Integrations</li>
                        <li><span class="check-icon">✓</span> SSO & Compliance</li>
                    </ul>
                    <a href="#" class="btn btn-ghost" style="border:1px solid var(--gray-200);">Talk to Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section id="reviews" class="section-padding" style="background:var(--gray-50);">
        <div class="container">
            <div class="features-header">
                <h2 class="hero-h1" style="font-size:3.5rem;">Loved by <span class="text-gradient type-reviews">HR leaders</span> everywhere.</h2>
                <p class="hero-p" style="margin:0 auto;">Join 2,000+ teams who have transformed their workforce with PeopleDesk.</p>
            </div>
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:2rem;">
                <div class="feature-card" style="padding:2.5rem;">
                    <div style="color:#fbbf24; font-size:1.25rem; margin-bottom:1rem;">★★★★★</div>
                    <p style="font-style:italic; color:var(--gray-500); margin-bottom:2rem; font-size:0.95rem;">"PeopleDesk cut our monthly HR admin time by more than 60%. Payroll that used to take days now takes 15 minutes."</p>
                    <div style="display:flex; align-items:center; gap:1rem;">
                        <div style="width:40px;height:40px;background:var(--primary-light);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;color:var(--primary);">SR</div>
                        <div>
                            <div style="font-weight:700; font-size:0.95rem;">Sara Rashid</div>
                            <div style="font-size:0.8rem; color:var(--gray-400);">HR Director @ TechCo</div>
                        </div>
                    </div>
                </div>
                <div class="feature-card" style="padding:2.5rem;">
                    <div style="color:#fbbf24; font-size:1.25rem; margin-bottom:1rem;">★★★★★</div>
                    <p style="font-style:italic; color:var(--gray-500); margin-bottom:2rem; font-size:0.95rem;">"The real-time attendance dashboard is a game changer for our hybrid team. We finally have one source of truth."</p>
                    <div style="display:flex; align-items:center; gap:1rem;">
                        <div style="width:40px;height:40px;background:var(--accent-light);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;color:var(--accent);">KM</div>
                        <div>
                            <div style="font-weight:700; font-size:0.95rem;">Kamran Mirza</div>
                            <div style="font-size:0.8rem; color:var(--gray-400);">COO @ Finova</div>
                        </div>
                    </div>
                </div>
                <div class="feature-card" style="padding:2.5rem;">
                    <div style="color:#fbbf24; font-size:1.25rem; margin-bottom:1rem;">★★★★★</div>
                    <p style="font-style:italic; color:var(--gray-500); margin-bottom:2rem; font-size:0.95rem;">"Switching to PeopleDesk was the best decision we made this year. The onboarding process was seamless."</p>
                    <div style="display:flex; align-items:center; gap:1rem;">
                        <div style="width:40px;height:40px;background:rgba(168, 85, 247, 0.1);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;color:#a855f7;">AN</div>
                        <div>
                            <div style="font-weight:700; font-size:0.95rem;">Ayesha Noor</div>
                            <div style="font-size:0.8rem; color:var(--gray-400);">CEO @ Horizon</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INTEGRATIONS SECTION -->
    <section class="section-padding">
        <div class="container" style="text-align:center;">
            <div class="hero-tag">Ecosystem</div>
            <h2 class="hero-h1" style="font-size:3rem; margin-bottom:1rem;">Plays well with <span class="text-gradient type-integrations">everyone.</span></h2>
            <p class="hero-p" style="margin:0 auto 4rem;">Connect PeopleDesk with the tools your team already uses and loves.</p>
            <div style="display:flex; justify-content:center; gap:3rem; flex-wrap:wrap; opacity:0.6;">
                <div style="display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.25rem; color:var(--dark);"><span style="color:#E01E5A;">#</span> Slack</div>
                <div style="display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.25rem; color:var(--dark);"><span style="color:#2D8CFF;">Z</span> Zoom</div>
                <div style="display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.25rem; color:var(--dark);"><span style="color:#FF3366;">G</span> Google</div>
                <div style="display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.25rem; color:var(--dark);"><span style="color:#0077B5;">in</span> LinkedIn</div>
                <div style="display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.25rem; color:var(--dark);"><span style="color:#000000;">X</span> Shopify</div>
            </div>
        </div>
    </section>

    <!-- FLOWING WAVE SECTION (NEW) -->
    <section class="wave-section">
        <div class="container">
            <h2 class="hero-h1" style="color:white; font-size:3rem; margin-bottom:2rem;">Available On The <br>Shopify App Store</h2>
            <div style="display:flex; justify-content:center; gap:5rem; flex-wrap:wrap; opacity:0.8;">
                <div style="display:flex; flex-direction:column; align-items:center; gap:10px;">
                    <div style="font-size:3rem;">🛍️</div>
                    <div style="font-weight:800;">PEOPLEDESK FEED</div>
                </div>
                <div style="display:flex; flex-direction:column; align-items:center; gap:10px;">
                    <div style="font-size:3rem;">📱</div>
                    <div style="font-weight:800;">OPTIMA TIKTOK</div>
                </div>
                <div style="display:flex; flex-direction:column; align-items:center; gap:10px;">
                    <div style="font-size:3rem;">📈</div>
                    <div style="font-weight:800;">PEOPLEDESK GA4</div>
                </div>
            </div>
            <div style="margin-top:40px; display:flex; justify-content:center; gap:8px;">
                <div style="width:10px;height:10px;background:white;border-radius:50%;"></div>
                <div style="width:10px;height:10px;background:rgba(255,255,255,0.3);border-radius:50%;"></div>
                <div style="width:10px;height:10px;background:rgba(255,255,255,0.3);border-radius:50%;"></div>
                <div style="width:10px;height:10px;background:rgba(255,255,255,0.3);border-radius:50%;"></div>
            </div>
        </div>
    </section>

    <!-- SVG WAVES -->
    <div style="background:linear-gradient(90deg, #8B5CF6 0%, #EC4899 100%);">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>

    <!-- FAQ SECTION -->
    <section id="faq" class="section-padding" style="background:var(--gray-50); border-top:1px solid var(--gray-200);">
        <div class="container">
            <div style="display:grid; grid-template-columns: 1fr 1.5fr; gap:6rem;">
                <div>
                    <div class="hero-tag">Support</div>
                    <h2 class="hero-h1" style="font-size:3rem; margin-bottom:1.5rem;">Frequently <br>Asked <span class="text-gradient type-faq">Questions</span></h2>
                    <p class="hero-p">Can't find the answer you're looking for? Reach out to our support team anytime.</p>
                    <a href="#" class="btn btn-ghost" style="padding:0; color:var(--primary); font-weight:800;">Contact Support →</a>
                </div>
                <div>
                    <div class="faq-container">
                        <div class="faq-item" style="background:white; border-radius:20px; border:1px solid var(--gray-200); margin-bottom:1rem; overflow:hidden;">
                            <div class="faq-trigger" style="padding:1.5rem 2rem; display:flex; justify-content:space-between; align-items:center; cursor:pointer; font-weight:700;">
                                How long does it take to set up PeopleDesk?
                                <span class="faq-icon">+</span>
                            </div>
                            <div class="faq-content" style="max-height:0; overflow:hidden; transition:max-height 0.3s ease-out; padding:0 2rem; color:var(--gray-500); font-size:0.95rem;">
                                <div style="padding-bottom:1.5rem;">Most teams are fully onboarded in under 48 hours. Our automated import tools make it easy to bring in your data from CSV or existing HR tools.</div>
                            </div>
                        </div>
                        <div class="faq-item" style="background:white; border-radius:20px; border:1px solid var(--gray-200); margin-bottom:1rem; overflow:hidden;">
                            <div class="faq-trigger" style="padding:1.5rem 2rem; display:flex; justify-content:space-between; align-items:center; cursor:pointer; font-weight:700;">
                                Is my data secure with PeopleDesk?
                                <span class="faq-icon">+</span>
                            </div>
                            <div class="faq-content" style="max-height:0; overflow:hidden; transition:max-height 0.3s ease-out; padding:0 2rem; color:var(--gray-500); font-size:0.95rem;">
                                <div style="padding-bottom:1.5rem;">Absolutely. We use enterprise-grade AES-256 encryption for all data at rest and TLS for data in transit. We are fully GDPR and SOC2 compliant.</div>
                            </div>
                        </div>
                        <div class="faq-item" style="background:white; border-radius:20px; border:1px solid var(--gray-200); margin-bottom:1rem; overflow:hidden;">
                            <div class="faq-trigger" style="padding:1.5rem 2rem; display:flex; justify-content:space-between; align-items:center; cursor:pointer; font-weight:700;">
                                Can we integrate with our existing payroll?
                                <span class="faq-icon">+</span>
                            </div>
                            <div class="faq-content" style="max-height:0; overflow:hidden; transition:max-height 0.3s ease-out; padding:0 2rem; color:var(--gray-500); font-size:0.95rem;">
                                <div style="padding-bottom:1.5rem;">Yes! PeopleDesk has native integrations with 50+ payroll providers globally. We also offer a robust API for custom integrations.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->
    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-logo-desc">
                <a href="#" class="logo" style="margin-bottom:1.5rem;">
                    <div class="logo-icon">P</div>
                    PeopleDesk
                </a>
                <p style="color:var(--gray-500); font-size:0.95rem;">The intelligent command center for modern workforce management. Build a world-class culture with PeopleDesk.</p>
            </div>
            <div>
                <h5 class="footer-links-h">Product</h5>
                <ul class="footer-nav">
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Integrations</a></li>
                    <li><a href="#">Pricing</a></li>
                </ul>
            </div>
            <div>
                <h5 class="footer-links-h">Company</h5>
                <ul class="footer-nav">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h5 class="footer-links-h">Stay Updated</h5>
                <p style="color:var(--gray-400); font-size:0.9rem; margin-bottom:1rem;">Join 10,000+ HR leaders getting our weekly insights.</p>
                <div style="display:flex; gap:10px;">
                    <input type="email" placeholder="Email" style="padding:0.75rem; border-radius:10px; border:1px solid rgba(255,255,255,0.1); background:rgba(255,255,255,0.05); color:white; flex-grow:1; outline:none;">
                    <button class="btn btn-primary" style="padding:0.75rem 1.25rem;">→</button>
                </div>
            </div>
        </div>
        <div class="container footer-bottom">
            <span>© 2026 PeopleDesk Inc. All rights reserved.</span>
            <div style="display:flex; gap:20px;">
                <a href="#" style="color:var(--gray-400);">Twitter</a>
                <a href="#" style="color:var(--gray-400);">LinkedIn</a>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/your-number" class="whatsapp-float" target="_blank">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="white">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.747-2.874-2.512-2.96-2.626-.087-.114-.694-.925-.694-1.765s.437-1.252.592-1.416c.154-.164.338-.205.45-.205s.225.005.325.008c.107.003.251-.04.393.303.144.35.494 1.208.536 1.293.042.085.07.184.014.298-.056.114-.084.184-.168.284-.084.1-.176.223-.252.303-.094.1-.191.209-.083.393.108.184.481.794 1.031 1.284.708.631 1.306.827 1.49.911.184.084.292.071.401-.05.109-.121.464-.54.588-.725.124-.184.248-.154.42-.091.172.063 1.092.516 1.281.611.189.095.314.143.359.221.045.078.045.452-.1.857z"/>
        </svg>
    </a>

    <!-- Modular JS Assets -->
    <script src="{{ asset('assets/js/core.js') }}"></script>
    <script src="{{ asset('assets/js/animations.js') }}"></script>
    <script src="{{ asset('assets/js/interactions.js') }}"></script>
</body>
</html>
