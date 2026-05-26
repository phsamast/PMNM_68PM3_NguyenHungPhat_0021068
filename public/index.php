<?php

    require_once '../app/middleware.php';
    $middleware = new Middleware();
    $middleware->checklogin();
    $app = new App();
?>