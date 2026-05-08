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
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
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
        <div style="display:flex; gap:20px; align-items:center;">
            <a href="#" style="color:var(--gray-400); transition:color 0.3s;" onmouseover="this.style.color='#1DA1F2'" onmouseout="this.style.color='var(--gray-400)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
            </a>
            <a href="#" style="color:var(--gray-400); transition:color 0.3s;" onmouseover="this.style.color='#0077B5'" onmouseout="this.style.color='var(--gray-400)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </a>
        </div>
    </div>
</footer>