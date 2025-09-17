<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $tour['title'] ?> - Tour Explorer Tz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1><?= $tour['title'] ?></h1>
        <img src="<?= $tour['image'] ?>" alt="<?= $tour['title'] ?>" class="img-fluid">
        <p><?= $tour['description'] ?></p>
        <h2>Itinerary</h2>
        <p><?= $tour['itinerary'] ?></p>
        <h2>Price: $<?= $tour['price'] ?></h2>
        <?php if (session()->get('isLoggedIn')): ?>
            <form action="/booking/create" method="post">
                <input type="hidden" name="tour_id" value="<?= $tour['id'] ?>">
                <button type="submit" class="btn btn-success">Book Now</button>
            </form>
        <?php else: ?>
            <a href="/auth/login" class="btn btn-primary">Login to Book</a>
        <?php endif; ?>
    </div>
</body>
</html>