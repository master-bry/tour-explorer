<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/tours">Tours</a></li>
            <li class="breadcrumb-item active"><?= $tour['title'] ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <img src="<?= $tour['image'] ?: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' ?>" 
                     class="card-img-top" alt="<?= $tour['title'] ?>" style="height: 400px; object-fit: cover;">
                <div class="card-body">
                    <span class="badge bg-secondary mb-2"><?= $tour['category'] ?></span>
                    <h1 class="h2"><?= $tour['title'] ?></h1>
                    <p class="lead"><?= $tour['description'] ?></p>
                    
                    <div class="d-flex gap-4 mb-4">
                        <div>
                            <i class="fas fa-clock text-primary me-2"></i>
                            <strong><?= $tour['duration'] ? $tour['duration'] . ' days' : 'Flexible' ?></strong>
                        </div>
                        <div>
                            <i class="fas fa-users text-primary me-2"></i>
                            <strong><?= $tour['max_people'] ? 'Max ' . $tour['max_people'] . ' people' : 'Group tours available' ?></strong>
                        </div>
                    </div>

                    <h3 class="h4 mb-3">Itinerary</h3>
                    <div class="itinerary-content">
                        <?= nl2br(esc($tour['itinerary'])) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 100px;">
                <div class="card-body text-center">
                    <h3 class="text-primary mb-3">$<?= number_format($tour['price']) ?></h3>
                    <p class="text-muted mb-4">per person</p>
                    
                    <button class="btn btn-primary btn-lg w-100 mb-3" onclick="alert('Booking functionality coming soon!')">
                        <i class="fas fa-calendar-check me-2"></i>Book Now
                    </button>
                    
                    <button class="btn btn-outline-primary w-100" onclick="alert('Inquiry functionality coming soon!')">
                        <i class="fas fa-question-circle me-2"></i>Ask a Question
                    </button>

                    <hr class="my-4">

                    <div class="text-start">
                        <h5>Tour Highlights</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Expert local guides</li>
                            <li><i class="fas fa-check text-success me-2"></i>All equipment included</li>
                            <li><i class="fas fa-check text-success me-2"></i>Accommodation & meals</li>
                            <li><i class="fas fa-check text-success me-2"></i>Transportation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Tours -->
    <?php if (!empty($relatedTours)): ?>
    <section class="mt-5">
        <h3 class="section-title">Related Tours</h3>
        <div class="row">
            <?php foreach ($relatedTours as $relatedTour): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?= $relatedTour['image'] ?: 'https://via.placeholder.com/300x200' ?>" 
                             class="card-img-top" alt="<?= $relatedTour['title'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $relatedTour['title'] ?></h5>
                            <p class="card-text flex-grow-1"><?= character_limiter($relatedTour['description'], 80) ?></p>
                            <div class="mt-auto">
                                <p class="h5 text-primary">$<?= number_format($relatedTour['price']) ?></p>
                                <a href="/tour/<?= $relatedTour['id'] ?>" class="btn btn-outline-primary w-100">View Tour</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>