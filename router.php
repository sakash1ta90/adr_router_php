<?php

class Router
{
    private array $routeing = [];

    /**
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        foreach ($routes as $route) {
            switch ($route['method']) {
                case 'GET':
                    $this->get($route['path'], $route['callback']);
                    break;
                case 'POST':
                    $this->post($route['path'], $route['callback']);
            }
        }
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function get(string $path, callable $callback): void
    {
        $this->routeing['GET'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param callable $callback
     * @return void
     */
    public function post(string $path, callable $callback): void
    {
        $this->routeing['POST'][$path] = $callback;
    }

    /**
     * @return void
     */
    public function resolve(): void
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $paramsOrigStr = '';
        if (1 === preg_match('/\?/', $path)) {
            [0 => $path, 1 => $paramsOrigStr] = explode('?', $path);
        }
        $method = $_SERVER['REQUEST_METHOD'];

        if (empty($this->routeing[$method][$path])) {
            // TODO: エラーハンドリング
            echo 'error';
        } else if (empty($paramsOrigStr)) {
            $return = $this->routeing[$method][$path]();
            if (gettype($return) === 'string') {
                echo $return;
            } else if (is_callable($return)) {
                echo $return();
            }
            // TODO: ELSE処理
        } else {
            $paramsArray = $this->explodeGetParams($paramsOrigStr);
            echo $this->routeing[$method][$path](...$paramsArray)();
        }
    }

    /**
     * @param string $orgParams
     * @return array
     */
    private function explodeGetParams(string $orgParams): array
    {
        $paramsArrayTmp = explode('&', $orgParams);
        foreach ($paramsArrayTmp as $paramsArrayTmpUnit) {
            [0 => $key, 1 => $value] = explode('=', $paramsArrayTmpUnit);
            $paramsArray[$key] = $value;
        }
        return $paramsArray ?? [];
    }
}