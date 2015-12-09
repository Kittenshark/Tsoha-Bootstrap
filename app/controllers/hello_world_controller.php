<?php
require 'app/models/tuote.php';
require 'app/models/kayttaja.php';
  class HelloWorldController extends BaseController{
/*
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	 echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
        
        $tuotteet = Tuote::all();
        
        $Kint::dump($tuotteet);

    }
 
  */
    public static function sandbox(){
        $ruusu = new Tuote(array(
            'fname' => '',
            'price' => '2',
            'sale' => '0',
            'description' => 'Punainen'
        ));
        
        $errors = $ruusu->errors();
        
        Kint::dump($errors);
    }
    
    public static function home(){
        View::make('homepage.html');
    }
  }
