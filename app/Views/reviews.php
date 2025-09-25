<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <h1 class="section-title text-center">Customer Reviews</h1>
            <p class="text-center lead mb-5">See what our customers say about their experiences with Tour Explorer Tz</p>

            <?php if (empty($reviews)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h3>No reviews yet</h3>
                    <p>Be the first to share your experience!</p>
                    <a href="/contact" class="btn btn-primary">Share Your Experience</a>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($reviews as $review): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title mb-0"><?= esc($review['name']) ?></h5>
                                        <div class="text-warning">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="card-text">"<?= esc($review['review_text']) ?>"</p>
                                    <small class="text-muted">
                                        <?= date('F j, Y', strtotime($review['date'] ?? $review['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>