
<?php
require 'app/models/tuote.php';
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
        
        $tuotteet = Tuote::all();
        
        View::make('tuotteet/index.html', array('tuotteet' => $tuotteet));

    }
   
    public static function takapajula(){
        View::make('tuotteet/takapajula.html');
    }
    
    public static function base2(){
        View::make('homepage.html');
    }
    
    public static function muutaTuotetietoja(){
        View::make('suunnitelmat/muutaTuotetietoja.html');
    }
    
    public static function tuote(){
        View::make('suunnitelmat/tuote.html');
    }
    
    public static function tuotelista(){
        $tuotteet = Tuote::all();
        View::make('tuotteet/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function show(){
        
    }
    
    public static function uusi(){
        View::make('tuotteet/uusituote.html');
    }
    
    public static function store(){
        $params = $_POST;
        $tuote = new Tuote(array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'description' => $params['description']
        ));
        
        $tuote->save();
        
        Redirect::to('/tuotteet/' . $tuote->tid, array('message' => 'Uusi tuote on luotu'));
    }
  }
