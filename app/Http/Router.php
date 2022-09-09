<?php
namespace App\Http;

use \Closure;

class Router {
  private $url = '';

  private $prefix = '';

  private $routes = [];

  private $request;

  public function __construct($url)
  {
    $this->request = new Request();
    $this->url = $url;
    $this->setPrefix();
  }

  private function setPrefix(){
    $parseUrl = parse_url($this->url);

    $this->prefix = $parseUrl['path'] ?? '';
  }

  private function addRoute($method, $route, $params = []){
    
  }

  public function get($route, $params = []){
    return $this->addRoute('GET', $route, $params);
  }
}