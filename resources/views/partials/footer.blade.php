<footer>
    <div class="footer-content">
        <p class="caption-text" style="color: var(--text-color); margin: 0;">
            &nbsp;&nbsp;Copyright &copy; <span id="currentYear">{{ date('Y') }}</span> <span id="companyName">devinci-it</span> | All rights reserved.
        </p>
        @if (!empty($socialLinks))
            <div class="social-icons">
                @foreach ($socialLinks as $link)
                    <a href="{{ $link['url'] }}" class="icon">{{ $link['icon'] }}</a>
                @endforeach
            </div>
        @endif
    </div>

    @if (!empty($footerLinks))
        <div class="footer-links">
            @foreach ($footerLinks as $group)
                <div class="link-group">
                    <h3>{{ $group['title'] }}</h3>
                    <ul>
                        @foreach ($group['links'] as $link)
                            <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</footer>

<script>
    // Update year dynamically
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    // Customize company name dynamically
    // You can set this value from your backend or through JavaScript
    document.getElementById('companyName').textContent = 'Your Company Name';
</script>
