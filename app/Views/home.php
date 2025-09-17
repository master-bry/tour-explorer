<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Explorer Tz - Tanzania Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Tour Explorer Tz</a>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="/tours">Tours</a></li>
            <li class="nav-item"><a class="nav-link" href="/reviews">Reviews</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="/auth/login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>#1 Operator in Tanzania</h1>
        <p>Discover the wonders of Tanzania with Tour Explorer Tz.</p>

        <!-- Popular Adventures -->
        <h2>Our Popular Adventures</h2>
        <div class="row">
            <?php foreach ($tours as $tour): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= $tour['image'] ?>" class="card-img-top" alt="<?= $tour['title'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $tour['title'] ?></h5>
                            <p class="card-text"><?= $tour['description'] ?></p>
                            <p>Price: $<?= $tour['price'] ?></p>
                            <a href="/tour/<?= $tour['id'] ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Categories Filter -->
        <div class="mt-4">
            <?php foreach ($categories as $cat): ?>
                <a href="/tours?category=<?= $cat === 'All' ? '' : $cat ?>" class="btn btn-outline-primary"><?= $cat ?></a>
            <?php endforeach; ?>
        </div>

        <!-- Achievements -->
        <h2>Achievements</h2>
        <ul>
            <?php foreach ($achievements as $ach): ?>
                <li><?= $ach ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Impact -->
        <h2>Our Impact</h2>
        <ul>
            <?php foreach ($impact as $imp): ?>
                <li><?= $imp ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Reviews -->
        <h2>Customer Reviews</h2>
        <div class="row">
            <?php foreach ($reviews as $review): ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5><?= $review['name'] ?></h5>
                            <p><?= $review['review_text'] ?></p>
                            <p>Rating: <?= $review['rating'] ?>/5 | Date: <?= $review['date'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Contact Form -->
        <h2>Plan Your Trip</h2>
        <form action="/contact" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
                <label class="form-check-label" for="privacy"> Agree to Privacy Policy</label>
            </div>
            <button type="submit" class="btn btn-primary">Send Inquiry</button>
        </form>
    </div>

    <!-- WhatsApp Chat -->
    <a href="https://wa.me/0659864096?text=Hello from Tour Explorer Tz" class="whatsapp-btn">Chat on WhatsApp</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>