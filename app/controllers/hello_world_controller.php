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
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function store(){
        $params = $_POST;
        $tuote = new Tuote(array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
        ));
        
        //Kint::dump($params);
        
        $tuote->save();
        
        Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote on luotu'));
    }
    
    public static function create(){
        View::make('tuote/new.html');
    }
    
    public static function show($id){
        $tuote = Tuote::find($id);
        View::make('tuote/show.html', array('tuote' => $tuote));
    }
    
    public static function kimput(){
        $tuotteet = Tuote::all();
        View::make('tuote/listaKimput.html', array('tuotteet' => $tuotteet));
    }
    
    public static function edit($id){
        $tuote = Tuote::find($id);
        View::make('tuote/edit.html', array('attributes' => $tuote));
    }
    
    public static function update($id){
        $params = $_POST;
        
        $attributes = array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
                );
        
        $tuote = new Tuote($attributes);
        //$errors = $tuote->errors();
        $tuote->update();
        /*
        if(count($errors) > 0){
            View::make('tuote/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tuote->update();
        }
         * 
         */
        Redirect::to('/tuote/' . $tuote->id, array('message' => 'Muokkaus onnistui'));
    }
    
    public static function remove($id){
        $tuote = new Tuote(array('id' => $id));
        $tuote -> remove();
        
        Redirect::to('/tuotteet', array('message' => 'Tuotteen poisto onnistui'));
    }
  }
