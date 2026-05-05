<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - JobEase</title>
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
            <h1>Privacy Policy</h1>
            <p>Last updated: {{ date('F j, Y') }}</p>
        </div>

        <div class="content">
            <h2>1. Information We Collect</h2>
            <p>We collect information you provide directly to us, such as:</p>
            <ul>
                <li>Name, email address, and contact information</li>
                <li>Resume, work history, and qualifications (for job seekers)</li>
                <li>Company information (for employers)</li>
                <li>Account credentials and preferences</li>
            </ul>

            <h2>2. How We Use Your Information</h2>
            <p>We use the information we collect to:</p>
            <ul>
                <li>Create and manage your account</li>
                <li>Match job seekers with relevant opportunities</li>
                <li>Process job applications and submissions</li>
                <li>Communicate with you about the Service</li>
                <li>Improve and optimize our platform</li>
                <li>Ensure security and prevent fraud</li>
            </ul>

            <h2>3. Information Sharing</h2>
            <p>We do not sell your personal information. We may share your information:</p>
            <ul>
                <li>With employers when you apply for a job</li>
                <li>With service providers who assist our operations</li>
                <li>When required by law or legal process</li>
                <li>With your consent or at your direction</li>
            </ul>

            <h2>4. Data Security</h2>
            <p>We implement industry-standard security measures to protect your personal information, including
                encryption, access controls, and regular security assessments.</p>

            <h2>5. Your Rights</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal information</li>
                <li>Correct inaccurate information</li>
                <li>Request deletion of your data</li>
                <li>Opt-out of marketing communications</li>
                <li>Export your data</li>
            </ul>

            <h2>6. Cookies and Tracking</h2>
            <p>We use cookies to enhance your experience, analyze usage, and personalize content. You can control cookie
                settings through your browser.</p>

            <h2>7. Data Retention</h2>
            <p>We retain your information as long as your account is active or as needed to provide services. You may
                request account deletion at any time.</p>

            <h2>8. Children's Privacy</h2>
            <p>Our Service is not directed to individuals under 16. We do not knowingly collect information from
                children.</p>

            <h2>9. International Data Transfer</h2>
            <p>Your information may be transferred to and processed in countries other than your own. We ensure
                appropriate safeguards are in place.</p>

            <h2>10. Updates to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. We will notify you of material changes via email or
                through the Service.</p>
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