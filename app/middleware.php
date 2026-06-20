<?php
require_once '../app/core/App.php';
session_start();
    class middleware {
        function checklogin() {
            $requestUri = $_SERVER['REQUEST_URI'];
            if (defined('BASE_URL') && BASE_URL !== '' && strpos($requestUri, BASE_URL) === 0) {
                $requestUri = substr($requestUri, strlen(BASE_URL));
            }
            $requestUri = explode('?', $requestUri)[0];

            $publicPages = ['/home/login', '/auth/login'];
            if (!isset($_SESSION['username']) && !in_array($requestUri, $publicPages)) {
                header('Location: ' . url('/home/login'));
                exit();
            }
        }
    }
?>