<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Explorer Tz - Tanzania's Premier Tour Operator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c5530;
            --secondary: #f8a01d;
            --light: #f8f9fa;
            --dark: #343a40;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
        }
        
        .hero-section {
            background: linear-gradient(rgba(44, 85, 48, 0.8), rgba(44, 85, 48, 0.8)), url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #244627;
            border-color: #244627;
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: white;
        }
        
        .card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 3rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary);
        }
        
        .whatsapp-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        
        .review-card {
            border-left: 4px solid var(--secondary);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
        <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-mountain me-2"></i>Tour Explorer Tz
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('home') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('tours') ?>">Tours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('reviews') ?>">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('is_logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin') ?>">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="<?= base_url('auth/register') ?>">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <?= $this->renderSection('content') ?>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4">
                    <h5>Tour Explorer Tz</h5>
                    <p>Your premier tour operator in Tanzania, offering unforgettable adventures and authentic experiences.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/tours" class="text-white-50">All Tours</a></li>
                        <li><a href="/about" class="text-white-50">About Us</a></li>
                        <li><a href="/contact" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-phone me-2"></i> +255 659 864 096</p>
                    <p><i class="fas fa-envelope me-2"></i> info@tourexplorertz.com</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tour Explorer Tz - Tanzania Tours' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c5530;
            --secondary: #f8a01d;
            --light: #f8f9fa;
            --dark: #343a40;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            padding-top: 76px; /* Account for fixed navbar */
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
        }
        
        .nav-link:hover {
            color: var(--primary) !important;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #244627;
            border-color: #244627;
        }
        
        .hero-section {
            background: linear-gradient(rgba(44, 85, 48, 0.8), rgba(44, 85, 48, 0.8)), url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-top: -76px;
        }
        
        .card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary);
        }
        
        .whatsapp-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #25D366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        
        .whatsapp-btn:hover {
            color: white;
            transform: scale(1.1);
        }
        
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-mountain me-2"></i>Tour Explorer Tz
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tours">Tours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('is_logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="/auth/register">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Tour Explorer Tz</h5>
                    <p>Your premier tour operator in Tanzania, offering unforgettable adventures and authentic experiences.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/tours" class="text-white-50 text-decoration-none">All Tours</a></li>
                        <li><a href="/reviews" class="text-white-50 text-decoration-none">Customer Reviews</a></li>
                        <li><a href="/contact" class="text-white-50 text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-phone me-2"></i> +255 659 864 096</p>
                    <p><i class="fas fa-envelope me-2"></i> info@tourexplorertz.com</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Arusha, Tanzania</p>
                </div>
            </div>
            <div class="text-center pt-4 border-top border-secondary">
                <p>&copy; 2024 Tour Explorer Tz. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/255659864096?text=Hello%20Tour%20Explorer%20Tz,%20I'm%20interested%20in%20your%20tours" 
       class="whatsapp-btn" target="_blank" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Fix navigation toggle
    document.addEventListener('DOMContentLoaded', function() {
        // Close mobile menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-link');
        const navbarCollapse = document.querySelector('.navbar-collapse');
        
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
        
        // Add active class to current page
        const currentLocation = location.href;
        navLinks.forEach(link => {
            if (link.href === currentLocation) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');
            }
        });
    });
    </script>
    
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>