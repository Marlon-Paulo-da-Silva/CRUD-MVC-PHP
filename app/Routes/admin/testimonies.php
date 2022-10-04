<?php 

use App\Http\Response;
use App\Controller\Admin;

// Rota de listagem de depoimentos
$obRouter->get('/admin/testimonies',[
  'middlewares' => [
    'require-admin-login'
  ],
  function($request){
    return new Response(200, Admin\Testimony::getTestimonies($request));
  }
]);

// Rota de cadastro de um novo depoimento
$obRouter->get('/admin/testimonies/new',[
  'middlewares' => [
    'require-admin-login'
  ],
  function($request){
    return new Response(200, Admin\Testimony::getNewTestimony($request));
  }
]);

// Rota de cadastro de um novo depoimento (POST)
$obRouter->post('/admin/testimonies/new',[
  'middlewares' => [
    'require-admin-login'
  ],
  function($request){
    return new Response(200, Admin\Testimony::setNewTestimony($request));
  }
]);