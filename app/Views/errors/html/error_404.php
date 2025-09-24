<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #2c5530, #f8a01d);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .error-container {
            background: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #2c5530;
            margin: 0;
        }
        
        .error-message {
            font-size: 1.5rem;
            color: #333;
            margin: 1rem 0;
        }
        
        .error-description {
            color: #666;
            margin-bottom: 2rem;
        }
        
        .btn-primary {
            background-color: #2c5530;
            border-color: #2c5530;
            padding: 0.75rem 2rem;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            display: inline-block;
        }
        
        .btn-primary:hover {
            background-color: #244627;
            border-color: #244627;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">404</h1>
        <h2 class="error-message">Page Not Found</h2>
        <p class="error-description">
            The page you are looking for might have been removed, had its name changed, 
            or is temporarily unavailable.
        </p>
        <a href="/" class="btn-primary">Go to Homepage</a>
    </div>
</body>
</html>