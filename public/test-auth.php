<!DOCTYPE html>
<html>
<head>
    <title>Auth Test Page</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .section { margin: 20px 0; padding: 15px; background: #f5f5f5; border-radius: 5px; }
        a { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 5px; }
        a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>Tour Explorer Tz - Auth Test Page</h1>

    <div class="section">
        <h2>Configuration</h2>
        <p><strong>Current URL:</strong> <?= 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?></p>
        <p><strong>Expected Base URL:</strong> http://localhost/tour-explorer-tz/public/</p>
    </div>

    <div class="section">
        <h2>Test Authentication Links</h2>
        <a href="auth/login">Login Page</a>
        <a href="auth/register">Register Page</a>
        <a href="./">Home Page</a>
    </div>

    <div class="section">
        <h2>Direct Links (Full URL)</h2>
        <a href="http://localhost/tour-explorer-tz/public/auth/login">Login (Full URL)</a>
        <a href="http://localhost/tour-explorer-tz/public/auth/register">Register (Full URL)</a>
        <a href="http://localhost/tour-explorer-tz/public/">Home (Full URL)</a>
    </div>

    <div class="section">
        <h2>Instructions</h2>
        <ol>
            <li>Click on "Register Page" above</li>
            <li>Fill in the registration form</li>
            <li>Submit the form</li>
            <li>Check if you get redirected properly</li>
        </ol>
    </div>
</body>
</html>
