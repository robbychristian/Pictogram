<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css?=v7">
    <!-- JS -->
    <script src="<?php echo base_url() ?>assets/js/script.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
            <?php if (!$this->session->has_userdata('logged_in')) : ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0" style="width: 28rem">

                    <li class="nav-item active">
                        <a class="nav-link navbtn" href="http://localhost/pictogram/index.php/home">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link navbtn" href="http://localhost/pictogram/index.php/register">Register</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link navbtn" href="http://localhost/pictogram/index.php/login">Login</a>
                    </li>
                </ul>
            <?php elseif ($this->session->has_userdata('logged_in')) : ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0" style="width: 15rem">
                    <li class="nav-item active">
                        <a class="nav-link mr-3" href="http://localhost/pictogram/index.php/timeline">Timeline</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
                            Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="http://localhost/pictogram/index.php/profile/<?php echo $_SESSION['id'] ?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname'] ?></a>
                            <a class="dropdown-item" href="http://localhost/pictogram/index.php/edit/">Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/UserController/logout">Logout</a>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
    <div class="alert alert-danger alert-dismissible fade show post-error" role="alert" id="error_post">
        <strong>Post not created!</strong> You should include a caption and an image.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>