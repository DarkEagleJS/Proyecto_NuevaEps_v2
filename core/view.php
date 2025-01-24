<?php
class View {
    public function render($view, $data = []) {
        extract($data);
        require_once "../app/views/$view.php";
    }
}
