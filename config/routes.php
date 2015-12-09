<?php
/*
  $routes->get('/', function() {
    HelloWorldController::index();
  });
*/

function check_logged_in(){
    //Basecontroller::check_logged_in();
    //jostain syystä löytää vain HelloWorldControllerin
    UserController::check_logged_in();
}

$routes->get('/hiekkalaatikko', function() {
      HelloWorldController::sandbox();
  });
  
$routes->get('/', function(){
    HelloWorldController::home();
});
  
  //tuotteisiin liittyviä polkuja
  
$routes->get('/muutaTietoja', 'check_logged_in', function(){
    TuoteController::muutaTuotetietoja();
});
  
$routes->post('/tuote', 'check_logged_in', function(){
    TuoteController::store();
});
$routes->get('/tuote/uusi', 'check_logged_in', function(){
    TuoteController::create();
});
$routes->get('/tuote/:id', function($id){
    TuoteController::show($id);
});

$routes->get('/tuotteet', function(){
    TuoteController::tuotelista();
});


//tuotteen lisäys ja poisto

$routes->get('/tuotteet/kimputTuoteTest', function(){
    TuoteController::kimput();
});

$routes->get('/tuotteet/kimput', function(){
    TuoteController::kimput();
});

$routes->get('/tuote/:id/edit', 'check_logged_in', function($id){
    TuoteController::edit($id);
});

$routes->post('/tuote/:id/edit', 'check_logged_in', function($id){
    TuoteController::update($id);
});

$routes->post('/tuote/:id/remove', 'check_logged_in', function($id){
    TuoteController::remove($id);
});


//sisäänkirjautuminen
// UserController ei löydy, korjaus myöhemmin

$routes->get('/kirjaudu', function(){
    UserController::login();        
});

$routes->post('/kirjaudu', function(){
    UserController::handle_login();        
});

//uloskirjautuminen
$routes->post('/uloskirjautuminen', function(){
    UserController::logout();
});

//uuden käyttäjän luonti
$routes->post('/kayttaja', function(){
    UserController::userStore();
});

$routes->get('/kayttaja/uusi', function(){
    UserController::userCreate();
});
$routes->get('/kayttaja/:userid', 'check_logged_in', function($userid){
    UserController::userShow($userid);
});

$routes->get('/kayttajat', 'check_logged_in', function(){
    UserController::kayttajalista(); 
});

$routes->post('/kayttaja/:userid/remove', 'check_logged_in', function($userid){
    UserController::userRemove($userid);
});

$routes->get('/testiikkuna', function(){
    UserController::testiSivu();
});
    
