<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="section-title text-center">Contact Us</h1>
            <p class="text-center mb-5">Ready to start your Tanzanian adventure? Get in touch with us!</p>
            
            <?php if (session()->has('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>

            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row mb-5">
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                    <h5>Call Us</h5>
                    <p>+255 659 864 096</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                    <h5>Email Us</h5>
                    <p>info@tourexplorertz.com</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                    <h5>Visit Us</h5>
                    <p>Arusha, Tanzania</p>
                </div>
            </div>

            <form action="/contact/send" method="post" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= old('name') ?>" required>
                        <div class="invalid-feedback">Please provide your name.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= old('email') ?>" required>
                        <div class="invalid-feedback">Please provide a valid email.</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" 
                           value="<?= old('subject') ?>">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message *</label>
                    <textarea class="form-control" id="message" name="message" rows="5" 
                              required><?= old('message') ?></textarea>
                    <div class="invalid-feedback">Please enter your message.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
<?= $this->endSection() ?>