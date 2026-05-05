<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - JobEase</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 40px 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #0F2854, #1C4D8D);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 40px;
        }

        .content h2 {
            color: #1e3a8a;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .content h2:first-of-type {
            margin-top: 0;
        }

        .content p {
            margin-bottom: 15px;
            color: #334155;
        }

        .content ul {
            margin-bottom: 20px;
            padding-left: 30px;
            color: #334155;
        }

        .content li {
            margin-bottom: 8px;
        }

        .button-group {
            margin-top: 40px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .back-btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .close-btn {
            display: inline-block;
            padding: 12px 24px;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: transform 0.2s, background 0.2s;
            border: none;
            cursor: pointer;
        }

        .close-btn:hover {
            transform: translateY(-2px);
            background: #475569;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 15px;
            }

            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 25px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content h2 {
                font-size: 18px;
            }

            .button-group {
                flex-direction: column;
            }

            .back-btn,
            .close-btn {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Terms of Service</h1>
            <p>Last updated: {{ date('F j, Y') }}</p>
        </div>

        <div class="content">
            <h2>1. Acceptance of Terms</h2>
            <p>By accessing or using JobEase, you agree to be bound by these Terms of Service. If you disagree with any
                part of the terms, you may not access the Service.</p>

            <h2>2. Description of Service</h2>
            <p>JobEase provides a platform connecting job seekers with employers. We facilitate job applications, resume
                submissions, and communication between parties.</p>

            <h2>3. User Accounts</h2>
            <p>You are responsible for maintaining the confidentiality of your account credentials. You agree to accept
                responsibility for all activities that occur under your account.</p>

            <h2>4. User Conduct</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Post false, inaccurate, or misleading information</li>
                <li>Impersonate any person or entity</li>
                <li>Upload viruses or malicious code</li>
                <li>Harass, abuse, or harm another person</li>
                <li>Violate any applicable laws or regulations</li>
            </ul>

            <h2>5. Job Postings</h2>
            <p>Employers are solely responsible for their job postings. JobEase does not guarantee the accuracy or
                legitimacy of any job listing.</p>

            <h2>6. Intellectual Property</h2>
            <p>The Service and its original content, features, and functionality are owned by JobEase and are protected
                by international copyright laws.</p>

            <h2>7. Termination</h2>
            <p>We may terminate or suspend your account immediately, without prior notice, for conduct that violates
                these Terms.</p>

            <h2>8. Limitation of Liability</h2>
            <p>JobEase shall not be liable for any indirect, incidental, special, consequential, or punitive damages
                resulting from your use of the Service.</p>

            <h2>9. Changes to Terms</h2>
            <p>We reserve the right to modify these terms at any time. Continued use of the Service after changes
                constitutes acceptance of the new terms.</p>

            <h2>10. Contact Information</h2>
            <p>For questions about these Terms, please contact us at: <strong>legal@jobease.com</strong></p>

            <div class="button-group">
                <a href="{{ route('register') }}" class="back-btn">← Back to Registration</a>
                <button onclick="window.close()" class="close-btn">✕ Close Window</button>
            </div>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} JobEase. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Close window with keyboard (Escape key)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                window.close();
            }
        });
    </script>
</body>

</html>