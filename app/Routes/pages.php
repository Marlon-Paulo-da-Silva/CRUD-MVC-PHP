<?php

use App\Http\Response;

use App\Controller\Pages;

$obRouter->get('/',[
  function(){
    return new Response(200, Pages\Home::getHome());
  }
]);

$obRouter->get('/sobre',[
  function(){
    return new Response(200, Pages\About::getHome());
  }
]);

// Rota dinamica
$obRouter->get('/pagina/{idPagina}',[
  function($idPagina){
    return new Response(200, 'Pagina: '.$idPagina);
  }
]);

$obRouter->get('/user/edit/{idUser}/{teste}/',[
  function($idPagina){
    return new Response(200, 'Pagina: ' . $idPagina);
  }
]);