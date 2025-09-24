<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Discover the Magic of Tanzania</h1>
        <p class="lead mb-4">Experience unforgettable adventures with Tanzania's #1 tour operator</p>
        <a href="/tours" class="btn btn-secondary btn-lg">Explore Our Tours</a>
    </div>
</section>

<!-- Popular Tours -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Our Popular Adventures</h2>
        <div class="row">
            <?php foreach ($tours as $tour): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="<?= $tour['image'] ?: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' ?>" 
                             class="card-img-top" alt="<?= $tour['title'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $tour['title'] ?></h5>
                            <p class="card-text flex-grow-1"><?= character_limiter($tour['description'], 100) ?></p>
                            <div class="mt-auto">
                                <p class="h5 text-primary">$<?= number_format($tour['price']) ?></p>
                                <a href="/tour/<?= $tour['id'] ?>" class="btn btn-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">Tour Categories</h2>
        <div class="row">
            <?php foreach ($categories as $cat): ?>
                <?php if ($cat !== 'All'): ?>
                    <div class="col-md-3 mb-3">
                        <a href="/tours?category=<?= urlencode($cat) ?>" class="btn btn-outline-primary w-100">
                            <i class="fas fa-<?= strtolower($cat) === 'safari' ? 'binoculars' : (strtolower($cat) === 'kilimanjaro' ? 'mountain' : 'map') ?> me-2"></i>
                            <?= $cat ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Achievements -->
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Our Achievements</h2>
        <div class="row text-center">
            <?php foreach ($achievements as $ach): ?>
                <div class="col-md-6 mb-4">
                    <div class="p-4 border rounded">
                        <i class="fas fa-trophy fa-2x text-secondary mb-3"></i>
                        <h5><?= $ach ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Reviews -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">What Our Customers Say</h2>
        <div class="row">
            <?php foreach ($reviews as $review): ?>
                <div class="col-md-4 mb-4">
                    <div class="card review-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title"><?= $review['name'] ?></h5>
                                <div class="text-warning">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="card-text">"<?= $review['review_text'] ?>"</p>
                            <small class="text-muted"><?= date('M j, Y', strtotime($review['date'])) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center">Plan Your Tanzanian Adventure</h2>
                <form action="/contact" method="post" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please provide your name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Please provide a valid email.</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        <div class="invalid-feedback">Please enter your message.</div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                        <label class="form-check-label" for="privacy">I agree to the Privacy Policy</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Send Inquiry</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- WhatsApp Button -->
<a href="https://wa.me/255659864096?text=Hello%20Tour%20Explorer%20Tz,%20I'm%20interested%20in%20your%20tours" 
   class="whatsapp-btn" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
<?= $this->endSection() ?>