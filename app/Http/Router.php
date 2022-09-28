<?php
namespace App\Http;

use \Closure;
use \Exception;

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
    // validação dos parametros, transformando o key em Controller
    foreach($params as $key => $value){
      if($value instanceof Closure){
        $params['controller'] =  $value;
        unset($params[$key]);
        continue;
      }
    }
    // Variaveis da rota
    $params['variables'] = [];

    //padrao de validação das variaveis das rotas
    $patternVariable = '/{(.*?)}/';

    if(preg_match_all($patternVariable, $route, $matches)){
      $route = preg_replace($patternVariable, '(.*?)', $route);   
    }

    // Padrão de validação da URL
    $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';
    

    // Adiciona a rota dentro da classe
    $this->routes[$patternRoute][$method] = $params;

    // echo "<br>Rota: " . $patternRoute;
    // echo '<br>$this->routes: ';
    // echo '<pre>';
    // print_r($this->routes[$patternRoute][$method]);
    // echo '</pre>';

    // echo '<br><br>Params: ';
    // echo '<pre>';
    // print_r($params);
    // echo '</pre>';

    // die();

    // echo "DEntro do Add Route";
    // echo '<br><br>Metodo: ';
    // echo '<pre>';
    // echo print_r($method);
    // echo '</pre>';
    // echo '<br><br>Rota: ';
    // echo '<pre>';
    // echo print_r($route);
    // echo '</pre>';
    // echo '<br><br>Params: ';
    // echo '<pre>';
    // echo print_r($params);
    // echo '</pre>';
    // echo "FIM do Add Route";
        
  }



  public function get($route, $params = []){
    return $this->addRoute('GET', $route, $params);
  }

  public function post($route, $params = []){
    return $this->addRoute('POST', $route, $params);
  }

  public function put($route, $params = []){
    return $this->addRoute('PUT', $route, $params);
  }

  public function delete($route, $params = []){
    return $this->addRoute('DELETE', $route, $params);
  }

  // metodo responsável por retornar a URI desconsiderando prefixo
  private function getUri(){
    // URI da REQUEST
    $uri = $this->request->getUri();

    // Fatia a URI com o prefixo
    $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

    // Retorna a URI sem prefixo
    return end($xUri);

  }

  // Metodo responsável por retornar os dados da rota atual
  private function getRoute(){

    //URI (Rota sem o prefixo da pasta)
    $uri = $this->getUri();

    
    //Method (se é o GET,POST,ETC)
    $httpMethod = $this->request->getHttpMethod();
    
    

    //VALIDA AS ROTAS
    foreach ($this->routes as $patternRoute => $methods) {
      
      // Compara a rota da URI com as rotas existentes
      if(preg_match($patternRoute, $uri)){

        // Verifica o Método se existe
        if($methods[$httpMethod]){

          // Retorno parametros da rota
          return $methods[$httpMethod];
        }

        throw new Exception("Metodo não permitido", 405);
      }
    }

    // Caso passe por isso a URL não foi encontrada
    throw new Exception("URL não encontrada", 404);
    
    
  }

  // executa a rota atual
  public function run(){
    // die();
    try {

      $route = $this->getRoute();

      echo "<pre>";
      print_r($route);
      echo "</pre>";
      exit;

      
      if(!isset($route['controller'])){
        throw new Exception('A URL não pode ser processada', 500);
      }
      
      $args = [];
      return call_user_func_array($route['controller'], $args);

    } catch (Exception $th) {
      return new Response($th->getCode(), $th->getMessage());
    }
  }
}