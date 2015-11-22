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
  
  $routes->get('/muutaTietoja', function(){
      HelloWorldController::muutaTuotetietoja();
  });
  
  $routes->post('/tuote', function(){
    HelloWorldController::store();
});

$routes->get('/tuote/uusi', function(){
    HelloWorldController::create();
});

//

$routes->get('/tuote/:id', function($id){
    HelloWorldController::show($id);
});

$routes->get('/testisivu', function(){
    TuoteController::index();
});

$routes->get('/tuotteet', function(){
    HelloWorldController::tuotelista();
});


//

$routes->get('/tuotteet/kimputTuoteTest', function(){
    TuoteController::kimput();
});

$routes->get('/tuotteet/kimput', function(){
    HelloWorldController::kimput();
});

$routes->get('/tuote/:id/edit', function($id){
    HelloWorldController::edit($id);
});

$routes->post('/tuote/:id/edit', function($id){
    HelloWorldController::update($id);
});

$routes->post('/tuote/:id/remove', function($id){
    HelloWorldController::remove($id);
});


//sisäänkirjautuminen
/* UserController ei löydy, korjaus myöhemmin
$routes->get('/kirjaudu', function(){
            UserController::login();        
});

$routes->post('/kirjaudu', function(){
            UserController::handle_loging();        
});
 * 
 */

$routes->get('/kirjaudu', function(){
    HelloWorldController::login();        
});

$routes->post('/kirjaudu', function(){
    HelloWorldController::handle_login();        
});