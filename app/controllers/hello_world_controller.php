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
        $ruusukimppu = Tuote::find(230);
        $tuotteet = Tuote::all();
        
        Kint::dump($tuotteet);
        Kint::dump($ruusukimppu);
    }
    
    public static function home(){
        View::make('homepage.html');
    }
    
    public static function tuotelista(){
        $tuotteet = Tuote::all();
        View::make('tuotteet/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function store(){
        $params = $_POST;
        $tuote = new Tuote(array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
        ));
        
        Kint::dump($params);
        
        $tuote->save();
        
        //Redirect::to('/tuotteet/' . $tuote->tid, array('message' => 'Uusi tuote on luotu'));
    }
    
    public static function show($tid){
        $tuote = Tuote::find($tid);
        View::make('tuotteet/show.html', array('tuote' => $tuote));
    }
    
    public static function uusi(){
        View::make('tuotteet/uusituote.html');
    }
  }
