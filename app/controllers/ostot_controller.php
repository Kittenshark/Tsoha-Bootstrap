<?php
class OstoController extends BaseController{
    public static function tilausLista($userid){
        $tilaus = Tilaus::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function tilaajanLista($userid){
        
    }
    
    public static function create($id){
        self::check_logged_in();
        $tuote = Tuote::find($id);
        View::make('osto/createTilaus.html', array('tuote' => $tuote)); 
    }
    
    public static function fortest(){
        $tilaukset = Tilaus::all();
        View::make('osto/createTilaus.html', array('tilaukset' => $tilaukset));
    }
}

