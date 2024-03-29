<?php

namespace App;


use AltoRouter;
//use App\Security\ForbidddenException;

class Router {

    /**
     * Undocumented variable
     *
     * @var string
     */
    private $viewPath;

    /**
     * Undocumented variable
     *
     * @var AltoRouter
     */
    private $router;
    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null) : self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function match(string $url, string $view, ?string $name = null) : self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, ?string $name = null) : self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }

    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }
   
    public function run() : self
    {
        $match = $this->router->match();
        $view = $match['target'] ?: 'e404';
        $params = $match['params'];
        $router = $this;
        $isAdmin = strpos($view, 'admin/') !== false;
        $layout = $isAdmin ? 'admin/layout/default' : 'layout/default';
        
        ob_start();
        require $this->viewPath . DIRECTORY_SEPARATOR .  $view . '.php';
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . $layout . '.php';
       
        return $this;
    }
    
}
