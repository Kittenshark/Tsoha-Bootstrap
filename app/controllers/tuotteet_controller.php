<?php
//require 'app/models/tuote.php';
class TuoteController extends BaseController{
    public static function tuotelista(){
        $tuotteet = Tuote::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function store(){
        self::check_logged_in();
        $params = $_POST;
        $tuote = new Tuote(array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
        ));
        
        $errors = $tuote->errors();
        
        if(count($errors) == 0){
             $tuote->save();
             Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote on luotu'));
        } else {
            View::make('tuote/new.html', array('errors' => $errors));
        }
       
    }
    
    public static function create(){
        self::check_logged_in();
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
        self::check_logged_in();
        $tuote = Tuote::find($id);
        View::make('tuote/edit.html', array('attributes' => $tuote));
    }
    
    public static function update($id){
        self::check_logged_in();
        /*
        $params = $_POST;
        
        $attributes = array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
                );
        
        $tuote = new Tuote($attributes);
         * 
         */
        //$errors = $tuote->errors();
        //$tuote->update();
        /*
        if(count($errors) > 0){
            View::make('tuote/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tuote->update();
        }
         * 
         */
        //$tuote = Tuote::find($id);
        $tuote = Tuote::update($id);
        
        $errors = $tuote->errors();
        
        if(count($errors) == 0){
            Redirect::to('/tuote/' . $id, array('message' => 'Muokkaus onnistui'));
        } else {
            Redirect::to('/tuote/' . $id . '/edit', array('message' => 'Muokkaus ei onnistunut'));
        } 
        
        // Redirect::to('/tuote/' . $tuote->id, array('message' => 'Muokkaus onnistui'));
    }
    
    public static function remove($id){
        self::check_logged_in();
        //$tuote = new Tuote(array('id' => $id));
        $tuote = Tuote::remove($id);
        
        Redirect::to('/tuotteet', array('message' => 'Tuotteen poisto onnistui'));
    }
}