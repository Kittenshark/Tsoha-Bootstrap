<?php
class TuoteController extends BaseController{
    public static function tuotelista(){
        $tuotteet = Tuote::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function store(){
        self::check_logged_in();
        
        $params = $_POST;
        
        $attributes = array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description'],
            'orderit' => $params['orderit']
        );
    
        $tuote = new Tuote($attributes);
        $errors = $tuote->errors();
        
        if(count($errors) == 0){
            $tuote->save();
            $id = $tuote->id;
            $tuoteryhmat = $params['tuoteryhmat'];
        
            foreach($tuoteryhmat as $tuoteryhma){
                $tuote->createTuoteYhdiste($id, $tuoteryhma);
            }
             Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote on luotu'));
        } else {
            $tuoteryhmat = Tuoteryhma::all();
            View::make('tuote/new.html', array('errors' => $errors, 'attributes' => $attributes, 'tuoteryhmat' => $tuoteryhmat));
        }    
    }
    
    public static function create(){
        self::check_logged_in();
        $tuoteryhmat = Tuoteryhma::all();
        View::make('tuote/new.html', array('tuoteryhmat' => $tuoteryhmat));
    }
    
    public static function show($id){
        $tuote = Tuote::find($id);
        $tuoteryhmät = Tuote::getTuoteryhmat($id);
        View::make('tuote/show.html', array('tuote' => $tuote, 'tuoteryhmat' => $tuoteryhmät));
    }
    
    public static function edit($id){
        self::check_logged_in();
        $tuote = Tuote::find($id);
        View::make('tuote/edit.html', array('tuote' => $tuote));
    }
    
    public static function update($id){
        self::check_logged_in();
        
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description'],
            'orderit' => $params['orderit']
                );
 
        $tuote = new Tuote($attributes);
        $errors = $tuote->errors();
        
        if(count($errors) > 0){
            $tuote = Tuote::find($id);
            View::make('tuote/edit.html', array('errors' => $errors,'attributes' => $attributes, 'tuote' => $tuote));
        } else {
            $tuote->update();
            Redirect::to('/tuote/' . $tuote->id, array('message' => 'Onnistunut muokkaus') );
        }
    }
    
    public static function remove($id){
        self::check_logged_in();
        $tuote = Tuote::remove($id);
        
        Redirect::to('/tuotteet', array('message' => 'Tuotteen poisto onnistui'));
    }
    
    public static function tuoteryhmalista(){
        $tuoteryhmat = Tuoteryhma::all();
        View::make('tuote/tuoteryhmatlista.html', array('tuoteryhmat' => $tuoteryhmat));
    }
    
    //eri listauksia
    public static function listSales(){
        $tuotteet = Tuote::listSales();
        View::make('tuote/listaValinnat.html', array('tuotteet' => $tuotteet));
    }
        
    public static function kimput(){
        $tuotteet = Tuote::listThings($id);
        View::make('tuote/listaValinnat.html', array('tuotteet' => $tuotteet));
    }
    
    public static function showRyhma($id){
        $tuotteet = Tuote::listThings($id);
        
        View::make('tuote/listaValinnat.html', array('tuotteet' => $tuotteet));
    }
    
    public static function createTuoteryhma(){
        self::check_logged_in();
        View::make('tuote/newTuoteryhma.html');
    }
    
    public static function storeTuoteryhma(){
        self::check_logged_in();
        
        $params = $_POST;
        
        $attributes = array(
            'fname' => $params['fname'],
            'description' => $params['description']
        );
        
        $tuoteryhma = new Tuoteryhma($attributes);
        $errors = $tuoteryhma->errors();
        
        if(count($errors) == 0){
            $tuoteryhma->save();
            
            Redirect::to('/tuotteet', array('message' => 'Uusi tuoteryhmä on luotu'));
        } else {
            View::make('tuote/newTuoteryhma.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    

}