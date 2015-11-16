<?php
/*
  $routes->get('/', function() {
    HelloWorldController::index();
  });
*/
  

  $routes->get('/hiekkalaatikko', function() {
      HelloWorldController::sandbox();
  });
  
  $routes->get('/', function(){
      HelloWorldController::home();
  });
  
  $routes->get('/muutaTuotetietoja', function(){
      HelloWorldController::muutaTuotetietoja();
  });
  
  /*
  $routes->get('/tuote/:tid', function($tid){
      HelloWorldController::show($tid);
  });
*/
  $routes->get('/tuote', function(){
      HelloWorldController::tuotelista();
  });
  
  $routes->get('/tuote/:tid', function($tid){
      HelloWorldController::show($tid);
  });

$routes->get('/testisivu', function(){
    TuoteController::index();
});

$routes->get('/tuotelista', function(){
    HelloWorldController::tuotelista();
});

$routes->get('/tuotteet', function(){
TuoteController::index();
});

$routes->get('/uusi', function(){
    HelloWorldController::uusi();
});

$routes->post('/tuotteet', function(){
HelloWorldController::store();
});


$routes->get('/kirjaudu', function(){
   TestiController::login(); 
});