<?php include 'templates/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Login</h2>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php echo validation_errors(); ?>
        <?php echo form_open('users/login'); ?>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <?php echo form_close(); ?>
        <p class="mt-3">Don't have an account? <a href="<?php echo site_url('register'); ?>">Register here</a>.</p>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
