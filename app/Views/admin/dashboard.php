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
    </div>

    <!-- Tours Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tours Management</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                            <tr>
                                <td><?= $tour['id'] ?></td>
                                <td>
                                    <img src="<?= $tour['image'] ?: 'https://via.placeholder.com/50' ?>" alt="<?= $tour['title'] ?>" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td><?= $tour['title'] ?></td>
                                <td><span class="badge bg-secondary"><?= $tour['category'] ?></span></td>
                                <td>$<?= number_format($tour['price']) ?></td>
                                <td>
                                    <a href="/admin/edit/<?= $tour['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/delete/<?= $tour['id'] ?>" class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>