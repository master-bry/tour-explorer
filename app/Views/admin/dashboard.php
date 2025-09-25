<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Admin Dashboard</h1>
        <a href="/admin/addTour" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add New Tour
        </a>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Tours</h5>
                    <h2><?= count($tours) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Reviews</h5>
                    <h2><?= count($reviews) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Active Users</h5>
                    <h2>1</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Messages</h5>
                    <h2>0</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <!-- Tours Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Tours Management</h5>
            <span class="badge bg-primary"><?= count($tours) ?> tours</span>
        </div>
        <div class="card-body">
            <?php if (empty($tours)): ?>
                <div class="text-center py-4">
                    <i class="fas fa-map-marked-alt fa-3x text-muted mb-3"></i>
                    <h4>No tours found</h4>
                    <p>Get started by adding your first tour!</p>
                    <a href="/admin/addTour" class="btn btn-primary">Add Your First Tour</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tours as $tour): ?>
                                <tr>
                                    <td><?= $tour['id'] ?></td>
                                    <td>
                                        <img src="<?= $tour['image'] ?: 'https://via.placeholder.com/50' ?>" 
                                             alt="<?= $tour['title'] ?>" 
                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td>
                                        <strong><?= $tour['title'] ?></strong>
                                        <br><small class="text-muted"><?= character_limiter($tour['description'], 50) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary"><?= $tour['category'] ?></span>
                                    </td>
                                    <td><strong>$<?= number_format($tour['price']) ?></strong></td>
                                    <td><?= $tour['duration'] ? $tour['duration'] . ' days' : 'Flexible' ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/tour/<?= $tour['id'] ?>" class="btn btn-sm btn-outline-primary" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/admin/edit/<?= $tour['id'] ?>" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/admin/delete/<?= $tour['id'] ?>" class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this tour?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Reviews Table -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Customer Reviews</h5>
            <span class="badge bg-success"><?= count($reviews) ?> reviews</span>
        </div>
        <div class="card-body">
            <?php if (empty($reviews)): ?>
                <div class="text-center py-4">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h4>No reviews yet</h4>
                    <p>Customer reviews will appear here.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews as $review): ?>
                                <tr>
                                    <td><?= $review['id'] ?></td>
                                    <td><strong><?= $review['name'] ?></strong></td>
                                    <td>
                                        <div class="text-warning">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </td>
                                    <td><?= character_limiter($review['review_text'], 80) ?></td>
                                    <td><?= date('M j, Y', strtotime($review['date'] ?? $review['created_at'])) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>