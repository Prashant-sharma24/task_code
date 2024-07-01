<?php include 'templates/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Register</h2>
        <?php if ($this->session->flashdata('form_validation_errors')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('form_validation_errors'); ?>
            </div>
        <?php endif; ?>
        <?php echo form_open_multipart('users/register'); ?>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control <?php echo form_error('name') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('name'); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('email'); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture" class="form-control-file <?php echo form_error('profile_picture') ? 'is-invalid' : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
