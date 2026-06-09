<?php
class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($viewName, $data = []) {
        extract($data);
        $viewname = $viewName;
        require_once '../app/views/layout/masterlayout.php';
    }
}