<?php 

use App\Http\Response;

// Rota admin
$obRouter->get('/api/v1',[
  function($request){
    return new Response(200, json_encode(['status' => 'OK']));
  }
]);