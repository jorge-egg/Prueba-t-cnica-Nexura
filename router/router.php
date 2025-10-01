<?php
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
    case '/':
    case '/index.php':
        require __DIR__ . '/index.html';
        break;

    case '/crear.php':
        require __DIR__ . '/crear.php';
        break;

    default:
        http_response_code(404);
        echo "404 - Página no encontrada";
        break;
}
