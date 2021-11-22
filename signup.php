 <link rel="stylesheet" href="./css/styleLogIn.css">
 
 <style>
     body {
  background: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)),
    url(./images/imagecar.webp);
  background-size: cover;
  background-position: center;
}
label {
color:deepskyblue;
}
 </style>
 
 
 
<?php
require_once 'app/helpers.php';
 $profile_image='';

session_start();

redirect_unauthorized(true);

if (validate_csrf() && isset($_POST['submit'])) {
    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PWD, MYSQL_DB);

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($link, $name);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = mysqli_real_escape_string($link, $email);

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($link, $password);


    define('MAX_FILE_SIZE', 1024 * 1024 * 5);
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
    $profile_image = "default_profile.png";
    $image = $_FILES['image'] ?? null;

    $is_form_valid = true;

    if (!$name || mb_strlen($name) < 2  || mb_strlen($name) > 70) {
        $errors['name'] = '* Name is required for minimum 2 characters and maximum 70';
        $is_form_valid = false;
    }

    if (email_exists($link, $email)) {
        $errors['email'] = '* Email is already taken';
        $is_form_valid = false;
    }

    if (!$password || mb_strlen($password) < 6  || mb_strlen($password) > 20) {
        $errors['password'] = '* Password is required for minimum 6 characters and maximum 20';
        $is_form_valid = false;
    }

    if (
        $is_form_valid &&
        isset($image) &&
        isset($image['name']) &&
        $image['error'] === UPLOAD_ERR_OK &&
        $image['size'] <= MAX_FILE_SIZE &&
        is_uploaded_file($image['tmp_name']) &&
        in_array(pathinfo($image['name'])['extension'], $allowed)
    ) {
        $profile_image = date('Y.m.d.H.i.s') . '-' . $image['name'];
        move_uploaded_file($image['tmp_name'], "images/profiles/$profile_image");
    }

    if ($is_form_valid) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        $result = mysqli_query($link, $sql);

        if ($result && mysqli_affected_rows($link) === 1) {
            $new_user_id = mysqli_insert_id($link);

            $profile_image = mysqli_real_escape_string($link, $profile_image);
            $sql = "INSERT INTO users_profile (user_id, profile_image) VALUES ($new_user_id, '$profile_image')";

            $result = mysqli_query($link, $sql);

            if ($result && mysqli_affected_rows($link) === 1) {
                login_user($new_user_id, $name, './blog.php');
            }
        }
    }
}

$page_title = "SIGN UP";
include_once './tpl/header.php';
?>

<main class="container flex-fill">

    <!-- PAGE HEADER -->
    <section id="main-top-content">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1 class="display-3 text-primary">
                    Sign up for a new account
                </h1>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT -->
    <section class="main-content container">
        <div class="row mb-3">
            <div class="col-12 col-md-6 mx-auto">

                <form action="" method="POST" novalidate="novalidate" autocomplete="off" enctype="multipart/form-data">

                    <input type="hidden" name="<?= csrf_name(); ?>" value="<?= csrf(); ?>">

                    <div class="form-group mt-3">
                        <label for="name">
                            <span class="text-danger">*</span>
                            Name
                        </label>
                        <input type="name" name="name" id="f_name" class="form-control text-white">
                        <?= field_error('name'); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">
                            <span class="text-danger">*</span>
                            Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control">
                        <?= field_error('email'); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">
                            <span class="text-danger">*</span>
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control">
                        <?= field_error('password'); ?>
                    </div>

                    <div class="form-group mt-3">
                        <label for="image" class="form-label">
                            Profile Image
                        </label>
                        
                        <input type="file" name="image" id="image" class="form-control text-white">
                    </div>

                    <input type="submit" name="submit" value="Sign Up" class="btn btn-primary mt-3">
                    <?= field_error('submit'); ?>
                </form>

            </div>
        </div>
</main>

<?php include_once './tpl/footer.php'; ?>