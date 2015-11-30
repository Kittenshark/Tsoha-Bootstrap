<?php
/*
  $routes->get('/', function() {
    HelloWorldController::index();
  });
*/

function check_logged_in(){
    //Basecontroller::check_logged_in();
    //jostain syystä löytää vain HelloWorldControllerin
    HelloWorldController::check_logged_in();
}

  $routes->get('/hiekkalaatikko', function() {
      HelloWorldController::sandbox();
  });
  
  $routes->get('/', function(){
      HelloWorldController::home();
  });
  
  //tuotteisiin liittyviä polkuja
  
  $routes->get('/muutaTietoja', 'check_logged_in', function(){
      HelloWorldController::muutaTuotetietoja();
  });
  
  $routes->post('/tuote', 'check_logged_in', function(){
    HelloWorldController::store();
});
$routes->get('/tuote/uusi', 'check_logged_in', function(){
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

$routes->get('/tuote/:id/edit', 'check_logged_in', function($id){
    HelloWorldController::edit($id);
});

$routes->post('/tuote/:id/edit', 'check_logged_in', function($id){
    HelloWorldController::update($id);
});

$routes->post('/tuote/:id/remove', 'check_logged_in', function($id){
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
$routes->get('/kayttaja/:userid', 'check_logged_in', function($userid){
    //UserController::show($id);
    HelloWorldController::userShow($userid);
});

$routes->get('/kayttajat', 'check_logged_in', function(){
    HelloWorldController::kayttajalista(); 
});

$routes->post('/kayttaja/:userid/remove', 'check_logged_in', function($userid){
    HelloWorldController::userRemove($userid);
});