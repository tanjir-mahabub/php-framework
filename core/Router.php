<?php
 
 namespace app\core;

/**
 * Class Router
 * 
 * @author Md. Tanjir Mahabub <md.tanjir.mahabub@gmail.com>
 * @package app\core;
 */


class Router 
{
    public Request $request;
    protected array $routes = [];   

    public function __construct(Request $request) 
    {
        $this->request = $request;
    }
    
    public function get($path, $callback) 
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve() 
    {
       $path = $this->request->getPath();
       $method = $this->request->getMethod();
       $callback = $this->routes[$method][$path] ?? false;
       
       if($callback === false) {
        echo "Not Found";
        exit;
       } 
       
       if (is_string($callback)) {
        return $this->renderView($callback);
       }

       return call_user_func($callback);
       
    }

    public function renderView($view) 
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}