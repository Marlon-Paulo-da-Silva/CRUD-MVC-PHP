<?php
namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;
use \App\Http\Middleware\Queue as MiddlewareQueue;

class Router
{
    private $url = '';

    private $prefix = '';

    private $routes = [];

    private $request;

    // content type padrão do response
    private $contentType = 'text/html';

    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }

    // Metodo responsável por alterar o valor do content Type
    public function setContentType($contentType){
        $this->contentType = $contentType;
    }




    private function setPrefix()
    {
        $parseUrl = parse_url($this->url);

        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method, $route, $params = [])
    {
        // validação dos parametros, transformando o key em Controller
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // Middlewares da rota
        $params['middlewares'] = $params['middlewares'] ?? [];

        
        // Variaveis da rota
        $params['variables'] = [];

        //padrao de validação das variaveis das rotas
        $patternVariable = '/{(.*?)}/';

        if (preg_match_all($patternVariable, $route, $matches)) {

            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];

        }

        // Padrão de validação da URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        // Adiciona a rota dentro da classe
        $this->routes[$patternRoute][$method] = $params;

    }

    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }

    public function post($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }

    public function put($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }

    public function delete($route, $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    // metodo responsável por retornar a URI desconsiderando prefixo
    private function getUri()
    {
        // URI da REQUEST
        $uri = $this->request->getUri();

        // Fatia a URI com o prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        
        // Retorna a URI sem prefixo
        return rtrim(end($xUri), '/');

    }

    // Metodo responsável por retornar os dados da rota atual
    private function getRoute()
    {

        //URI (Rota sem o prefixo da pasta)
        $uri = $this->getUri();

        //Method (se é o GET,POST,ETC)
        $httpMethod = $this->request->getHttpMethod();

        //VALIDA AS ROTAS
        foreach ($this->routes as $patternRoute => $methods) {

            // Compara a rota da URI com as rotas existentes
            if (preg_match($patternRoute, $uri, $matches)) {

                // Verifica o Método se existe
                if (isset($methods[$httpMethod])) {

                    // Remove a primeira posição
                    unset($matches[0]);

                    // Variaveis processadas
                    $keys = $methods[$httpMethod]['variables'];

                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);

                    $methods[$httpMethod]['variables']['request'] = $this->request;

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
    public function run()
    {
        // die();
        try {

            // Obtém a rota atual
            $route = $this->getRoute();

            // verifica o controlador
            if (!isset($route['controller'])) {
                throw new Exception('A URL não pode ser processada', 500);
            }
            // Argumentos da função-
            $args = [];

            //Reflection
            $reflection = new ReflectionFunction($route['controller']);

            foreach ($reflection->getParameters() as $parameter) {

                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';

            }

            // Retorna a execução da fila de Middlewares
            return (new MiddlewareQueue($route['middlewares'], $route['controller'], $args))->next($this->request);

            // Not Working (Não precisa por conta da inserção de Middlewares que já executam os controllers)
            // Retorna a execução da função
            // return call_user_func_array($route['controller'], $args);

        } catch (Exception $th) {
            return new Response($th->getCode(), $this->getErrorMessage($th->getMessage()), $this->contentType);
        }

    }
    // Metodo responsável por retornar a mensagem de erro de acordo com o content-type
    private function getErrorMessage($message){
        switch ($this->contentType) {
            case 'application/json':
                return [
                    'error' => $message
                ];
                break;
            
            default:
                return $message;
                break;
        }
    }

    // Metodo responsável por retornar a URL atual
    public function getCurrentUrl(){
      return $this->url . $this->getUri();
    }

    // Metodo responsável por redirecionar a URL
    public function redirect($route){
        // URL
        $url = $this->url . $route;

        // Executa o redirect
        header('Location: '. $url);
        exit;
    }
}
