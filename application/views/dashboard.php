<?php include 'templates/header.php'; ?>


<div class="col">
<?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
</div>
<div class="row">
    <div class="col-md-6 offset-md-3 text-center">
        <h2>Welcome, <?php echo $user['name']; ?></h2>
        <img src="<?php echo base_url('uploads/profile/' . $user['profile_picture']); ?>" alt="Profile Picture" class="img-thumbnail" width="100">
    </div>
</div>

<?php include 'templates/footer.php'; ?>
