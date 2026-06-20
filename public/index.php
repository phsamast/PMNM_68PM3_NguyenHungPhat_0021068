<?php
    $scriptName = $_SERVER['SCRIPT_NAME']; // e.g. /btvnpmnm/public/index.php
    $baseDir = dirname($scriptName); // e.g. /btvnpmnm/public
    $baseDir = preg_replace('#[\\\/]public$#i', '', $baseDir);
    if ($baseDir === '/' || $baseDir === '\\') {
        $baseDir = '';
    }
    define('BASE_URL', $baseDir);

    if (!function_exists('url')) {
        function url($path = '') {
            return BASE_URL . '/' . ltrim($path, '/');
        }
    }

    require_once '../app/middleware.php';
    $middleware = new Middleware();
    $middleware->checklogin();
    $app = new App();
?>