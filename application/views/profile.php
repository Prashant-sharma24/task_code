<?php include 'templates/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h2>Update Profile</h2>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('users/update_profile'); ?>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo set_value('name', $user['name']); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo set_value('email', $user['email']); ?>">
        </div>
        <div class="form-group">
            <label for="password">Update Password:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>

<?php include 'templates/footer.php'; ?>
