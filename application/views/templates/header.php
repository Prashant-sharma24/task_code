<!DOCTYPE html>
<html>
<head>
    <title>My Application</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Application</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('users/dashboard'); ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('users/profile'); ?>">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('users/search'); ?>">Search</a></li>
            </ul>
            <ul class="navbar-nav">
                <?php if ($this->session->userdata('user')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="<?php echo base_url('uploads/profile/' . $this->session->userdata('user')['profile_picture']); ?>" alt="Profile Picture" class="img-thumbnail" style="width: 40px; height: 40px; border-radius: 50%;">
                            <?php echo $this->session->userdata('user')['name']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('users/logout'); ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('users/login'); ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('users/register'); ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
