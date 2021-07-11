<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css?=v6">
    <!-- JS -->
    <script src="<?php echo base_url() ?>assets/js/script.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand ml-5" href="<?php base_url(); ?>home">
            <img src="<?php echo base_url(); ?>assets/img/Logo.png" alt="" style="width: 9rem; height: 3rem">
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0" style="width: 28rem">
            <?php if (!$this->session->has_userdata('logged_in')): ?>
                <li class="nav-item active">
                    <a class="nav-link navbtn" href="http://localhost/pictogram/index.php/home">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbtn" href="http://localhost/pictogram/index.php/register">Register</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbtn" href="http://localhost/pictogram/index.php/login">Login</a>
                </li>
            <?php elseif ($this->session->has_userdata('logged_in')): ?>
                <li class="nav-item active">
                    <a class="nav-link navbtn" href="#">Timeline</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbtn" href="#">Profile</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbtn" href="<?php echo base_url(); ?>index.php/UserController/logout">Logout</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </nav>