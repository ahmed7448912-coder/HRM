<!-- FOOTER SECTION -->
<footer class="footer">
    <div class="container footer-grid">
        <div class="footer-logo-desc">
            <a href="#" class="logo" style="margin-bottom:1rem; font-size:1.15rem;">
                <div class="logo-icon" style="width:28px; height:28px; font-size:0.9rem;">P</div>
                PeopleDesk
            </a>
            <p style="color:var(--gray-500); font-size:0.85rem; line-height:1.5;">The intelligent command center for modern workforce management. Build a world-class culture with PeopleDesk.</p>
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
            <h5 class="footer-links-h" style="font-size:0.95rem; margin-bottom:1.2rem;">Stay Updated</h5>
            <p style="color:var(--gray-400); font-size:0.85rem; margin-bottom:1rem;">Join 10,000+ HR leaders getting our weekly insights.</p>
            @if(session('success'))
                <p style="color:var(--accent); font-size:0.85rem; margin-bottom:1rem; font-weight:700;">{{ session('success') }}</p>
            @endif
            <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display:flex; gap:8px;">
                @csrf
                <input type="email" name="email" placeholder="Email" required style="padding:0.6rem; border-radius:8px; border:1px solid rgba(255,255,255,0.1); background:rgba(255,255,255,0.05); color:white; flex-grow:1; outline:none; font-size:0.85rem;">
                <button type="submit" class="btn btn-primary" style="padding:0.6rem 1rem;">→</button>
            </form>
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
            <a href="#" style="color:var(--gray-400); transition:color 0.3s;" onmouseover="this.style.color='#1877F2'" onmouseout="this.style.color='var(--gray-400)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="#" style="color:var(--gray-400); transition:color 0.3s;" onmouseover="this.style.color='#E4405F'" onmouseout="this.style.color='var(--gray-400)'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.063-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.058-1.28.072-1.689.072-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98C15.667.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
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