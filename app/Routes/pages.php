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
    return new Response(200, Pages\About::getAbout());
  }
]);

$obRouter->get('/depoimentos',[
  function(){
    return new Response(200, Pages\Testimony::getTestimonies());
  }
]);

// Rota de depoimentos (INSERT)
$obRouter->post('/depoimentos',[
  function($request){
    echo '<pre>';
    //  echo json_encode($request);
    print_r($request);
    echo '</pre>';
    exit;
    return new Response(200, Pages\Testimony::getTestimonies());
  }
]);

// Rota dinamica
// $obRouter->get('/pagina/{idPagina}/{acao}',[
//   function($idPagina, $acao){
//     return new Response(200, "Pagina: " . $idPagina . " - Ação: " . $acao);
//   }
// ]);

// $obRouter->get('/user/edit/{idUser}/{teste}/',[
//   function($idPagina, $teste){
//     return new Response(200, 'Pagina: ' . $idPagina . ' - Teste: ' . $teste);
//   }
// ]);