
<?php define('LOGO', 'i<i class="bi bi-truck mx-1"></i>Car'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iCAR<?= isset($page_title) ? " | $page_title" : ''; ?></title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style.css">

    <!-- JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script defer src="./js/script.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
<?php require_once 'app/helpers.php';

;?>



    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary shadow-lg" aria-label="Third navbar example">
            <div class="container">

                <!-- LOGO -->
                <a class="navbar-brand" href="./">
                    <?= LOGO; ?>
                </a>

                <!-- BOOTSTRAP NAVBAR TOGGLER -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- NAVBAR LINKS -->
                <div class="collapse navbar-collapse" id="navbarsExample03">

                    <!-- NAVBAR LEFT LINKS -->
                    <ul class="navbar-nav me-auto mb-2 mb-sm-0">

                        <li class="nav-item">
                            <a class="nav-link text-white" href="./about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./blog.php">Blog</a>
                        </li>

                    </ul>

                    <!-- NAVBAR RIGHT LINKS -->
                    <ul class="navbar-nav ms-auto mb-2 mb-sm-0">

                        <?php if (!user_auth()) : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./signin.php">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./signup.php">Sign Up</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                
                                <a class="nav-link text-white" href="">
                                    <?= $_SESSION['user_name']; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="./logout.php">Sign Out</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>