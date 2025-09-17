<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tours - Tour Explorer Tz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Tours</h1>
        <!-- Search Form -->
        <form method="get">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" name="search" placeholder="Search tours..." value="<?= esc($search) ?>">
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        <option value="Safari" <?= $category === 'Safari' ? 'selected' : '' ?>>Safari</option>
                        <option value="Kilimanjaro" <?= $category === 'Kilimanjaro' ? 'selected' : '' ?>>Kilimanjaro</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div class="row">
            <?php foreach ($tours as $tour): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= $tour['image'] ?>" class="card-img-top" alt="<?= $tour['title'] ?>">
                        <div class="card-body">
                            <h5><?= $tour['title'] ?></h5>
                            <p><?= $tour['description'] ?></p>
                            <a href="/tour/<?= $tour['id'] ?>" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>