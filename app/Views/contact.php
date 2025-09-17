<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact - Tour Explorer Tz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <form action="/contact" method="post">
            <div class="mb-3"><input type="text" class="form-control" name="name" placeholder="Name" required></div>
            <div class="mb-3"><input type="email" class="form-control" name="email" placeholder="Email" required></div>
            <div class="mb-3"><textarea class="form-control" name="message" placeholder="Message" required></textarea></div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
        <a href="?lang=ru">Switch to Russian</a>
    </div>
</body>
</html>