<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - Tour Explorer Tz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <h2>Tours</h2>
        <a href="/admin/addTour" class="btn btn-success">Add Tour</a>
        <table class="table">
            <thead><tr><th>ID</th><th>Title</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                    <tr><td><?= $tour['id'] ?></td><td><?= $tour['title'] ?></td><td><a href="/admin/edit/<?= $tour['id'] ?>">Edit</a></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Reviews</h2>
        <table class="table">
            <!-- Similar for reviews -->
        </table>
    </div>
</body>
</html>