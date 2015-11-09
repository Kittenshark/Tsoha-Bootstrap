<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	 echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
        View::make('helloworld.html');
       // echo 'Hello World!';
    }
    public static function base2(){
        View::make('suunnitelmat/base2.html');
    }
    
    public static function muutaTuotetietoja(){
        View::make('suunnitelmat/muutaTuotetietoja.html');
    }
    
    public static function tuote(){
        View::make('suunnitelmat/tuote.html');
    }
    
    public static function tuotelista(){
        View::make('suunnitelmat/tuotelista.html');
    }
    
  }
