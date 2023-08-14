<?php

// Bootstrap
try {
    define('ROOT_DIR', realpath(__DIR__));
    ini_set('output_buffering', 'On');

    // Autoloader
    $autoLoader = fn(string $name) => array_map(fn(string $dir) => is_readable($file = ROOT_DIR . $dir . $name . '.php') ? require_once $file : 0, ['/Actions/', '/Domains/', '/Responders/', '/Responses/']);
    spl_autoload_register($autoLoader);


    // Router
    require_once ROOT_DIR . '/Router.php';
    $TopDomain = new TopDomain();
    $topResponder = new TopResponder();
    $router = new Router();
    $topAction = new TopAction($TopDomain, $topResponder);
    $router->get('/', $topAction);
    $router->get('/hoge', fn (string $val = '') => 'Hello, world: ' . $val);
    $router->resolve();
} catch (Throwable $e) {
    http_response_code(403);
//    header('Content-type: application/json');
    // TODO: send slack
    echo json_encode([
        'error' => [
            'message' => $e->getMessage(),
            'info' => [$e->getCode(), $e->getLine(),],
            'stacktrace' => $e->getTraceAsString(),
        ]
    ]);
}