<?php

use App\Http\Response;

use App\Controller\Admin;

// Rota admin
$obRouter->get('/admin',[
  function(){
    return new Response(200, 'Admin :)');
  }
]);

// Rota login
$obRouter->get('/admin/login',[
  function($request){
    return new Response(200, Admin\Login::getLogin($request));
  }
]);