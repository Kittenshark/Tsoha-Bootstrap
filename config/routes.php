<?php
function check_logged_in(){
    UserController::check_logged_in();
}

//function check_can_you_order(){
//    TuoteController::check_can_you_order();
//}

$routes->get('/hiekkalaatikko', function() {
      HelloWorldController::sandbox();
  });
  
$routes->get('/', function(){
    HelloWorldController::home();
});
    
//tuotteisiin liittyviä toimintoja
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
$routes->get('/tuote/:id/edit', 'check_logged_in', function($id){
    TuoteController::edit($id);
});
$routes->post('/tuote/:id/edit', 'check_logged_in', function($id){
    TuoteController::update($id);
});
$routes->post('/tuote/:id/remove', 'check_logged_in', function($id){
    TuoteController::remove($id);
});

//turhia
$routes->get('/tuotteet/kimput', function(){
    TuoteController::kimput();
});

//sisäänkirjautuminen ja käyttäjiin liittyvät polut
$routes->get('/kirjaudu', function(){
    UserController::login();        
});
$routes->post('/kirjaudu', function(){
    UserController::handle_login();        
});
$routes->post('/uloskirjautuminen', function(){
    UserController::logout();
});
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
$routes->get('/kayttaja/haekayttaja', 'check_logged_in', function(){
    UserController::getKayttaja();
});

//Tilaukseen liittyvät
$routes->get('/tuotteet/:id/tilaa', 'check_logged_in', function($id){
    OstoController::create($id);
});
$routes->post('/tuotteet/:id/tilaa', 'check_logged_in', function($id){
    OstoController::store($id);
});

//testi
$routes->get('/testipalikka','check_logged_in', function(){
    OstoController::showall(); 
});

$routes->get('/testilista', 'check_logged_in', function(){
    OstoController::findyourorders();
});
    
