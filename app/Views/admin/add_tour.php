<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">Add New Tour</h1>
                <a href="/admin" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="/admin/addTour" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Tour Title *</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?= old('title') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category *</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="Safari" <?= old('category') == 'Safari' ? 'selected' : '' ?>>Safari</option>
                                    <option value="Kilimanjaro" <?= old('category') == 'Kilimanjaro' ? 'selected' : '' ?>>Kilimanjaro</option>
                                    <option value="Zanzibar" <?= old('category') == 'Zanzibar' ? 'selected' : '' ?>>Zanzibar</option>
                                    <option value="Cultural" <?= old('category') == 'Cultural' ? 'selected' : '' ?>>Cultural</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="4" required><?= old('description') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Price ($) *</label>
                                <input type="number" class="form-control" id="price" name="price" 
                                       value="<?= old('price') ?>" min="0" step="0.01" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="duration" class="form-label">Duration (days)</label>
                                <input type="number" class="form-control" id="duration" name="duration" 
                                       value="<?= old('duration') ?>" min="1">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="max_people" class="form-label">Max People</label>
                                <input type="number" class="form-control" id="max_people" name="max_people" 
                                       value="<?= old('max_people') ?>" min="1">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image URL</label>
                            <input type="url" class="form-control" id="image" name="image" 
                                   value="<?= old('image') ?>" placeholder="https://example.com/image.jpg">
                            <div class="form-text">Leave empty to use default image</div>
                        </div>

                        <div class="mb-3">
                            <label for="itinerary" class="form-label">Itinerary *</label>
                            <textarea class="form-control" id="itinerary" name="itinerary" 
                                      rows="6" required><?= old('itinerary') ?></textarea>
                            <div class="form-text">Detailed tour itinerary, day by day</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Add Tour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>