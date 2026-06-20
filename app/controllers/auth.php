<?php
    class auth{
        protected $user=[
            'admin' => '123456',
            'Phat' => '123456'
        ];
        public function login() {
            if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';
                if (isset($this->user[$username]) && $this->user[$username] === $password) {
                    $_SESSION['username'] = $username;
                    header('Location: ' . url('/sinhvien/index'));
                    exit();
                } else {
                    header('Location: ' . url('/home/login'));
                    exit();
                }
            }
        }

        public function logout() {
            unset($_SESSION['username']);
            session_destroy();
            header('Location: ' . url('/home/login'));
            exit();
        }
    }