<?php
function check_logged_in(){
    UserController::check_logged_in();
}

$routes->get('/hiekkalaatikko', function() {
      HelloWorldController::sandbox();
  });
//etusivu
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

//Tilaukseen liittyvät
$routes->get('/tuotteet/:orderid/tilaa', 'check_logged_in', function($id){
    OstoController::create($id);
});
$routes->post('/tuotteet/:orderid/tilaa', 'check_logged_in', function($id){
    OstoController::store($id);
});
$routes->get('/tilaus/:orderid', 'check_logged_in', function($id){
    OstoController::showTilaus($id);
});
$routes->post('/tilaus/:orderid/remove', 'check_logged_in', function($orderid){
    OstoController::removeOrder($orderid);
});
$routes->get('/tilaus/:orderid/edit', 'check_logged_in', function($orderid){
    OstoController::edit($orderid);
});
$routes->post('/tilaus/:orderid/edit', 'check_logged_in', function($orderid){
    OstoController::updateOrder($orderid);
});

//testi
$routes->get('/testipalikka','check_logged_in', function(){
    OstoController::showall(); 
});
$routes->get('/testilista', 'check_logged_in', function(){
    OstoController::findyourorders();
});
$routes->get('/ktest', 'check_logged_in', function(){
    UserController::getKayttaja();
});

//erilaisia listoja eri "hakutermeillä"
//tuoteryhma/:id vastaa listaa tuotteista, jotka kuuluvat tuoteryhmään (ei yksittäisen tuoteryhmän sivu)
$routes->get('/tuoteryhma/:id', function($id){
    TuoteController::showRyhma($id);
});
$routes->get('/alennukset', function(){
    TuoteController::listSales();
});

//testi
$routes->get('/tuotteet/tuoteryhmat', function(){
    TuoteController::tuoteryhmalista();
});

//admin, lisäysmahdollisuudet
$routes->get('/admin', 'check_logged_in', function(){
    UserController::admin();
});

//kayttajan tilaukset
$routes->get('/kayttaja/:id/tilaukset', 'check_logged_in', function($id){
    OstoController::listuserorders($id);
});

//uusi tuoteryhmä
$routes->get('/newtuoteryhma', 'check_logged_in', function(){
    TuoteController::createTuoteryhma();
});
$routes->post('/newtuoteryhma', 'check_logged_in', function(){
    TuoteController::storeTuoteryhma();
});
