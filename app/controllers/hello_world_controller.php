<?php
require 'app/models/tuote.php';
require 'app/models/kayttaja.php';
  class HelloWorldController extends BaseController{
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
