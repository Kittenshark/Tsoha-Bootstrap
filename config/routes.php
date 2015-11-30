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
  
  //tuotteisiin liittyviä polkuja
  
  $routes->get('/muutaTietoja', function(){
      HelloWorldController::muutaTuotetietoja();
  });
  
  $routes->post('/tuote', function(){
    HelloWorldController::store();
});
$routes->get('/tuote/uusi', function(){
    HelloWorldController::create();
});
$routes->get('/tuote/:id', function($id){
    HelloWorldController::show($id);
});
//ei toimiva 
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
// UserController ei löydy, korjaus myöhemmin

$routes->get('/kirjaudu', function(){
    //UserController::handle_login();
    HelloWorldController::login();        
});

$routes->post('/kirjaudu', function(){
    //UserController::handle_login();
    HelloWorldController::handle_login();        
});

//uloskirjautuminen
$routes->post('/uloskirjautuminen', function(){
    HelloWorldController::logout();
    //UserController::logout();
});

//uuden käyttäjän luonti
$routes->post('/kayttaja', function(){
    //UserController::store();
    HelloWorldController::userStore();
});

$routes->get('/kayttaja/uusi', function(){
    //UserController::create();
    HelloWorldController::userCreate();
});
$routes->get('/kayttaja/:userid', function($userid){
    //UserController::show($id);
    HelloWorldController::userShow($userid);
});

$routes->get('/kayttajat', function(){
    HelloWorldController::kayttajalista(); 
});

$routes->post('/kayttaja/:userid/remove', function($userid){
    HelloWorldController::userRemove($userid);
});