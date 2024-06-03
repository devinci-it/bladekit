<footer>
    <div class="footer-content">
        <p class="caption-text" style="color: var(--text-color); margin: 0;">
            &nbsp;&nbsp;Copyright &copy; <span id="currentYear">{{ date('Y') }}</span> <span id="companyName">devinci-it</span> | All rights reserved.
        </p>
        <div class="social-icons">
            <!-- Add your social media icons or links here -->
            <!-- Example: <a href="#" class="icon"><i class="fab fa-twitter"></i></a> -->
            @foreach ($socialLinks as $link)
                <a href="{{ $link['url'] }}" class="icon">{{ $link['icon'] }}</a>
            @endforeach
        </div>
    </div>

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
</footer>

<script>
    // Update year dynamically
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    // Customize company name dynamically
    // You can set this value from your backend or through JavaScript
    document.getElementById('companyName').textContent = 'Your Company Name';
</script>

<style>
    /* Customizable CSS Variables */
    :root {
        --text-color: #666; /* Default text color */
        --link-color: #007bff; /* Default link color */
    }

    /* Example styling for footer */
    footer {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .footer-content {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .caption-text {
        font-size: 14px;
    }

    .social-icons {
        margin-left: 10px;
    }

    .social-icons .icon {
        color: var(--link-color);
        margin-right: 5px;
        font-size: 20px;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .link-group {
        margin: 0 20px;
    }

    .link-group h3 {
        margin-top: 0;
    }

    .link-group ul {
        list-style: none;
        padding: 0;
    }

    .link-group ul li {
        margin-bottom: 5px;
    }

    .link-group ul li a {
        color: var(--text-color);
        text-decoration: none;
    }
</style>
