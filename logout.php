<?php
require_once 'app/helpers.php';
session_start();
redirect_unauthorized();

setcookie(
    session_name(user_auth()),
    '',
    time()-1,
    session_get_cookie_params()['path']

);
 session_destroy();
header('location:./');

