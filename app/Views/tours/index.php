<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="section-title">Our Tours</h1>
        </div>
        <div class="col-md-6">
            <form action="/tours" method="get" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search tours..." 
                       value="<?= esc($search) ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="mb-4">
        <a href="./tours" class="btn btn-outline-primary <?= !$category ? 'active' : '' ?>">All Tours</a>
        <?php foreach (['Safari', 'Kilimanjaro'] as $cat): ?>
            <a href="/tours?category=<?= urlencode($cat) ?>" 
               class="btn btn-outline-primary <?= $category === $cat ? 'active' : '' ?>">
                <?= $cat ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Tours Grid -->
    <div class="row">
        <?php if (empty($tours)): ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h3>No tours found</h3>
                <p>Try adjusting your search criteria or browse all tours.</p>
                <a href="./tours" class="btn btn-primary">View All Tours</a>
            </div>
        <?php else: ?>
            <?php foreach ($tours as $tour): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="<?= $tour['image'] ?: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80' ?>" 
                             class="card-img-top" alt="<?= $tour['title'] ?>" style="height: 250px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-secondary mb-2 align-self-start"><?= $tour['category'] ?></span>
                            <h5 class="card-title"><?= $tour['title'] ?></h5>
                            <p class="card-text flex-grow-1"><?= character_limiter($tour['description'], 120) ?></p>
                            <div class="mt-auto">
                                <p class="h4 text-primary mb-3">$<?= number_format($tour['price']) ?></p>
                                <a href="/tour/<?= $tour['id'] ?>" class="btn btn-primary w-100">View Details & Book</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>