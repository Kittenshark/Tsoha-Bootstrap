<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/base2', function(){
      HelloWorldController::base2();
  });
  
  $routes->get('/muutaTuotetietoja', function(){
      HelloWorldController::muutaTuotetietoja();
  });
  
  $routes->get('/tuote', function(){
      HelloWorldController::tuote();
  });
  
  $routes->get('/tuotelista', function(){
      HelloWorldController::tuotelista();
  });
